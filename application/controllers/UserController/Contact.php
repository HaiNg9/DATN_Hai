<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{
    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Employee controller user.
     */
    public function index()
    {
        $data['title'] = 'Thể loại';
        $data['contentName'] = "user/pages/contact";
        $data['script'] = [
            'public/user/js/event.js'
        ];

        // $colSelect = 'positions.*, (SELECT COUNT(id_position) FROM employees WHERE id_position = positions.id) as count_employees';
        // $data['positions'] = $this->db->select($colSelect)
        //                           ->where('del_flag', 0)
        //                           ->limit(4)->order_by('rand()')
        //                           ->get('positions')
        //                           ->result_array();

        // $data['employees'] = $this->db->select('employees.*, positions.name as name_position')
        //                           ->from('employees')
        //                           ->join('positions', 'employees.id_position = positions.id')
        //                           ->where('employees.del_flag', 0)
        //                           ->limit(4)->order_by('rand()')
        //                           ->get()->result_array();

		$data = $this->setDataRightMenuUser($data);
        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }
}
