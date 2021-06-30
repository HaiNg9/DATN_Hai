<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
     * Category controller user.
     */
    public function index()
    {
        $data['title'] = 'Thể loại';
        $data['contentName'] = "user/pages/category";
        $data['script'] = [
            'public/user/js/event.js'
        ];

        $idCategory = $this->uri->segment(2);

        $page = $this->uri->segment(3) ? $this->uri->segment(3) : '1';

        $config['base_url'] = base_url() . 'the-loai/' . $idCategory;
		$config['per_page'] = 5;
        $config['total_rows'] = $this->countAll($idCategory);
        $config = $this->setConfigPaginate($config);

        $this->pagination->initialize($config);

        $this->load->library('pagination', $config);

        $data['posts'] = $this->getPostsByCategory($idCategory, $config['per_page'], $page);

        $data["links"] = $this->pagination->create_links();

        $data["newComments"] = $this->db->select('comments.created_date, posts.title, users.display_name, users.img, posts.id as posts_id')
                                        ->from('comments')
                                        ->where('comments.del_flag', 0)
                                        ->join('users', 'users.id = comments.id_user')
                                        ->join('posts', 'posts.id = comments.id_post')
                                        ->order_by('comments.id', 'DESC')
                                        ->limit(10)
                                        ->get()->result_array();
		$data = $this->setDataRightMenuUser($data);
        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }

    /**
     * Count row for paginate
     */
    public function countAll($idCategory)
    {
        $colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data = $this->db->select($colSelectPosts)
            ->from('posts')
            ->where('posts.del_flag', 0)
            ->where('types.id_category', $idCategory)
            ->join('users', 'users.id = posts.id_user')
            ->join('types', 'types.id = posts.id_type')
            ->get()->num_rows();
        return $data;
    }

    /**
     * get posts by category id
     */
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
