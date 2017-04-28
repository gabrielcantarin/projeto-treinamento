<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    function  __construct() {
        parent::__construct();
        
        loged();
        $this->load->model('Usuario_model');
        $this->load->model('Post_model');
        $this->load->model('Follow_model');
    }

	public function index()
    {
        $data['user'] = $this->Usuario_model->getUserByUsername($this->session->userdata('username'));

        $this->load->view('header');
        $this->load->view('config_user_data', $data);
        $this->load->view('footer');
    }

    public function profilePhoto()
    {
        if(isset($_POST['img'])){

            $file = upload_ajax($_POST['img']);
            $this->Usuario_model->updateUserPhoto($this->session->userdata('id'), $file);
            $this->Usuario_model->createSession($this->session->userdata('username'));
        }
        $this->load->view('header');
        $this->load->view('config_user_profile');
        $this->load->view('footer');
    }

    public function coverPhoto()
    {
        if(isset($_POST['img'])){

            $file = upload_ajax($_POST['img']);
            $this->Usuario_model->updateUserCover($this->session->userdata('id'), $file);
            $this->Usuario_model->createSession($this->session->userdata('username'));
        }
        $this->load->view('header');
        $this->load->view('config_user_cover');
        $this->load->view('footer');
    }

    public function localization()
    {
        $data['user'] = $this->Usuario_model->getUserByUsername($this->session->userdata('username'));

        $this->form_validation->set_rules('lat', 'Localização', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('config_user_localization', $data);
            $this->load->view('footer');
            
        } else {
            $this->Usuario_model->updateLiveLocationUser($_POST['lat'], $_POST['log'], $_POST['city']);
            $this->Usuario_model->createSession($data['user']->username);

            $this->load->view('header');
            $this->load->view('config_user_localization', $data);
            $this->load->view('footer');
        }

    }

    

}
