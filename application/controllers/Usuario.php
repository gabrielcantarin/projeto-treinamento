<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Post_model');
        $this->load->model('Follow_model');
        $this->load->model('Like_model');
        $this->load->model('Wave_model');
    }

    public function profile($username)
    {
        hasLocation();

        $data['user'] = $this->Usuario_model->getUserByUsername($username);
        $data['posts'] = $this->Post_model->getPostsOfListUsers([$data['user']]);
        $data['should_follow'] = $this->Follow_model->shouldFollow();
        $posts = $this->Like_model->getLikesOfListPosts($data['posts'], $this->session->userdata('id'));
        $data['posts'] = $this->Wave_model->getWavesOfListPosts($posts, $this->session->userdata('id'));

        $following = $this->Follow_model->isAlreadyFollower($this->session->userdata('id'), $data['user']->id);

        $data['user']->isAlreadyFollower = $following? 1 : 0;

        $this->load->view('header');
        $this->load->view('profile', $data);
        $this->load->view('footer');
    }

    public function register()
    {

        $this->form_validation->set_rules('name', 'Nome Completo', 'trim|required|min_length[6]|max_length[50]');        

        $this->form_validation->set_rules('username', 'Nome de Usuário', 'trim|alpha|required|min_length[6]|max_length[50]|is_unique[Usuario.username]');

        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|min_length[4]|max_length[150]|valid_email|is_unique[Usuario.email]');

        $this->form_validation->set_rules('pass', 'Senha', 'trim|required|min_length[6]|max_length[20]');
        $this->form_validation->set_rules('tos', 'Termos de Uso', 'callback_check_tos');


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('register');
            $this->load->view('footer');
        } else {
            $this->Usuario_model->insert();
            $this->send_email_register();
            redirect(base_url('timeline'));
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|min_length[4]|max_length[150]|valid_email');
        $this->form_validation->set_rules('pass', 'Senha', 'required|trim|min_length[6]|max_length[20]|callback_check_login');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('login');
            $this->load->view('footer');
        } else {
            $user = $this->Usuario_model->login();
            $this->load->view('header');
            redirect(base_url('timeline'));
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_userdata('id', null);
        redirect(base_url());
    }

    public function send_email_register()
    {
        $this->load->library('email');
        $this->email->from('contato@itswaving.com', 'ItsWaving');
        $this->email->to(["gabriel@nudestarter.com", "gabriel.simoes6@etec.sp.gov.br"]);
        $this->email->subject('ItsWaving - Confirmação de Cadastro');
        $this->email->message("E-mail teste");//email_confirmation($this->session->userdata())
        $this->email->send();
        imprimir($this->email->print_debugger());
        
        exit('aki');
    }

    public function forget()
    {
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|min_length[4]|max_length[150]|valid_email|callback_check_email_exist|callback_valid_user');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('header');
            $this->load->view('forget');
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('success', '<p>Acabamos de enviar um e-mail com o link para a criação de uma nova senha.</p>');
            redirect(current_url());
        }
    }

    public function check_tos() {
        if (isset($_POST['tos'])) {
            return true;
        }
        else 
        {
            $this->form_validation->set_message('check_tos', 'Você deve aceitar os Termos de Serviço.');
            return false;
        }
    }

    public function check_login($str)
    {
        if (!$this->Usuario_model->login())
        {
                $this->form_validation->set_message('check_login', 'E-mail/Senha está incorreto.');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }

    public function check_email_exist($str)
    {
        if (!$this->Usuario_model->emailAvaliable($str))
        {
                $this->form_validation->set_message('check_email_exist', 'E-mail ainda não cadastrado.');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }

    public function valid_user($str)
    {
        if (!$this->Usuario_model->validUser($str))
        {
                $this->form_validation->set_message('valid_user', 'E-mail não confirmado, acabamos de reenviar a confirmação, caso não encontre na sua caixa de entrada, verifique na lixeira ou na caixa de SPAM.');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }
}
