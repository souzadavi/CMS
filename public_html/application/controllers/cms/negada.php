<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Negada extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->library('tank_auth');
		$this->load->library('permissions');
		//$this->load->library('pagination');
		$this->load->Model(base_cms()."Usuario_model");
		if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms().'login');
		}
	}

    function index() {
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$this->load->view(base_cms().'negada', $data);
		
		
		///ENVIAR EMAIL COM DADOS
	}
}