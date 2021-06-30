<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type extends CI_Controller
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
     * Type controller user.
     */
    public function index()
    {
        $data['title'] = 'Loại tin';
        $data['contentName'] = "user/pages/type";
        $data['script'] = [
            'public/user/js/event.js'
        ];

        $idType = $this->uri->segment(2);

        $page = $this->uri->segment(3) ? $this->uri->segment(3) : '1';

        $this->load->library("pagination");
        $config['base_url'] = base_url() . 'loai-tin/' . $idType;
        $config['per_page'] = 3;
        $config['total_rows'] = $this->countAll($idType);
        $config = $this->setConfigPaginate($config);

        $this->pagination->initialize($config);

        $this->load->library('pagination', $config);

        $data['posts'] = $this->getPostsByCategory($idType, $config['per_page'], $page);

        $data["links"] = $this->pagination->create_links();

        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }

    public function countAll($idType)
    {
        $colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data = $this->db->select($colSelectPosts)
            ->from('posts')
            ->where('posts.del_flag', 0)
            ->where('types.id', $idType)
            ->join('users', 'users.id = posts.id_user')
            ->join('types', 'types.id = posts.id_type')
            ->get()->num_rows();
        return $data;
    }

    public function getPostsByCategory($idCategory, $total, $start)
    {
        $colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data = $this->db->select($colSelectPosts)
                                  ->from('posts')
                                  ->where('posts.del_flag', 0)
                                  ->where('types.id_category', $idCategory)
                                  ->join('users', 'users.id = posts.id_user')
                                  ->join('types', 'types.id = posts.id_type')
                                  ->limit($total, (int)$start - 1)
                                  ->get()->result_array();
        return $data;
    }
}
