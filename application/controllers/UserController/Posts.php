<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
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
        $data['title'] = 'Bài viết';
        $data['contentName'] = "user/pages/posts";
        $data['script'] = [
            'public/user/js/event.js'
        ];

        $idPosts = $this->uri->segment(2);
        
        $posts = $this->db->where('id', $idPosts)->where('del_flag', 0)->get('posts')->row();

        if (!$posts) {
            redirect('404');
        }

        $colSelectPosts = 'posts.*, users.display_name as user_post_name, users.img as user_img, types.name as type_name';
        $colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
        $data['posts'] = $this->db->select($colSelectPosts)
            ->from('posts')
            ->where('posts.del_flag', 0)
            ->where('posts.id', $idPosts)
            ->join('users', 'users.id = posts.id_user')
            ->join('types', 'types.id = posts.id_type')
            ->get()->row();

        $data['postsInvolve'] = $this->db->select($colSelectPosts)
            ->from('posts')
            ->where('posts.del_flag', 0)
            ->where('posts.id !=', $idPosts)
            ->join('users', 'users.id = posts.id_user')
            ->join('types', 'types.id = posts.id_type')
            ->limit('2')
            ->order_by('rand()')
            ->get()->result_array();

        $data['comments'] = $this->db->select('comments.*, users.display_name as user_post_name, users.img as user_img')
            ->from('comments')
            ->where('comments.del_flag', 0)
            ->where('comments.id_post', $idPosts)
            ->join('users', 'users.id = comments.id_user')
            ->order_by('id', 'DESC')
            ->get()->result_array();


        $data['types'] = $this->db->where('types.id !=', $posts->id_type)->where('del_flag', 0)
                                  ->select('id, name')
                                  ->limit('5')
                                  ->order_by('rand()')
                                  ->get('types')->result_array();

		$data = $this->setDataRightMenuUser($data);
        $data = $this->setDataCommonUser($data);
        $this->load->view('user/main', $data);
    }

    /**
     * Send comment for posts
     */
    public function comment()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $dataSave = [
                'id_post' => $data['idPost'],
                'id_user' => $this->session->userdata('loginInfo')->id,
                'content' => $data['message'],
            ];
            $this->db->insert('comments', $dataSave);
            $infoMsg = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Bạn đã bình luận cho bài viết.']);
            $this->session->set_flashdata('messages', $infoMsg);
            redirect('bai-viet/' . $data['idPost']);
        } else {
            redirect('404');
        }
    }
}
