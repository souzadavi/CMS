<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                $this->load->helper('form');
                $this->load->library('tank_auth');
	}

	function index()
	{
		
	if (!$this->tank_auth->is_logged_in()) {
			$this->load->view(base_cms().'login');
		}else {
            redirect(base_cms().'inicial');
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */