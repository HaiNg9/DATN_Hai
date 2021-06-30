<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends My_Controller {
    /**
     * @var Title
     */
    private const TITLE = 'Loại tin tức - Quản trị';

    /**
     * @var TYPE
     */
    private const TYPE = 'TYPE';

	/**
	 * Category page admin controller.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::TYPE;
        $data['focusSubMenu'] = 'TYPE_LIST';
		$data['contentName'] = 'admin/pages/news/type/list';
        $data = $this->setLayoutDatatable($data);
        $types = $this->getAllData('types', 0);
        $types = $this->addUserUpdateInfo($types);
        $data['types'] = $types;
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }
    
    /**
     * Add new types.
     */
    public function add()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::TYPE;
        $data['focusSubMenu'] = 'TYPE_ADD';
        $data['contentName'] = 'admin/pages/news/type/add';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['categories'] = $this->getAllData('categories', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new category for table types.
     */
    public function create()
    {
        if ($this->input->post()) {
            $type = $this->input->post();

            $type = $this->validateInfoType($type, 'admin/type/add');

            $this->createSave('types', $type, 'loại tin', 'admin/type/list', 'admin/type/add');
        } else {
            redirect('404');
        }
    }

    /**
     * Get layout edit info category.
     */
    public function edit()
    {
        $type = $this->getDataById($this->uri->segment(4), 'types');

        $this->isDelFlagData($type);

        $data['focusMenu'] = $this::TYPE;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/news/type/edit';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['type'] = $type;
        $data['categories'] = $this->getAllData('categories', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update category info for table categories
     */
    public function update()
    {
        if ($this->input->post()) {
            $type = $this->input->post();

            $type = $this->validateInfoType($type, 'admin/type/edit/' . $type['id']);

            $type = $this->setDefaultUpdateData($type);

            $this->updateSave('types', $type, 'loại tin', 'admin/type/edit/' . $type['id']);
        } else {
            redirect('404');
        }
    }

    /** 
     * Delete types, change del_flag
     */
    public function delete()
    {
        $idType = $this->uri->segment(4);

        $type = $this->getDataById($idType, 'types');

        $this->isDelFlagData($type);

        try {
            $this->db->trans_begin();
            $posts = $this->db->where_in('id_type', $idType)->select('id')->get('posts')->result_array();
            $posts = implode(',', array_column($posts, 'id'));
            // Update del_flag comments
            $this->db->where_in('id_post', $posts)->set('del_flag', 1)->update('comments');
            // Update del_flag posts
            $this->db->where('id_type', $idType)->set('del_flag', 1)->update('posts');
            // Update del_flag types
            $this->db->where('id', $idType)->set('del_flag', 1)->update('types');
            // Start write histoty
			$this->insertHistory('types', $idType, $this->session->userdata('loginInfo')->id, 'DELETE', 'Thể loại');
			// End write histoty
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Loại tin đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/type/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/type/list');
        }
    }

    /**
     * Validate update type
     */
    private function validateInfoType($requestData, $urlBack)
    {
        $form_rules = array(
            array(
                'field' => 'id_category',
                'label' => 'Thể loại tin tức',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => '{field} chưa tồn tại, vui lòng thêm mới.',
                )
            ),
            array(
                'field' => 'name',
                'label' => 'Tên thể loại',
                'rules' => 'trim|required|max_length[100]',
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
}
