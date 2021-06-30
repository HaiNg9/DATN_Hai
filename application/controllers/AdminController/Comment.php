<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends My_Controller {
	/**
     * Edit del_flag comment.
     */
	public function edit()
	{
		$comment = $this->getDataById($this->uri->segment(4), 'comments');

        if (!$comment) {
			redirect('404');
		}

        $data = [
            'id' => $comment->id,
            'del_flag' => !$comment->del_flag,
        ];

        $this->updateSave('comments', $data, 'bình luận', 'admin/post/edit/' . $comment->id_post);
    }
}
