<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bin extends My_Controller
{
    /**
     * @var Title
     */
    private const TITLE = 'Thùng rác - Quản trị';

    /**
     * @var News
     */
    private const BIN = 'BIN';

    /**
     * @var TableMenu
     */
    private const TABLE_MENU = [
        '0' => '',
        '1' => 'categories',
        '2' => 'types',
        '3' => 'posts',
        '4' => 'positions',
        '5' => 'employees',
        '6' => 'users',
        '7' => 'comments',
        '8' => 'subscribe',
    ];

    /**
     * Category page admin controller.
     */
    public function list()
    {
        $data['title'] = $this::TITLE;
        $data['focusMenu'] = $this::BIN;
        $data['contentName'] = 'admin/pages/bin/list';
        $data['tableID'] = '0';
        $data = $this->setLayoutDatatable($data);
        $data = $this->setDataHeader($data);
        $data['dataTables'] = null;
        if ($this->input->post() && $this->input->post()['table'] !== '0') {
            $idTable = $this->input->post()['table'];
            $tableName = $this::TABLE_MENU[$idTable];
            $data['dataTables'] = $this->getDeletedData($tableName);
            $data['tableID'] = $idTable;
        }
        $this->load->view('admin/main', $data);
    }

    /**
     * Revert data database
     */
    public function edit()
    {
        $params = array_filter(explode('-', $this->uri->segment(4)));

        if (count($params) != 2) {
            redirect('404');
        }

        $dataRevert = $this->getDataById($params[1], $this::TABLE_MENU[$params[0]]);

        if (!$dataRevert) {
            redirect('404');
        }

        $idRevert = $params[1];
        $tableName = $this::TABLE_MENU[$params[0]];

        try {
            $this->db->trans_begin();
            switch ($tableName) {
                case $this::TABLE_MENU['1']:
                    // categories
                    $types = $this->db->where('id_category', $idRevert)->select('id')->get('types')->result_array();
                    $types = implode(',', array_column($types, 'id'));
                    $posts = $this->db->where_in('id_type', $types)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Revert comments
                    $this->db->where_in('id_post', $posts)->set('del_flag', 0)->update('comments');
                    // Revert posts
                    $this->db->where_in('id_type', $types)->set('del_flag', 0)->update('posts');
                    // Revert types
                    $this->db->where('id_category', $idRevert)->set('del_flag', 0)->update('types');
                    // Revert categories
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('categories');
                    break;
                case $this::TABLE_MENU['2']:
                    // types
                    $posts = $this->db->where_in('id_type', $idRevert)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Revert comments
                    $this->db->where_in('id_post', $posts)->set('del_flag', 0)->update('comments');
                    // Revert posts
                    $this->db->where('id_type', $idRevert)->set('del_flag', 0)->update('posts');
                    // Revert types
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('types');
                    break;
                case $this::TABLE_MENU['3']:
                    // posts
                    // Revert comments
                    $this->db->where('id_post', $idRevert)->set('del_flag', 0)->update('comments');
                    // Revert posts
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('posts');
                    break;
                case $this::TABLE_MENU['4']:
                    // positions
                    // Revert employees
                    $this->db->where('id_position', $idRevert)->set('del_flag', 0)->update('employees');
                    // Revert positions
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('positions');
                    break;
                case $this::TABLE_MENU['5']:
                    // employees
                    // Revert employees
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('employees');
                    break;
                case $this::TABLE_MENU['6']:
                    // users
                    $posts = $this->db->where_in('id_user', $idRevert)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Revert comments
                    $this->db->where_in('id_post', $posts)->set('del_flag', 0)->update('comments');
                    // Revert posts
                    $this->db->where('id_user', $idRevert)->set('del_flag', 0)->update('posts');
                    // Revert users
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('users');
                    break;
                case $this::TABLE_MENU['7']:
                    // comments
                    // Revert comments
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('comments');
                    break;
                case $this::TABLE_MENU['8']:
                    // subscribe
                    // Revert subscribe
                    $this->db->where('id', $idRevert)->set('del_flag', 0)->update('subscribe');
                    break;
            }
            $this->db->trans_commit();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Dữ liệu đã được phục hồi']);
            $this->session->set_flashdata('messages', $errors);

            $data['title'] = $this::TITLE;
            $data['focusMenu'] = $this::BIN;
            $data['contentName'] = 'admin/pages/bin/list';
            $data['tableID'] = $params[0];
            $data = $this->setLayoutDatatable($data);
            $data = $this->setDataHeader($data);
            $data['dataTables'] = $this->getDeletedData($tableName);
            $this->load->view('admin/main', $data);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/bin/list');
        }
    }

    /**
     * Delete data database
     */
    public function delete()
    {
        $params = array_filter(explode('-', $this->uri->segment(4)));

        if (count($params) != 2) {
            redirect('404');
        }

        $dataDel = $this->getDataById($params[1], $this::TABLE_MENU[$params[0]]);

        if (!$dataDel) {
            redirect('404');
        }

        $idDel = $params[1];
        $tableName = $this::TABLE_MENU[$params[0]];
        try {
            $this->db->trans_begin();
            switch ($tableName) {
                case $this::TABLE_MENU['1']:
                    // categories
                    $types = $this->db->where('id_category', $idDel)->select('id')->get('types')->result_array();
                    $types = implode(',', array_column($types, 'id'));
                    $posts = $this->db->where_in('id_type', $types)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Delete comments
                    $this->db->where_in('id_post', $posts)->delete('comments');
                    // Delete posts
                    $this->db->where_in('id_type', $types)->delete('posts');
                    // Delete types
                    $this->db->where('id_category', $idDel)->delete('types');
                    // Delete categories
                    $this->db->where('id', $idDel)->delete('categories');
                    break;
                case $this::TABLE_MENU['2']:
                    // types
                    $posts = $this->db->where_in('id_type', $idDel)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Delete comments
                    $this->db->where_in('id_post', $posts)->delete('comments');
                    // Delete posts
                    $this->db->where('id_type', $idDel)->delete('posts');
                    // Delete types
                    $this->db->where('id', $idDel)->delete('types');
                    break;
                case $this::TABLE_MENU['3']:
                    // posts
                    // Delete comments
                    $this->db->where('id_post', $idDel)->delete('comments');
                    // Delete posts
                    $this->db->where('id', $idDel)->delete('posts');
                    break;
                case $this::TABLE_MENU['4']:
                    // positions
                    // Delete employees
                    $this->db->where('id_position', $idDel)->delete('employees');
                    // Delete positions
                    $this->db->where('id', $idDel)->delete('positions');
                    break;
                case $this::TABLE_MENU['5']:
                    // employees
                    // Delete employees
                    $this->db->where('id', $idDel)->delete('employees');
                    break;
                case $this::TABLE_MENU['6']:
                    // users
                    $posts = $this->db->where_in('id_user', $idDel)->select('id')->get('posts')->result_array();
                    $posts = implode(',', array_column($posts, 'id'));
                    // Delete comments
                    $this->db->where_in('id_post', $posts)->delete('comments');
                    // Delete posts
                    $this->db->where('id_user', $idDel)->delete('posts');
                    // Delete users
                    $this->db->where('id', $idDel)->delete('users');
                    break;
                case $this::TABLE_MENU['7']:
                    // comments
                    // Delete comments
                    $this->db->where('id', $idDel)->delete('comments');
                    break;
                case $this::TABLE_MENU['8']:
                    // subscribe
                    // Delete subscribe
                    $this->db->where('id', $idDel)->delete('subscribe');
                    break;
            }
            $this->db->trans_commit();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Dữ liệu đã được xóa vĩnh viễn khỏi hệ thống']);
            $this->session->set_flashdata('messages', $errors);

            $data['title'] = $this::TITLE;
            $data['focusMenu'] = $this::BIN;
            $data['contentName'] = 'admin/pages/bin/list';
            $data['tableID'] = $params[0];
            $data = $this->setLayoutDatatable($data);
            $data = $this->setDataHeader($data);
            $data['dataTables'] = $this->getDeletedData($tableName);
            $this->load->view('admin/main', $data);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
            $this->session->set_flashdata('messages', $errors);
            redirect('admin/bin/list');
        }
    }

    /**
     * Get Deleted Data from database
     */
    private function getDeletedData($table)
    {
        return $this->removeColNotShow($this->getAllData($table, 1));
    }

    /**
     * Remove colum not show in table data
     */
    private function removeColNotShow($dataTables)
    {
        $keysRemove = [
            'delete_by',
            'created_date',
            'created_by',
            'updated_date',
            'updated_by',
            'password',
            'role_number',
            'img',
            'content',
            'like',
            'del_flag',
            'id_type',
            'id_user',
            'id_category',
            'id_position',
        ];
        foreach ($dataTables as $dataKey => $dataValue) {
            foreach ($dataValue as $key => $value) {
                if (in_array($key, $keysRemove)) {
                    unset($dataTables[$dataKey][$key]);
                }
            }
        }
        return $dataTables;
    }
}
