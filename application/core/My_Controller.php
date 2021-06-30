<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User role and base controller for User layout
 *
 */
class My_Controller extends CI_Controller
{
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		// Check role login admin
		$pathAdmin = $this->uri->segment(1);
		if ($pathAdmin === 'admin') {
			if (!$this->session->has_userdata('loginInfo')) {
				$infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Bạn cần phải đăng nhập để truy cập hệ thống.']);
				$this->session->set_flashdata('messages', $infoMsg);
				redirect('dang-nhap.html');
			} elseif ($this->session->userdata('loginInfo')->role === ResultUtils::ROLE['USER']) {
				$infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Tài khoản người dùng không thể truy cập hệ thống quản trị.']);
				$this->session->set_flashdata('messages', $infoMsg);
				redirect('trang-chu.html');
			} else {
				$url = uri_string();

				// Remove param if request has variable
				if ($this->uri->segment(3) === 'edit' || $this->uri->segment(3) === 'delete' || $this->uri->segment(3) === 'editRoleNumber' || $this->uri->segment(3) === 'editRoleName') {
					$url = explode('/', uri_string());
					unset($url[3]);
					$url = implode("/", $url);
				} elseif ($this->uri->segment(3) === 'role') {
					$url = explode('/', uri_string());
					unset($url[3]);
					unset($url[4]);
					$url = implode("/", $url);
				}

				$roles = $this->session->userdata('loginInfo')->role_number;
				$idRole = $this->db->where('name', $url)->get('roles')->row()->id;
				$hasRole = in_array($idRole, explode(',', $roles));

				if (!$hasRole) {
					$infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Tài khoản không có quyền truy cập trang yêu cầu.']);
					$this->session->set_flashdata('messages', $infoMsg);
					if ($this->uri->segment(2) != 'home') {
						redirect('admin/home');
					} else {
						redirect('trang-chu.html');
					}
				}
			}
		}
	}

	/**
	 * Set data header layout
	 */
	public function setDataHeader($data)
	{
		if ($this->session->userdata('loginInfo')->id == 1) {
			$data['notify'] = $this->db->where('seen_flag', 0)->get('histories')->result_array();
		}
		else {
			$data['notify'] = $this->db->where('seen_flag', 0)
									   ->where('user !=', $this->session->userdata('loginInfo')->id)
									   ->where('user !=', '1')
									   ->get('histories')->result_array();
		}

		$data['subNotify'] = $this->db->where('del_flag', 0)
                                      ->where('seen_flag', 0)
                                      ->get('subscribe')->result_array();
		return $data;
	}

	/**
	 * Import javascript and css for datatable
	 */
	public function setLayoutDatatable($data)
	{
		$data['script'] = [
			'public/admin/vendor/datatables/jquery.dataTables.min.js',
			'public/admin/vendor/datatables/dataTables.bootstrap4.min.js',
			'public/admin/js/event.js',
			'public/admin/js/demo/datatables-demo.js'
		];

		$data['css'] = [
			'public/admin/vendor/datatables/dataTables.bootstrap4.min.css'
		];

		return $data;
	}

	/**
	 * Import javascript and css for datatable
	 */
	public function setLayoutTinymce($data)
	{
		$data['script'] = [
			'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js',
			'public/admin/js/tinymce-custom.js'
		];
		return $data;
	}

	/**
	 * Check data not exist or is delete 
	 */
	public function isDelFlagData($data)
	{
		if (!$data) {
			redirect('404');
		} elseif (!empty($data->del_flag) && $data->del_flag == 1) {
			redirect('500');
		}
	}

	/**
	 * Add user update info
	 */
	public function addUserUpdateInfo($data)
    {
        for ($index = 0; $index <= count($data) - 1; $index++) {
            $createBy = $this->db->where('id', $data[$index]['created_by'])
                                 ->get('users')->row()->display_name;
            $data[$index]['name_user_create'] = $createBy;
            if ($data[$index]['updated_by'] != 0) {
                $updateBy = $this->db->where('id', $data[$index]['updated_by'])
                                     ->get('users')->row()->display_name;
                $data[$index]['name_user_update'] = $updateBy;
            }
        }
        return $data;
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
	 * Set default data update for table
	 */
	public function setDefaultUpdateData($data)
	{
		$data['updated_by'] = $this->session->userdata('loginInfo')->id;
		$data['updated_date'] = date('Y-m-d H:i:s');
		return $data;
	}

	/**
	 * Common insert data for database
	 */
	public function createSave($tableName, $data, $message, $urlSuccess, $urlError)
	{
		try {
			if ($tableName != 'users') {
				$data['created_by'] = $this->session->userdata('loginInfo')->id;
			}
			if ($tableName === 'posts') {
				$data['id_user'] = $this->session->userdata('loginInfo')->id;
			}
			$this->db->insert($tableName, $data);
			// Start write histoty
			$this->insertHistory($tableName, $this->db->insert_id(), $this->session->userdata('loginInfo')->id, 'INSERT', $message);
			// End write histoty
			$success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thêm ' . $message . ' mới thành công.']);
			$this->session->set_flashdata('messages', $success);
			$this->session->set_flashdata('old', $data);
			redirect($urlSuccess);
		} catch (Exception $e) {
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
			$this->session->set_flashdata('messages', $errors);
			redirect($urlError);
		}
	}

	/**
	 * Common update data for database
	 */
	public function updateSave($tableName, $data, $message, $urlBack)
	{
		try {
			$this->db->update($tableName, $data, 'id = ' . $data['id']);
			// Start write histoty
			$this->insertHistory($tableName, $data['id'], $this->session->userdata('loginInfo')->id, 'UPDATE', $message);
			// End write histoty
			$success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Cập nhật thông tin ' . $message . ' thành công.']);
			$this->session->set_flashdata('messages', $success);
			$this->session->set_flashdata('old', $data);
			redirect($urlBack);
		} catch (Exception $e) {
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
			$this->session->set_flashdata('messages', $errors);
			redirect($urlBack);
		}
	}

	/**
	 * Common insert data for database
	 */
	public function insertHistory($tableName, $idRow, $idUser, $status, $message)
	{
		try {
			$msg = $this->session->userdata('loginInfo')->display_name;

			switch ($status) {
				case 'INSERT':
					$msg .= ' thêm mới '.$message;
					break;
				case 'UPDATE':
					$msg .= ' cập nhật '.$message;
					break;
				case 'DELETE':
					$msg .= ' xóa bỏ '.$message;
					break;
			}

			$data = [
				'table' => $tableName,
				'id_table' => $idRow,
				'name_table' => $message,
				'user' => $idUser,
				'status' => $status,
				'message' => $msg
			];
			$this->db->insert('histories', $data);
		} catch (Exception $e) {
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
			$this->session->set_flashdata('messages', $errors);
			redirect('admin/home');
		}
	}
}
