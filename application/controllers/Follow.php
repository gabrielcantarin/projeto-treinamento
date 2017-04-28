<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow extends CI_Controller {

    function  __construct() {
        parent::__construct();
        
        loged();
        hasLocation();
        $this->load->model('Usuario_model');
        $this->load->model('Post_model');
        $this->load->model('Follow_model');
    }

    public function listFollow($username)
    {
        $data['user'] = $this->Usuario_model->getUserByUsername($username);

        $listFollowComplete = $this->Follow_model->imFollowing($data['user']->id);
        $listFollow = arr2col($listFollowComplete, "username");
        $listFollow[] = $this->session->userdata('username');

        $data['should_follow'] = $this->Follow_model->shouldFollow($listFollow);
        $data['imFollowing'] = $listFollowComplete;

        // imprimir($data,1);

        $this->load->view('header');
        $this->load->view('follow',$data);
        $this->load->view('footer');
    }

    public function listFollowed($username)
    {
        $data['user'] = $this->Usuario_model->getUserByUsername($username);

        $listFollowComplete = $this->Follow_model->imFollowing($data['user']->id);
        $listFollow = arr2col($listFollowComplete, "username");
        $listFollow[] = $this->session->userdata('username');

        $data['should_follow'] = $this->Follow_model->shouldFollow($listFollow);
        $followed = $this->Follow_model->followingMe($data['user']->id);

        foreach($followed as $f){
            if($this->Follow_model->isAlreadyFollower($data['user']->id, $f->user_id)){
                $f->isAlreadyFollower = 1;
                $data['followingMe'][] = $f;
            }else{
                $f->isAlreadyFollower = 0;
                $data['followingMe'][] = $f;
            }
        }

        $this->load->view('header');
        $this->load->view('followed',$data);
        $this->load->view('footer');
    }

    public function followUser($follow)
    {
        $user_id = $this->session->userdata('id');
        $username = $this->session->userdata('username');

        if($user_id != $follow){
            if(!$this->Follow_model->isAlreadyFollower($user_id, $follow)){
                $this->Follow_model->follow($user_id, $follow);
                $this->Usuario_model->updateFollow($user_id, 1);
                $this->Usuario_model->updateFollowed($follow, '+1');
                $this->Usuario_model->createSession($username);
            }
        }
        redirect_back();
    }

    public function unfollowUser($follow)
    {
        $user_id = $this->session->userdata('id');
        $username = $this->session->userdata('username');

        if($user_id != $follow){
            if($this->Follow_model->isAlreadyFollower($user_id, $follow)){
                $this->Follow_model->unfollow($user_id, $follow);
                $this->Usuario_model->updateFollow($user_id, -1);
                $this->Usuario_model->updateFollowed($follow, '-1');
                $this->Usuario_model->createSession($username);
            
            }
        }

        redirect_back();
    }

}
