<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Profile controller user.
     */
    public function index()
    {
        if (!$this->session->has_userdata('loginInfo')) {
            $infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_ERR, ['Vui lòng đăng nhập hệ thống.']);
            $this->session->set_flashdata('messages', $infoMsg);
            redirect('trang-chu.html');
        }

        $data['title'] = 'Tài khoản';
        $data['contentName'] = "user/pages/profile";
        $data['script'] = [
            'public/user/js/event.js'
        ];

		$data = $this->setDataRightMenuUser($data);
        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }

    /**
     * Update user info for table users
     */
    public function edit()
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
                redirect('tai-khoan.html');
            } catch (Exception $e) {
                $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
                $this->session->set_flashdata('messages', $errors);
                redirect('tai-khoan.html');
            }
        } else {
            redirect('404');
        }
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
            redirect('tai-khoan.html');
        } elseif ($this->editUnique('users', 'email', $requestData['email'], $requestData['id'])) {
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, ['Email đã tồn tại, vui lòng kiểm tra lại.']);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('tai-khoan.html');
        }

        unset($requestData['password_confirm']);
        unset($requestData['change_password']);
        return $requestData;
    }

    /**
	 * Check unique update data
	 */
	public function editUnique($table, $column, $value, $id)
	{
		$result = $this->db->where($column, $value)->where('id !=', $id)->get($table)->row();
		return $result == null ? false : true;
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
