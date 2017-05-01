<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Like extends CI_Controller {

    function  __construct() {
        parent::__construct();
        
        loged();
        $this->load->model('Like_model');
        $this->load->model('Post_model');
    }

	public function likePost($post_id)
    {
        $user_id = $this->session->userdata('id');

        if(!$this->Like_model->hasAlreadyLiked($user_id, $post_id)){
            $this->Like_model->like($user_id, $post_id);
            $this->Post_model->updateLike($post_id,"+ 1" );
        }else{
            $this->Like_model->unlike($user_id, $post_id);
            $this->Post_model->updateLike($post_id,"- 1" );
        }

        redirect_back();
    }


}
