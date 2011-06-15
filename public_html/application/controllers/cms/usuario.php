<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->lang->load('tank_auth');
		
		$this->load->library('tank_auth');
		$this->load->library('permissions');
		//$this->load->library('pagination');
		$this->load->Model(base_cms()."Usuario_model");
		if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms().'login');
		}
		$this->permissions->check_permission(4);
	}

    function index() {
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		$data['usuarios'] =  $this->Usuario_model->getAllUsuario();
		$this->load->view(base_cms().'usuario', $data);
	}

	/*
	function atualizar($id){
		$array = array(
						'id' => $id,
						'texto' => $this->input->post('texto')
				);
		$this->Conteudo_model->atualizar($id, $array);
		redirect('/labmin/conteudo/detalhes/'.$id);
	}
	*/
	
	function novo(){
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$this->permissions->check_permission(4); // verifica se tem permissão para criar novo usuário
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		//$this->register();
		$data['modo'] = 'novo';
		
		$this->load->view(base_cms().'usuarioDetalhes', $data);
	}
	
	function senha(){
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		
		$this->permissions->check_permission(8); // verifica se tem permissão para criar novo usuário
		
		$data['modo'] = 'senha';
		$this->load->view(base_cms().'usuarioDetalhes', $data);
	}
	
	function detalhes($id){
		$data['modo'] = 'senha';
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		
		$this->permissions->check_permission(12); // verifica se tem permissão para criar novo usuário
		
		$data['modo'] = 'profile';
		$data['id'] = $id;
		if($this->Usuario_model->getProfile($id)->num_rows() > 0){
			$data['usuario'] = $this->Usuario_model->getProfile($id)->row();
		}else{
			$data['usuario'] = "";
		}
		$this->load->view(base_cms().'usuarioDetalhes', $data);
	}

	function profile(){
		$id = $this->input->post('id');
		$array = array(
						'user_id' => $id,
						'name' => $this->input->post('name')
				);

		$this->Usuario_model->atualizarProfile($id, $array);
		redirect('/'.base_cms().'usuario');
	}
	/*
	function email($id){
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		
		$this->permissions->check_permission(8); // verifica se tem permissão para criar novo usuário
		
		$data['modo'] = 'senha';
		//$data['usuario'] =  $this->Usuario_model->getUsuario();
		
		$this->load->view('labmin/usuarioDetalhes', $data);
	}
	*/
	function status($id, $status){
		$this->permissions->check_permission(6); // verifica se tem permissão para alterar status
		$array = array(
						'id' => $id,
						'activated' => $status
				);
		$this->Usuario_model->atualizar($id, $array);
		redirect('/'.base_cms().'usuario');
	}
	
	function permissao($id, $idPermissao = "", $tipo=""){
		$this->load->Model(base_cms()."Permissao_model");
		
		if($tipo == "alterar" && $idPermissao != ""){
			$this->permissions->check_permission(4);
			$this->Permissao_model->atualizar($id, $idPermissao);
			redirect("/".base_cms()."usuario/permissao/".$id);
		}

		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$data['menuLinks'] 	= $this->permissions->monta_menu();// montar menu superior
		$data['menus'] = $this->permissions->monta_menu(4);// montar menu lateral
		$this->permissions->check_permission(9);

		$data['usuario'] = $this->Usuario_model->getUsuario($id)->row();
		$data['permissoes'] = $this->Permissao_model->listar($id)->result();

		//echo var_dump($data['permissoes']);
		$this->load->view(base_cms().'permissao', $data);
	}
}