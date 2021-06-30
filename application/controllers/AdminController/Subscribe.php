<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends My_Controller {
    /**
     * @var Title
     */
    private const TITLE = 'Nhận thông báo - Quản trị';

    /**
     * @var Subscribe
     */
    private const SUBSCRIBE = 'SUBSCRIBE';

	/**
	 * Subscribe page admin controller.
	 */
	public function list()
	{
		$data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::SUBSCRIBE;
        $data['focusSubMenu'] = $this::SUBSCRIBE;
		$data['contentName'] = 'admin/pages/subscribe/list';
        $data = $this->setLayoutDatatable($data);
        $data['subscribe'] = $this->db->where('del_flag', 0)
                                      ->get('subscribe')
                                      ->result_array();
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }

    /**
     * Get layout edit info category.
     */
    public function edit()
    {
        $idSub = $this->uri->segment(4);
        $subscribe = $this->getDataById($idSub, 'subscribe');

        $this->isDelFlagData($subscribe);
        
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::SUBSCRIBE;
        $data['focusSubMenu'] = $this::SUBSCRIBE;
		$data['contentName'] = 'admin/pages/subscribe/list';
        $data = $this->setLayoutDatatable($data);
        $data['subscribe'] = $this->db->where('id', $idSub)
                                      ->get('subscribe')
                                      ->result_array();
        $this->db->where('id', $idSub)->update('subscribe', ['seen_flag' => 1]);
        $data = $this->setDataHeader($data);
		$this->load->view('admin/main', $data);
    }

    /**
     * Update subscribe info for table subscribe
     */
    public function update()
    {
        if ($this->input->post()) {
            $this->db->update('subscribe', ['seen_flag' => 1]);
            redirect($this->input->post()['url_back']);
        } else {
            redirect('404');
        }
    }

    /** 
     * Delete subscribe, change del_flag
     */
    public function delete()
    {
        $idSub = $this->uri->segment(4);

        $subscribe = $this->getDataById($idSub, 'subscribe');

        $this->isDelFlagData($subscribe);

        try {
            $this->db->where_in('id', $idSub)->set('del_flag', 1)->update('subscribe');
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Email đăng ký đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/subscribe/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/subscribe/list');
        }
    }
}
