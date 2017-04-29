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
        $listfollowing = $this->session->userdata('listfollowing');
        $listClosest = $this->Usuario_model->getClosestPeople(20);


        if($view == 'near'){
            $posts = $this->Post_model->getPostsOfListUsers($listClosest);
        }elseif($view == 'follow'){
            $posts = $this->Post_model->getPostsOfListUsers($listfollowing);
        }else{
            $posts1 = $this->Post_model->getPostsOfListUsers($listClosest);
            $posts2 = $this->Post_model->getPostsOfListUsers($listfollowing);
            $posts = array_merge($posts1, $posts2);

            usort($posts, function($a, $b) {
                return strtotime($b->date) - strtotime($a->date);
            });
            $posts = unique_multidim_array($posts, 'id_post');
        }

        $data['posts'] = $this->Like_model->getLikesOfListPosts($posts, $user_id);
        $data['should_follow'] = $this->Follow_model->shouldFollow();

        $this->load->view('header');
        $this->load->view('timeline', $data);
        $this->load->view('footer');
    }

    public function getPost($id_post)
    {
        $data['post'] = $this->Post_model->getPost($id_post);

        $this->load->view('header');
        $this->load->view('post', $data);
        $this->load->view('footer');
    }

    
}
