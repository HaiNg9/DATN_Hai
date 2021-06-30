<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['title'] = 'Trang chủ';
		$data['contentName'] = "user/pages/home";
		$data['script'] = [
            'public/user/js/event.js'
		];

		$colSelectPosts = 'posts.*, users.display_name as user_post_name, types.name as type_name';
		$colSelectPosts .= ', (SELECT COUNT(id_post) FROM comments WHERE id_post = posts.id) as count_comments';
		$topThirdPosts = $this->db->select($colSelectPosts)->from('posts')
                             ->join('users', 'users.id = posts.id_user')
							 ->join('types', 'types.id = posts.id_type')
							 ->order_by('rand()')
							 ->limit(3)
							 ->get()->result_array();
		
		$data['top1Posts'] = $topThirdPosts[0] ?? null;
		$data['top2Posts'] = $topThirdPosts[1] ?? null;
		$data['top3Posts'] = $topThirdPosts[2] ?? null;								  
		
		$data = $this->setDataRightMenuUser($data);
		$data = $this->setDataCommonUser($data);
		$this->load->view('user/main', $data);
	}

	/**
	 * Subscribe for send news posts
	 */
	public function subscribe()
	{
		if ($this->input->post()) {
            $data = $this->validateInfoCreateSubscribe($this->input->post());

            try {
				$this->db->insert('subscribe', $data);
				$success = $this->setMessages(ResultUtils::STATUS_CODE_OK, ['Thông tin đã được đăng ký, bạn sẽ được nhận thông báo từ cập nhật mới nhất của chúng tôi!']);
				$this->session->set_flashdata('messages', $success);
			} catch (Exception $e) {
				$errors = $this->setMessages(ResultUtils::STATUS_CODE_ERR, $e);
				$this->session->set_flashdata('messages', $errors);
			}
        } else {
            redirect('404');
		}
		redirect('trang-chu.html');
	}

	/**
	 * Validate info create subscribe
	 */
	private function validateInfoCreateSubscribe($requestData){
		$form_rules = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|max_length[100]|is_unique[subscribe.email]',
                'errors' => array(
					'required' => '{field} không được để trống.',
					'valid_email' => '{field} không hợp lệ, vui lòng kiểm tra lại',
					'max_length' => '{field} quá dài, chỉ được nhập {param} kí tự.',
					'is_unique' => '{field} này đã được đăng ký nhận thông báo trước đó.'
                )
            ),
            array(
                'field' => 'name',
                'label' => 'Tên',
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
            redirect('trang-chu.html');
        }

        return $requestData;
	}
}
