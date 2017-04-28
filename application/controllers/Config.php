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
        $config['upload_path']          = 'media';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 512;
        $config['min_width']            = 300;
        $config['min_height']           = 300;
        $config['max_width']            = 1920;
        $config['max_height']           = 1920;
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
            $data["message"]['error'] =  "";
            $data["message"]['success'] =  "<p>Foto atualizada com Sucesso!</p>";
            redirect(base_url($newname));
        }

        $this->load->view('header');
        $this->load->view('config_user_profile', $data);
        $this->load->view('footer');
    }

    function create_thumb_gallery($upload_data, $source_img, $new_img, $width, $height)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_img;
        $config['create_thumb'] = FALSE;
        $config['new_image'] = $new_img;
        $config['quality'] = '100%';
         
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
         
        if ( ! $this->image_lib->resize() )
        {
            echo $this->image_lib->display_errors();
        }else{
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source_img;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['quality'] = '100%';
            $config['new_image'] = $source_img;
            $config['overwrite'] = TRUE;
            $config['width'] = $width;
            $config['height'] = $height;
            $dim = (intval($upload_data['image_width']) / intval($upload_data['image_height'])) - ($config['width'] / $config['height']);
            $config['master_dim'] = ($dim > 0)? 'height' : 'width';
             
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
         
            if ( ! $this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }else{
                return true;
            }
        }
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
