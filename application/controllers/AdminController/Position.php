<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position extends My_Controller
{
    /**
     * @var Title
     */
    private const TITLE = 'Chức vụ nhân viên - Quản trị';

    /**
     * @var TYPE
     */
    private const POSTION = 'POSTION';

    /**
     * Position page admin controller.
     */
    public function list()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::POSTION;
        $data['focusSubMenu'] = 'POSTION_LIST';
        $data['contentName'] = 'admin/pages/position/list';
        $data['positions'] = $this->getAllData('positions', 0);
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update position list.
     */
    public function update()
    {
        if ($this->input->post()) {
            $position = $this->validateInfoPosition($this->input->post(), 'admin/position/list');
            if (empty($position['id'])) {
                $this->createSave('positions', $position, 'chức vụ', 'admin/position/list', 'admin/position/list');
            } 
            $this->updateSave('positions', $position, 'chức vụ', 'admin/position/list');
        } else {
            redirect('404');
        }
    }

    public function delete()
    {
        $idPosition = $this->uri->segment(4);
        $position = $this->getDataById($idPosition, 'positions');

        $this->isDelFlagData($position);
        
        try {
            $this->db->trans_begin();
            // Update del_flag employees
            $this->db->where_in('id_position', $idPosition)->set('del_flag', 1)->update('employees');
            // Update del_flag positions
            $this->db->where('id', $idPosition)->set('del_flag', 1)->update('positions');
            // Start write histoty
			$this->insertHistory('positions', $idPosition, $this->session->userdata('loginInfo')->id, 'DELETE', 'Chức vụ');
			// End write histoty
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Chức vụ đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/position/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/position/list');
        }
    }

    /**
     * Validate update position
     */
    private function validateInfoPosition($requestData, $urlBack)
    {
        $form_rules = array(
            array(
                'field' => 'name',
                'label' => 'Tên chức vụ',
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
