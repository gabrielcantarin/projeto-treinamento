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
        $this->load->model('Wave_model');
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
            redirect_back();
        }
    }

    public function wave($id_post)
    {
        $original = $this->Post_model->getPostById($id_post);
        $user_id = $this->session->userdata('id');

        if($original->user_id != $user_id){
            if(!$this->Wave_model->hasAlreadyWaved($user_id, $original->post_id)){
                $_POST['message'] = '';
                $_POST['lat'] = $this->session->userdata('last_lat');
                $_POST['log'] = $this->session->userdata('last_log');
                $_POST['father'] = $original->post_id;

                $this->Wave_model->wave($user_id, $id_post);
                $this->Post_model->updateWave($id_post,"+ 1" );
                $this->Post_model->create();
            }else{
                $this->Wave_model->unwave($user_id, $id_post);
                $this->Post_model->updateWave($id_post,"- 1" );
                $this->Post_model->removeWave($user_id, $id_post);
            }
        }
        redirect_back();
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

        $posts = $this->Like_model->getLikesOfListPosts($posts, $user_id);
        $data['posts'] = $this->Wave_model->getWavesOfListPosts($posts, $user_id);

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
