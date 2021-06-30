<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
	 * Register page admin controller.
	 */
	public function index()
	{
		if ($this->session->has_userdata('loginInfo')) {
			if ($this->session->has_userdata('loginInfo')->role !== ResultUtils::ROLE['USER']) {
				redirect('admin/home');
			}
			$this->session->unset_userdata('loginInfo');
			$infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Tài khoản phải được đăng xuất trước khi đăng ký mới.']);
			$this->session->set_flashdata('messages', $infoMsg);
			redirect('dang-ky.html');
		}
		$data['title'] = 'Đăng ký';
		$this->load->view('register', $data);
	}

	/**
	 * Register user for table users
	 */
	public function register()
	{
		if ($this->input->post()) {
			$this->validateInfoRegister($this->input->post());
			$this->addUser($this->input->post());
		}
		else {
			redirect('404');
		}
	}

	/**
	 * Validate register
	 */
	private function validateInfoRegister($requestData)
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
			)
		);
		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() == FALSE) {
			$messages = $this->form_validation->error_array();
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $messages);
			$this->session->set_flashdata('messages', $errors);
			$this->session->set_flashdata('old', $requestData);
			redirect('dang-ky.html');
		}
	}

	/**
	 * Insert user for table users
	 */
	private function addUser($requestData)
	{
		unset($requestData['password_confirm']);
		$requestData['role'] = ResultUtils::ROLE['USER'];
		$password = $requestData['password'];
		$requestData['password'] = password_hash($requestData['password'], PASSWORD_BCRYPT);
		
		try {
			$this->db->insert('users', $requestData);
			$success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Đăng ký tài khoản thành công, vui lòng đăng nhập hệ thống']);
			$this->session->set_flashdata('messages', $success);
			$inputData = [
				'email' => $requestData['email'],
				'password' => $password
			];
			$this->session->set_flashdata('old', $inputData);
			redirect('dang-nhap.html');
		}
		catch (Exception $e) {
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
			$this->session->set_flashdata('messages', $errors);
			redirect('dang-ky.html');
		}
	}
}
