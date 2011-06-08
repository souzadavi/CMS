<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conteudo extends CI_Controller {

    public function index($id)
	{
            $this->load->Model(base_cms() . "conteudo_model");
            $data['conteudo'] = $this->conteudo_model->getConteudo($id)->row();
            
            $this->load->view('conteudo', $data);
	}
}