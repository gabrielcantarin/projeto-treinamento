<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
    {
        $this->load->view('header');

    	if(usuarioLogado()){
            redirect(base_url('timeline'));
    	}else{
        	$this->load->view('index');
        	$this->load->view('footer');
    	}
    }

    
}
