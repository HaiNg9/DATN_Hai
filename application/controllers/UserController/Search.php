<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
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
     * Search controller user.
     */
    public function index()
    {
        $data['title'] = 'Thể loại';
        $data['contentName'] = "user/pages/search";
        $data['script'] = [
            'public/user/js/event.js'
        ];

        $keySearch = $this->uri->segment(2);

        $page = $this->uri->segment(3) ? $this->uri->segment(3) : '1';

        $this->load->library("pagination");
        $config['base_url'] = base_url() . 'seach-home-user/' . $keySearch;
        $config['per_page'] = 9;
        $config['total_rows'] = $this->countAll($keySearch);
        $config = $this->setConfigPaginate($config);

        $this->pagination->initialize($config);

        $this->load->library('pagination', $config);

        $posts = $this->getPostsByKeySearch($keySearch, $config['per_page'], $page);

        for ($i = 0; $i < count($posts); $i++) {
            $posts[$i]['content'] = str_replace($keySearch, '<strong style="color : magenta;">'.$keySearch.'</strong>', $posts[$i]['content']);
        }

        $data['posts'] = $posts;

        $data["links"] = $this->pagination->create_links();

        $data["keySearch"] = $keySearch;

		$data = $this->setDataRightMenuUser($data);
        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }

    public function countAll($keySearch)
    {
        $colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data = $this->db->select($colSelectPosts)
            ->from('posts')
            ->where('posts.del_flag', 0)
            ->like('title', $keySearch)
            ->or_like('content', $keySearch)
            ->join('users', 'users.id = posts.id_user')
            ->join('types', 'types.id = posts.id_type')
            ->get()->num_rows();
        return $data;
    }

    public function getPostsByKeySearch($keySearch, $total, $start)
    {
        $colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data = $this->db->select($colSelectPosts)
                        ->from('posts')
                        ->where('posts.del_flag', 0)
                        ->like('title', $keySearch)
                        ->or_like('content', $keySearch)
                        ->join('users', 'users.id = posts.id_user')
                        ->join('types', 'types.id = posts.id_type')
                        ->limit($total, (int)$start - 1)
                        ->get()->result_array();
        return $data;
    }
}
