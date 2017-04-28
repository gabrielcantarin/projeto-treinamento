<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    function  __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Post_model');
        $this->load->model('Follow_model');
    }

    public function profile($username)
    {
        hasLocation();
        $listFollow = arr2col($this->Follow_model->imFollowing($this->session->userdata('id')), "username");
        $listFollow[] = $this->session->userdata('username');

        $data['posts'] = $this->Post_model->getPostsByUsername($username);
        $data['user'] = $this->Usuario_model->getUserByUsername($username);
        $data['should_follow'] = $this->Follow_model->shouldFollow($listFollow);

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
            // $this->emailConfirmacao($this->Usuario_model->login());
            $this->session->set_flashdata('success', '<p>Verifique sua caixa de entrada e verifique seu cadastro.</p>');
            redirect(current_url());
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
            $this->Usuario_model->createSession($user->username);
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
