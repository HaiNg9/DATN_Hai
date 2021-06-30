<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends My_Controller
{
    /**
     * @var Title
     */
    private const TITLE = 'Nhân viên - Quản trị';

    /**
     * @var ShowMenu
     */
    private const EMPLOYEES = 'EMPLOYEES';

    /**
     * Get list employees.
     */
    public function list()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::EMPLOYEES;
        $data['focusSubMenu'] = 'EMPLOYEES_LIST';
        $data['contentName'] = 'admin/pages/employee/list';
        $data = $this->setLayoutDatatable($data);
        $employees = $this->getAllData('employees', 0);
        $employees = $this->addUserUpdateInfo($employees);
        $data['employees'] = $employees;
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new employees.
     */
    public function add()
    {
        $data['focusMenu'] = $this::EMPLOYEES;
        $data['focusSubMenu'] = 'EMPLOYEES_ADD';
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/employee/add';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['positions'] = $this->getAllData('positions', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Add new employee for table employees.
     */
    public function create()
    {
        if ($this->input->post()) {
            $employee = $this->validateInfoCreateEmployee($this->input->post(), 'admin/employee/add');

            if (!empty($_FILES['img_employee']['name'])) {
                $employee['img'] = $this->uploadImageEmployee($_FILES['img_employee']['name']);
            }

            $this->createSave('employees', $employee, 'nhân viên', 'admin/employee/list', 'admin/employee/add');
        } else {
            redirect('404');
        }
    }

    /**
     * Get layout edit info employees.
     */
    public function edit()
    {
        $idEmployee = $this->uri->segment(4);
        $employee = $this->getDataById($idEmployee, 'employees');
        
        $this->isDelFlagData($employee);

        $data['focusMenu'] = $this::EMPLOYEES;
        $data['title'] = $this::TITLE;
        $data['contentName'] = 'admin/pages/employee/edit';
        $data['script'] = [
            'public/admin/js/event.js'
        ];
        $data['employee'] = $employee;
        $data['positions'] = $this->getAllData('positions', 0);
        $data = $this->setDataHeader($data);
        $this->load->view('admin/main', $data);
    }

    /**
     * Update employee info for table employees
     */
    public function update()
    {
        if ($this->input->post()) {
            $employee = $this->input->post();

            $employee = $this->validateInfoCreateEmployee($employee, 'admin/employee/edit/'. $employee['id']);

            if (!empty($_FILES['img_employee']['name'])) {
                $employee['img'] = $this->uploadImageEmployee($_FILES['img_employee']['name']);
            }

            $employee = $this->setDefaultUpdateData($employee);

            $this->updateSave('employees', $employee, 'nhân viên', 'admin/employee/edit/' . $employee['id']);
        } else {
            redirect('404');
        }
    }

    /**
     * Delete employee by primary key.
     */
    public function delete()
    {
        $employeeID = $this->uri->segment(4);
        $employee = $this->getDataById($employeeID, 'employees');

        $this->isDelFlagData($employee);

        try {
            $this->db->trans_begin();
            // Update del_flag employees
            $this->db->where_in('id', $employeeID)->set('del_flag', 1)->update('employees');
            // Start write histoty
			$this->insertHistory('employees', $employeeID, $this->session->userdata('loginInfo')->id, 'DELETE', 'Nhân viên');
			// End write histoty
            $this->db->trans_commit();
            $success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Nhân viên đã xóa bỏ khỏi hệ thống.']);
			$this->session->set_flashdata('messages', $success);
            redirect('admin/employee/list');
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/employee/list');
        }
    }

    /**
     * Validate update user
     */
    private function validateInfoCreateEmployee($requestData, $urlBack)
    {   
        $form_rules = array(
            array(
                'field' => 'id_position',
                'label' => 'Chức vụ',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => '{field} chưa tồn tại, vui lòng thêm mới.',
                )
            ),
            array(
                'field' => 'name',
                'label' => 'Tên nhân viên',
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

    /**
     * Upload image avatar for user 
     */
    private function uploadImageEmployee($file)
    {
        define('URL', './public/admin/upload/images/employee/');
        $ArrNameImage = explode('.', $file);
        $nameImage = 'employee' . time() . '.' . end($ArrNameImage);
        $oldFile = URL . $nameImage;
        if (file_exists($oldFile)) {
            unlink($oldFile);
        }
        move_uploaded_file($_FILES['img_employee']['tmp_name'], $oldFile);
        return $nameImage;
    }
}
