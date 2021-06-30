<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends My_Controller
{
    /**
     * @var Title
     */
    private const TITLE = 'Tài khoản - Quản trị';

    /**
     * @var ShowMenu
     */
    private const USER = 'USER';

    /**
     * Get list users.
     */
    public function list()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::USER;
        $data['focusSubMenu'] = 'USER_LIST';
        $data['contentName'] = 'admin/pages/user/list';
        $data = $this->setLayoutDatatable($data);
        $data['users'] = $this->getAllData('users', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new users.
     */
    public function add()
    {
        $data['focusMenu'] = $this::USER;
        $data['focusSubMenu'] = 'USER_ADD';
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/user/add';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new user for table users.
     */
    public function create()
    {
        if ($this->input->post()) {
            $user = $this->input->post();

            $user = $this->validateInfoCreateUser($user);

            if (!empty($_FILES['img_user']['name'])) {
                $user['img'] = $this->uploadImageUser($_FILES['img_user']['name']);
            }

            $this->createSave('users', $user, 'tài khoản', 'admin/user/list', 'admin/user/add');
        } else {
            redirect('404');
        }
    }

    /**
     * Get layout edit info users.
     */
    public function edit()
    {
        $idUser = $this->uri->segment(4);
        $user = $this->getDataById($idUser, 'users');
        
        $this->isDelFlagData($user);

        if ($this->session->userdata('loginInfo')->id === $idUser) {
            $data['focusMenu'] = 'PROFILE';
        } else {
            $data['focusMenu'] = $this::USER;
        }

        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/user/edit';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['user'] = $user;
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update user info for table users
     */
    public function update()
    {
        if ($this->input->post()) {
            $user = $this->input->post();

            $user = $this->validateInfoUpdateUser($user);

            if (!empty($_FILES['img_user']['name'])) {
                $user['img'] = $this->uploadImageUser($_FILES['img_user']['name']);
            }

            $user['updated_date'] = date('Y-m-d H:i:s');
            try {
                $this->db->update('users', $user, 'id = ' . $user['id']);
                $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thông tin tài khoản đã được cập nhật.']);
                $this->session->set_flashdata('messages', $success);
                $this->session->set_flashdata('old', $user);

                // Reset session login info
                $this->resetSessionLogin();

                redirect('admin/user/edit/' . $user['id']);
            } catch (Exception $e) {
                $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
                $this->session->set_flashdata('messages', $errors);
                redirect('admin/user/edit/' . $user['id']);
            }
        } else {
            redirect('404');
        }
    }

    /**
     * Update role for user.
     */
    public function role()
    {
        $user = $this->getDataById($this->uri->segment(4), 'users');

        $this->isDelFlagData($user);

        if ($this->uri->segment(5) !== 'ADMIN' && $this->uri->segment(5) !== 'USER') {
            redirect('404');
        }

        $data = [
            'id' => $this->uri->segment(4),
            'role' => $this->uri->segment(5)
        ];

        try {
            $this->db->update('users', $data, 'id = ' . $data['id']);
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thông tin tài khoản đã được cập nhật.']);
            $this->session->set_flashdata('messages', $success);

            // Reset session login info
            $this->resetSessionLogin();

            redirect('admin/user/list');
        } catch (Exception $e) {
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/user/list');
        }
    }

    /**
     * Delete posts, change del_flag
     */
    public function delete()
    {
        $userID = $this->uri->segment(4);
        $user = $this->getDataById($userID, 'users');

        $this->isDelFlagData($user);

        try {
            $this->db->trans_begin();
            $posts = $this->db->where('id_user', $userID)->select('id')->get('posts')->result_array();
            $posts = implode(',', array_column($posts, 'id'));
            // Update del_flag comments
            $this->db->where_in('id_user', $posts)->set('del_flag', 1)->update('comments');
            // Update del_flag posts
            $this->db->where('id_user', $userID)->set('del_flag', 1)->update('posts');
            // Update del_flag users
            $this->db->where('id', $userID)->set('del_flag', 1)->update('users');
            // Start write histoty
			$this->insertHistory('users', $userID, $this->session->userdata('loginInfo')->id, 'DELETE', 'Tài khoản');
			// End write histoty
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Tin tức đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/user/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/user/list');
        }
    }

    /**
     * Change role list for account
     */
    public function editRoleNumber()
    {
        $user = $this->getDataById($this->uri->segment(4), 'users');

        $this->isDelFlagData($user);

        if ($user->role === ResultUtils::ROLE['USER']) {
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Tài khoản người dùng không được cấp quyền quản trị.']);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/user/list');
        }

        $data['focusMenu'] = $this::USER;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/user/edit-role';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['userRole'] = explode(",", $user->role_number);
        $data['userId'] = $user->id;
        $data['roles'] = $this->getAllData('roles', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update data role_number for table users
     */
    public function updateRoleNumber()
    {
        if ($this->input->post()) {
            $user = $this->input->post();

            $user['updated_date'] = date('Y-m-d H:i:s');
            try {
                $this->db->update('users', $user, 'id = ' . $user['id']);
                $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Quyền tài khoản đã được cập nhật.']);
                $this->session->set_flashdata('messages', $success);
                // Reset session login info
                $this->resetSessionLogin();
                redirect('admin/user/editRoleNumber/'.$user['id']);
            } catch (Exception $e) {
                $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
                $this->session->set_flashdata('messages', $errors);
                redirect('admin/user/editRoleNumber/'.$user['id']);
            }
        } else {
            redirect('404');
        }
    }

    /**
     * Layout change role name
     */
    public function editRoleName()
    {
        $role = $this->getDataById($this->uri->segment(4), 'roles');

        if (!$role) {
			redirect('404');
		}

        $data['focusMenu'] = $this::USER;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/user/edit-role-name';
        $data['role'] = $role;
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update role name for roles table
     */
    public function updateRoleName()
    {
        if ($this->input->post()) {
            $role = $this->input->post();

            $role = $this->validateInfoRoleName($role, 'admin/user/editRoleName/' . $role['id']);

            $role = $this->setDefaultUpdateData($role);

            $this->updateSave('roles', $role, 'tên quyền', 'admin/user/editRoleName/' . $role['id']);
        } else {
            redirect('404');
        }
    }

    /**
     * Validate update role name
     */
    private function validateInfoRoleName($requestData, $urlBack)
    {
        $form_rules = array(
            array(
                'field' => 'display_name',
                'label' => 'Tên quyền',
                'rules' => 'trim|required|max_length[255]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
        );

        $this->form_validation->set_rules($form_rules);

        if ($this->form_validation->run() == FALSE) {
            $messages = $this->form_validation->error_array();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect($urlBack);
        } 

        return $requestData;
    }

    /**
     * Validate update user
     */
    private function validateInfoUpdateUser($requestData)
    {
        $form_rules = array(
            array(
                'field' => 'display_name',
                'label' => 'Tên hiển thị',
                'rules' => 'trim|required|max_length[100]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|max_length[100]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'valid_email' => '{field} không đúng định dạng, vui lòng kiểm tra lại.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.',
                )
            ),

        );

        if (isset($requestData['change_password'])) {
            $validPassword = array(
                'field' => 'password',
                'label' => 'Mật khẩu',
                'rules' => 'trim|required|max_length[30]|min_length[6]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.',
                    'min_length' => '{field} quá ngắn, chỉ từ {param} kí tự.'
                )
            );
            $validPasswordConfirm = array(
                'field' => 'password_confirm',
                'label' => 'Xác nhận mật khẩu',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'matches' => 'Mật khẩu không khớp.',
                )
            );
            array_push($form_rules, $validPassword);
            array_push($form_rules, $validPasswordConfirm);
            $requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
        } else {
            unset($requestData['password']);
        }

        $this->form_validation->set_rules($form_rules);

        if ($this->form_validation->run() == FALSE) {
            $messages = $this->form_validation->error_array();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('admin/user/edit/' . $requestData['id']);
        } elseif ($this->editUnique('users', 'email', $requestData['email'], $requestData['id'])) {
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, ['Email đã tồn tại, vui lòng kiểm tra lại.']);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('admin/user/edit/' . $requestData['id']);
        }

        unset($requestData['password_confirm']);
        unset($requestData['change_password']);
        return $requestData;
    }

    /**
     * Validate register user
     */
    private function validateInfoCreateUser($requestData)
    {
        $form_rules = array(
            array(
                'field' => 'display_name',
                'label' => 'Tên hiểnthị ',
                'rules' => 'trim|required|max_length[100]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|max_length[100]|is_unique[users.email]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'valid_email' => '{field} không đúng định dạng, vui lòng kiểm tra lại.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.',
                    'is_unique' => '{field} đã tồn tại, vui lòng kiểm tra lại.'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Mật khẩu',
                'rules' => 'trim|required|max_length[30]|min_length[6]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.',
                    'min_length' => '{field} quá ngắn, chỉ từ {param} kí tự.'
                )
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'Xác nhận mật khẩu',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'matches' => 'Mật khẩu không khớp.',
                )
            ),
        );

        $this->form_validation->set_rules($form_rules);

        if ($this->form_validation->run() == FALSE) {
            $messages = $this->form_validation->error_array();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('admin/user/add');
        }

        unset($requestData['password_confirm']);
        $requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
        // Default account create is admin and can connect home page admin
        $requestData['role'] = ResultUtils::ROLE['ADMIN'];
        $requestData['role_number'] = 1;
        return $requestData;
    }

    /**
     * Upload image avatar for user 
     */
    private function uploadImageUser($file)
    {
        define('URL', './public/admin/upload/images/user/');
        $ArrNameImage = explode('.', $file);
        $nameImage = 'user' . time() . '.' . end($ArrNameImage);
        $oldFile = URL . $nameImage;
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
        move_uploaded_file($_FILES['img_user']['tmp_name'], $oldFile);
        return $nameImage;
    }
}
