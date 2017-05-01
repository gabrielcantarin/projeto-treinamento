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
        $username = $this->session->userdata('username');

        $data['user'] = $this->Usuario_model->getUserByUsername($username);
        $this->form_validation->set_rules('name', 'Nome Completo', 'trim|required|min_length[6]|max_length[50]');        

        if (isset($_POST['username']) && $_POST['username'] != $username) {
            $this->form_validation->set_rules('username', 'Nome de Usuário', 'trim|alpha|required|min_length[6]|max_length[50]|is_unique[Usuario.username]');
        }


        if ($this->form_validation->run())
        {
            $this->session->set_flashdata('success', '<p>Dados atualizados com sucesso!</p>');
            $this->Usuario_model->update();
        }

        $this->load->view('header');
        $this->load->view('config_user_data', $data);
        $this->load->view('footer');

        
    }

    public function profilePhoto()
    {
        $config['upload_path']          = 'media';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 512;
        $config['min_width']            = 300;
        $config['min_height']           = 300;
        $config['max_width']            = 2500;
        $config['max_height']           = 2500;
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;
        $config['file_ext_tolower']     = TRUE;
        $data["message"]['error'] =  "";
        $data["message"]['success'] =  "";

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upload'))
        {
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            {
                $data["message"]['error'] = $this->upload->display_errors();
            }
        } else {
            $upload_data = $this->upload->data();
            $data['upload_data'] = $upload_data;

            $newname = image('media/'.$upload_data['file_name'],'square');
            $data['upload_data']['file_name'] =  explode("/",$newname)[1];
             
            $this->Usuario_model->updateUserPhoto($this->session->userdata('id'), $data);
            $this->Usuario_model->createSession($this->session->userdata('username'));
            redirect(base_url($newname));
        }

        $this->load->view('header');
        $this->load->view('config_user_profile', $data);
        $this->load->view('footer');
    }

    public function coverPhoto()
    {
        $config['upload_path']          = 'media';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 512;
        $config['min_width']            = 300;
        $config['min_height']           = 300;
        $config['max_width']            = 2500;
        $config['max_height']           = 2500;
        $config['encrypt_name']         = TRUE;
        $config['remove_spaces']        = TRUE;
        $config['file_ext_tolower']     = TRUE;
        $data["message"]['error'] =  "";
        $data["message"]['success'] =  "";

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('upload'))
        {
            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            {
                $data["message"]['error'] = $this->upload->display_errors();
            }
        } else {
            $upload_data = $this->upload->data();
            $data['upload_data'] = $upload_data;

            $newname = image('media/'.$upload_data['file_name'],'wide');
            $data['upload_data']['file_name'] =  explode("/",$newname)[1];

            $this->Usuario_model->updateUserCover($this->session->userdata('id'), $data);
            $this->Usuario_model->createSession($this->session->userdata('username'));
            redirect(base_url($newname));
            // imprimir($newname,1);
        }

        $this->load->view('header');
        $this->load->view('config_user_cover', $data);
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
            $this->Usuario_model->updateLiveLocationUser($_POST['lat'], $_POST['log'], $_POST['city'], $data['user']->id);
            $this->session->set_flashdata('success', '<p>Localização Atualizada com Sucesso.</p>');

            $this->load->view('header');
            $this->load->view('config_user_localization', $data);
            $this->load->view('footer');
        }

    }

    public function check_username()
    {
        if ($_POST['email'] == $this->session->userdata('username'))
        {
                $this->form_validation->set_message('check_login', 'E-mail/Senha está incorreto.');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    
    }

    

}
