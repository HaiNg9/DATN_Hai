<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends My_Controller {
    /**
     * @var Title
     */
    private const TITLE = 'Tin tức - Quản trị';

    /**
     * @var News
     */
    private const NEWS = 'NEWS';

	/**
	 * Category page admin controller.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::NEWS;
        $data['focusSubMenu'] = 'NEWS_LIST';
		$data['contentName'] = 'admin/pages/news/post/list';
        $data = $this->setLayoutDatatable($data);
        $colSelect = 'posts.*, types.name as name_type';
        $posts = $this->db->where('posts.del_flag', 0)
                          ->where('types.del_flag', 0)
                          ->select($colSelect)->from('posts')
                          ->join('types', 'types.id = posts.id_type')
                          ->get()->result_array();
        $posts = $this->addUserUpdateInfo($posts);
        $data['posts'] = $posts;
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }
    
    /**
     * Add new types.
     */
    public function add()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::NEWS;
        $data['focusSubMenu'] = 'NEWS_ADD';
        $data['contentName'] = 'admin/pages/news/post/add';
        $data['script'] = $this->setLayoutTinymce($data)['script'];
        $data['script'][] = 'public/admin/js/event.js';
        $data = $this->getAddCategoriesAndTypes($data);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    private function getAddCategoriesAndTypes($data)
    {
        $data['categories'] = $this->getAllData('categories', 0);
        if (empty($data['categories'])) {
            $infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Chưa có thể loại tin tức, vui lòng thêm một thể loại tin tức.']);
            $this->session->set_flashdata('messages', $infoMsg);
            redirect('admin/category/add');
        }

        if (empty($this->getAllData('types', 0))) {
            $infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_INFO, ['Chưa có loại tin tức, vui lòng thêm một loại tin tức.']);
            $this->session->set_flashdata('messages', $infoMsg);
            redirect('admin/type/add');
        }
        $data['types'] = $this->db->where('del_flag', 0)->where('id_category', $data['categories'][0]['id'])->get('types')->result_array();
        return $data;
    }

    /**
     * Add new category for table types.
     */
    public function create()
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $post = $this->validateInfoPost($post, 'admin/post/add');

            if (!empty($_FILES['img_post']['name'])) {
                $post['img'] = $this->uploadImagePost($_FILES['img_post']['name']);
            }
            
            unset($post['id_category']);

            $this->createSave('posts', $post, 'tin tức', 'admin/post/list', 'admin/post/add');
        } else {
            redirect('404');
        }
    }

    /**
     * Get layout edit info category.
     */
    public function edit()
    {
        $post = $this->getDataById($this->uri->segment(4), 'posts');

        $this->isDelFlagData($post);
        
        $data['focusMenu'] = $this::NEWS;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/news/post/edit';
        $data = $this->setLayoutDatatable($data);
        $tinyScripts = $this->setLayoutTinymce($data)['script'];
        foreach ($tinyScripts as $link) {
            $data['script'][] = $link;
        }
        $data['post'] = $post;
        $post->name_user_create = $this->getDataById($post->id_user, 'users')->display_name;
        $data['categories'] = $this->getAllData('categories', 0);
        $data['types'] = $this->getAllData('types', 0);
        $data['comments'] = $this->db->select('comments.*, users.display_name')->from('comments')
                             ->join('users', 'users.id = comments.id_user')
                             ->where('id_post', $post->id)
                             ->get()->result_array();
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update category info for table categories
     */
    public function update()
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $post = $this->validateInfoPost($post, 'admin/post/edit/' . $post['id']);

            if (!empty($_FILES['img_post']['name'])) {
                $post['img'] = $this->uploadImagePost($_FILES['img_post']['name']);
            }

            $post = $this->setDefaultUpdateData($post);

            unset($post['id_category']);

            $this->updateSave('posts', $post, 'tin tức', 'admin/post/edit/' . $post['id']);
        } else {
            redirect('404');
        }
    }

    /** 
     * Delete posts, change del_flag
     */
    public function delete()
    {
        $idPosts = $this->uri->segment(4);

        $posts = $this->getDataById($idPosts, 'posts');

        $this->isDelFlagData($posts);

        try {
            $this->db->trans_begin();
            // Update del_flag comments
            $this->db->where_in('id_post', $idPosts)->set('del_flag', 1)->update('comments');
            // Update del_flag posts
            $this->db->where('id', $idPosts)->set('del_flag', 1)->update('posts');
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Tin tức đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/post/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/post/list');
        }
    }

    /**
     * Ajax change types
     */
    public function getTypesByCategory()
    {
        if ($this->input->post()) { 
            $idCatagory = $this->input->post()['id'];
            $types = $this->db->where('del_flag', 0)->where('id_category', $idCatagory)->select('id, name')->get('types')->result_array();
            echo json_encode($types);
            die;
        }
        
    }

    /**
     * Upload image avatar for post
     */
    private function uploadImagePost($file)
    {
        define('URL', './public/admin/upload/images/post/');
        $ArrNameImage = explode('.', $file);
        $nameImage = 'post' . time() . '.' . end($ArrNameImage);
        $oldFile = URL . $nameImage;
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
        move_uploaded_file($_FILES['img_post']['tmp_name'], $oldFile);
        return $nameImage;
    }

    /**
     * Validate update type
     */
    private function validateInfoPost($requestData, $urlBack)
    {
        $form_rules = array(
            array(
                'field' => 'id_category',
                'label' => 'Thể loại tin tức',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => '{field} không được để trống.'
                )
            ),
            array(
                'field' => 'id_type',
                'label' => 'Loại tin tức',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => '{field} không được để trống.'
                )
            ),
            array(
                'field' => 'title',
                'label' => 'Tiêu đề',
                'rules' => 'trim|required|max_length[50]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
            array(
                'field' => 'description',
                'label' => 'Mô tả của tác giả',
                'rules' => 'trim|required|max_length[255]',
                'errors' => array(
                    'required' => '{field} không được để trống.',
                    'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.'
                )
            ),
            array(
                'field' => 'content',
                'label' => 'Nội dung',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => '{field} không được để trống.'
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
