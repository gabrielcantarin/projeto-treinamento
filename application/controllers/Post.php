<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    function  __construct() {
        parent::__construct();
        
        loged();
        hasLocation();
        $this->load->model('Usuario_model');
        $this->load->model('Post_model');
        $this->load->model('Follow_model');
        $this->load->model('Like_model');
    }

	public function create()
    {
        $this->form_validation->set_rules('message', 'Publicação', 'trim|required|max_length[250]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        } else {
            $this->Post_model->create();
            $this->Usuario_model->updateWaves($this->session->userdata('id'), 1);
            $this->Usuario_model->createSession($this->session->userdata('username'));
            redirect(base_url('timeline'));
        }
    }

    public function index($view = 'near')
    {
        $user_id = $this->session->userdata('id');
        
        $listFollow = arr2col($this->Follow_model->imFollowing($user_id), "username");
        $listFollow[] = $this->session->userdata('username');
        $listClosest = arr2col($this->Usuario_model->getClosestPeople(20), "username");


        if($view == 'near'){
            $data['posts'] = $this->Post_model->getPostsOfListUsers($listClosest);
        }elseif($view == 'follow'){
            $data['posts'] = $this->Post_model->getPostsOfListUsers($listFollow);
        }else{
            $teste1 = $this->Post_model->getPostsOfListUsers($listClosest);
            $teste2 = $this->Post_model->getPostsOfListUsers($listFollow);
            $data['posts'] = array_merge($teste1, $teste2);
            $new = [];
            usort($data['posts'], function($a, $b) {
                return strtotime($b->date) - strtotime($a->date);
            });
            $data['posts'] = unique_multidim_array($data['posts'], "id_post");
        }

        $data['posts'] = $this->Like_model->getLikesOfListPosts($data['posts'], $user_id);
        $data['should_follow'] = $this->Follow_model->shouldFollow($listFollow);

        $this->load->view('header');
        $this->load->view('timeline', $data);
        $this->load->view('footer');
    }

    
}
