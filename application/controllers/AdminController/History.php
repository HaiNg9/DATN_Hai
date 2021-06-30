<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends My_Controller {
    /**
     * @var Title
     */
    private const TITLE = 'Thông báo - Quản trị';

    /**
     * @var TYPE
     */
    private const TYPE = 'HISTORY';

	/**
	 * Category page admin controller.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::TYPE;
        $data['focusSubMenu'] = 'TYPE_LIST';
		$data['contentName'] = 'admin/pages/history/list';
        $data = $this->setLayoutDatatable($data);
        $data['oldHistory'] = $this->db->where('seen_flag', 1)->get('histories')->result_array();
        $data['newHistory'] = $this->db->where('seen_flag', 0)->get('histories')->result_array();
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }

    /**
     * Get layout edit info category.
     */
    public function edit()
    {
        $history = $this->getDataById($this->uri->segment(4), 'histories');

        if (!$history) {
			redirect('404');
		}
        $this->db->update('histories', ['seen_flag' => 1], 'id = ' . $history->id);

        $data['focusMenu'] = $this::TYPE;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/history/edit';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['history'] = $history;
        $data['users'] = $this->getDataById($history->user, 'users');
        $data['history'] = $history;
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update category info for table categories
     */
    public function update()
    {
        if ($this->input->post()) {
            $this->db->update('histories', ['seen_flag' => 1]);
            redirect($this->input->post()['url_back']);
        } else {
            redirect('404');
        }
    }

    /**
     * Update category info for table categories
     */
    public function delete()
    {
        $idHistory = $this->uri->segment(4);

        $history = $this->getDataById($idHistory, 'histories');

        if (!$history) {
			redirect('404');
        }
        
        try {
			$this->db->delete('histories', array('id' => $idHistory));
			$success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thông báo đã xóa bỏ vĩnh viễn khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
			redirect('admin/history/list');
		} catch (Exception $e) {
			$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
			$this->session->set_flashdata('messages', $errors);
            redirect('admin/history/list');
		}
    }
}
