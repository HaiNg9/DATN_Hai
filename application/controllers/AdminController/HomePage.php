<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomePage extends My_Controller
{
	/**
	 * @var Title
	 */
	private const TITLE = 'Trang chủ - quản trị';

	/**
	 * @var ShowMenu
	 */
	private const HOME = 'HOME';

	/**
	 * Layout list.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
		$data['focusMenu'] = $this::HOME;
		$data['contentName'] = 'admin/pages/homepage/edit';
		$homeData = $this->getDataById(1, 'homes');
		$homeData->name_user_update = '';
		if ($homeData->updated_by != 0) {
			$updateBy = $this->db->where('id', $homeData->updated_by)
				->get('users')->row()->display_name;
			$homeData->name_user_update = $updateBy;
		}
		$data['homeData'] = $homeData;
		$data['script'] = [
            'public/admin/js/event.js'
        ];
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
	}
	
	/**
	 * Update data for table homes.
	 */
	public function Update()
	{
		if ($this->input->post()) {
            $homeData = $this->input->post();
			
            $homeData = $this->validateInfoHomeData($homeData, 'admin/homepage/list');

            if (!empty($_FILES['img_logo']['name'])) {
                $homeData['logo'] = $this->uploadImageHome($_FILES['img_logo']['name']);
            }

			$homeData = $this->setDefaultUpdateData($homeData);

            $this->updateSave('homes', $homeData, 'cài đặt trang chủ', 'admin/homepage/list/');
        } else {
            redirect('404');
        }
	}

	/**
     * Validate update home data
     */
	private function validateInfoHomeData($requestData, $urlBack){
		$form_rules = array(
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
            array(
                'field' => 'phone',
                'label' => 'Số điện thoại',
                'rules' => 'trim|required|max_length[20]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
			),
			array(
                'field' => 'web_link',
                'label' => 'Địa chỉ trang web',
                'rules' => 'trim|required|max_length[255]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            )
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
     * Upload image logo for home page
     */
    private function uploadImageHome($file)
    {
        define('URL', './public/admin/upload/images/logo/');
        $ArrNameImage = explode('.', $file);
        $nameImage = 'logo_home_page.' . end($ArrNameImage);
        $oldFile = URL . $nameImage;
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
        move_uploaded_file($_FILES['img_logo']['tmp_name'], $oldFile);
        return $nameImage;
    }
}
