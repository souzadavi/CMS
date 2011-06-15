<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	function __construct()
	{
		parent::__construct();
                $this->load->helper('form');
                $this->load->library('tank_auth');
				$this->load->library('permissions');
	}

	function index()
	{
		
	if (!$this->tank_auth->is_logged_in()) {
						redirect(base_cms().'login');
						
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
			$this->load->view(base_cms().'inicial', $data);
		}
			//$this->load->view('labmin/login', $data);
			//$this->smarty->view('labmin/login.tpl');              
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */