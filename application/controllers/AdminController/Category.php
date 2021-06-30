<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends My_Controller {
    /**
     * @var Title
     */
    private const TITLE = 'Thể loại tin tức - Quản trị';

    /**
     * @var Category
     */
    private const CATEGORY = 'CATEGORY';

	/**
	 * Category page admin controller.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::CATEGORY;
        $data['focusSubMenu'] = 'CATEGORY_LIST';
		$data['contentName'] = 'admin/pages/news/category/list';
        $data = $this->setLayoutDatatable($data);
        $categories = $this->getAllData('categories', 0);
        $categories = $this->addUserUpdateInfo($categories);
        $data['catogories'] = $categories;
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }
    
    /**
     * Add new categories.
     */
    public function add()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::CATEGORY;
        $data['focusSubMenu'] = 'CATEGORY_ADD';
        $data['contentName'] = 'admin/pages/news/category/add';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new category for table categories.
     */
    public function create()
    {
        if ($this->input->post()) {
            $category = $this->input->post();

            $category = $this->validateInfoCategory($category, 'admin/category/add');

            $this->createSave('categories', $category, 'thể loại', 'admin/category/list', 'admin/category/add');
        } else {
            redirect('404');
        }
    }

    /**
     * Get layout edit info category.
     */
    public function edit()
    {
        $category = $this->getDataById($this->uri->segment(4), 'categories');

        $this->isDelFlagData($category);

        $data['focusMenu'] = $this::CATEGORY;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/news/category/edit';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['category'] = $category;
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update category info for table categories
     */
    public function update()
    {
        if ($this->input->post()) {
            $category = $this->input->post();

            $category = $this->validateInfoCategory($category, 'admin/category/edit/' . $category['id']);

            $category = $this->setDefaultUpdateData($category);

            $this->updateSave('categories', $category, 'thể loại', 'admin/category/edit/' . $category['id']);
        } else {
            redirect('404');
        }
    }

    /** 
     * Delete categories, change del_flag
     */
    public function delete()
    {
        $idCategory = $this->uri->segment(4);

        $category = $this->getDataById($idCategory, 'categories');

        $this->isDelFlagData($category);

        try {
            $this->db->trans_begin();
            $types = $this->db->where('id_category', $idCategory)->select('id')->get('types')->result_array();
            $types = implode(',', array_column($types, 'id'));
            $posts = $this->db->where_in('id_type', $types)->select('id')->get('posts')->result_array();
            $posts = implode(',', array_column($posts, 'id'));
            // Update del_flag comments
            $this->db->where_in('id_post', $posts)->set('del_flag', 1)->update('comments');
            // Update del_flag posts
            $this->db->where_in('id_type', $types)->set('del_flag', 1)->update('posts');
            // Update del_flag types
            $this->db->where('id_category', $idCategory)->set('del_flag', 1)->update('types');
            // Update del_flag categories
            $this->db->where('id', $idCategory)->set('del_flag', 1)->update('categories');
            // Start write histoty
			$this->insertHistory('categories', $idCategory, $this->session->userdata('loginInfo')->id, 'DELETE', 'Thể loại');
			// End write histoty
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thể loại đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/category/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/category/list');
        }
    }

    /**
     * Validate update category
     */
    private function validateInfoCategory($requestData, $urlBack)
    {
        $form_rules = array(
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
