<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends My_Controller
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
     * Home page admin controller.
     */
    public function index()
    {
        if ($this->session->has_userdata('loginInfo') && $this->session->userdata('loginInfo')->role !== ResultUtils::ROLE['USER']) {
            redirect('admin/home');
        }
        $data['title'] = 'Đăng nhập';
        $this->load->view('login');
    }

    /**
     * Check login.
     */
    public function login()
    {
        if ($this->input->post()) {
            $this->validateInfoLogin($this->input->post());
            $this->hasLoginInfo($this->input->post());
        }
        else {
			redirect('404');
        }
    }

    /**
     * Logout account.
     */
    public function logout()
    {
        $this->session->unset_userdata('loginInfo');
        $infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Tài khoản đã đăng xuất khỏi hệ thống.']);
        $this->session->set_flashdata('messages', $infoMsg);
        redirect('dang-nhap.html');
    }

    /**
     * Validate login info
     */
    private function validateInfoLogin($requestData)
    {
        $form_rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|max_length[100]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'valid_email' => '{field} không đúng định dạng, vui lòng kiểm tra lại.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Mật khẩu',
                'rules' => 'trim|required|max_length[30]|min_length[6]',
                'errors' => array(
                    'required' => 'Vui lòng nhập {field}.',
                    'max_length' => '{field} quá dài, {field} chỉ từ {param} kí tự.',
                    'min_length' => '{field} quá ngắn, {field} chỉ được nhập {param} kí tự.'
                )
            )
        );
        $this->form_validation->set_rules($form_rules);

        if ($this->form_validation->run() == FALSE) {
            $messages = $this->form_validation->error_array();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('dang-nhap.html');
        }
    }

    /**
     * Check login info from info request
     */
    private function hasLoginInfo($requestData)
    {
        $user = $this->db->where('del_flag', 0)->where('email', $requestData['email'])->limit(1)->get('users')->row();
        if (!$user) {
            $messages = [
                'Tài khoản chưa tồn tại, vui lòng kiểm tra lại.'
            ];
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('dang-nhap.html');
        }
        if (!password_verify($requestData['password'], $user->password)) {
            $messages = [
                'Mật khẩu không đúng, vui lòng kiểm tra lại.'
            ];
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
            $this->session->set_flashdata('messages', $errors);
            $this->session->set_flashdata('old', $requestData);
            redirect('dang-nhap.html');
        }

        // Remove record password for security	
        unset($user->password);

        $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Đăng nhập hệ thống thành công.']);

        $this->session->set_flashdata('messages', $success);

        $loginInfo = [];
        $loginInfo = $user;
        $this->session->set_userdata('loginInfo', $loginInfo);

        if ($user->role === ResultUtils::ROLE['USER']) {
            redirect('trang-chu.html');
        }
        elseif ($user->role === ResultUtils::ROLE['ADMIN']) {
            redirect('admin/home');
        }
    }
}
