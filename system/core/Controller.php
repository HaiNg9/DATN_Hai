<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');
include(APPPATH . 'core/ResultUtils.php');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller
{

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance = &$this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class) {
			$this->$var = &load_class($class);
		}

		$this->load = &load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->load->library("pagination");
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

	/**
	 * Set messages
	 */
	public function setMessages($status, $message)
	{
		switch ($status) {
			case ResultUtils::STATUS_CODE_OK:
				$errors['status'] = ResultUtils::STATUS_CODE_OK;
				break;
			case ResultUtils::STATUS_CODE_ERR:
				$errors['status'] = ResultUtils::STATUS_CODE_ERR;
				break;
			case ResultUtils::STATUS_CODE_INFO:
				$errors['status'] = ResultUtils::STATUS_CODE_INFO;
				break;
		}
		$errors['messages'] = $message;
		return $errors;
	}

	/**
	 * get data common layout user
	 */
	public function setDataCommonUser($data)
	{
		// HEADER
		$data['categoriesHeader'] = $this->getAllData('categories', 0);
		$typesHeader = $this->db->where('del_flag', 0)
							->order_by('rand()')
							->limit(3)->get('categories')
							->result_array();
		for ($index = 0; $index <= count($typesHeader) - 1; $index++) {
			$typesHeader[$index]['types'] = $this->db->where('id_category', $typesHeader[$index]['id'])
												 ->where('del_flag', 0)
												 ->order_by('rand()')
												 ->limit(5)->get('types')
												 ->result_array();
		}
		$data['typesHeader'] = $typesHeader;
		$data['newsHeader'] = $this->db->where('del_flag', 0)
							->order_by('rand()')
							->limit(2)->get('posts')
							->result_array();

		// Common
		$data['newPosts'] = $this->db->where('del_flag', 0)
								 ->order_by('id', 'DESC')
								 ->limit(10)
								 ->get('posts')
								 ->result_array();
		$data['topPosts'] = $this->db->where('del_flag', 0)
								 ->order_by('like', 'DESC')
								 ->limit(24)
								 ->get('posts')
								 ->result_array();

		$data['homeData'] = $this->db->get('homes')->row();						 

		// FOOTER
		$typesFooter = $this->db->where('del_flag', 0)
							->order_by('rand()')
							->limit(4)->get('categories')
							->result_array();
		for ($index = 0; $index <= count($typesFooter) - 1; $index++) {
			$typesFooter[$index]['types'] = $this->db->where('id_category', $typesFooter[$index]['id'])
												 ->where('del_flag', 0)
												 ->order_by('rand()')
												 ->limit(10)->get('types')
												 ->result_array();
		}
		$data['typesFooter'] = $typesFooter;
							 
		return $data;
	}

	public function setDataRightMenuUser($data)
	{
		$colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
		$colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
		
		$data['newsRightMenu'] = $this->db->select($colSelectPosts)->from('posts')
									  ->join('users', 'users.id = posts.id_user')
									  ->join('types', 'types.id = posts.id_type')
									  ->order_by('rand()')
									  ->limit(6)
									  ->get()->result_array();

		$data['top4Posts'] = $this->db->select($colSelectPosts)->from('posts')
								  ->join('users', 'users.id = posts.id_user')
								  ->join('types', 'types.id = posts.id_type')
								  ->order_by('like', 'DESC')
								  ->limit(4)
								  ->get()->result_array();

		$data['topPosts'] = $this->db->select($colSelectPosts)->from('posts')
								  ->join('users', 'users.id = posts.id_user')
								  ->join('types', 'types.id = posts.id_type')
								  ->order_by('rand()')
								  ->limit(6)
								  ->get()->result_array();

		$data['newPosts'] = $this->db->select($colSelectPosts)->from('posts')
								  ->join('users', 'users.id = posts.id_user')
								  ->join('types', 'types.id = posts.id_type')
								  ->order_by('id', 'DESC')
								  ->limit(6)
								  ->get()->result_array();
		return $data;
	}

	/**
	 * Get data only row from table by id
	 */
	public function getDataById($id, $tableName)
	{
		return $this->db->where('id', $id)->get($tableName)->row();
	}

	/**
	 * Get all data from table
	 */
	public function getAllData($tableName, $delFlag)
	{
		return $this->db->where('del_flag', $delFlag)->get($tableName)->result_array();
	}

	/**
	 * Config pagination
	 */
	public function setConfigPaginate($config)
	{
        $config['use_page_numbers'] = TRUE;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination mt-50">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = '<li class="page-item page-link"><i class="fa fa-angle-double-left"></i></li>';
         
        $config['last_link'] = '<li class="page-item page-link"><i class="fa fa-angle-double-right"></li></i>';
         
        $config['next_link'] = '<li class="page-item page-link"><i class="fa fa-angle-right"></i></li>';

        $config['prev_link'] = '<li class="page-item page-link"><i class="fa fa-angle-left"></i></li>';

        $config['cur_tag_open'] = '<li class="page-item active page-link"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';
		return $config;
	}

	/**
	 * Reset session login info
	 */
	public function resetSessionLogin()
	{
		$loginInfo = $this->db->where('id', $this->session->userdata('loginInfo')->id)->get('users')->row();
		unset($loginInfo->password);
		$this->session->set_userdata('loginInfo', $loginInfo);
	}
}
