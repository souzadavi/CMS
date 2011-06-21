<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Conteudo extends CI_Controller {

     function __construct() {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->load->library('mensagem');
        $this->load->library('session');
        $this->load->library('pagination');

        if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms() . 'login');
        }

        $this->load->Model(base_cms() . "poker_model");
        $this->config->load('poker');
        $this->load->library('permissions');
        $this->permissions->check_permission($this->config->item('poker'));
        $this->load->library('input');
    }


    function index() {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu(1); // montar menu lateral

        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }
        
        $data['conteudos'] = $this->Conteudo_model->getAllConteudo();
        $this->load->view(base_cms() . 'conteudo', $data);
        //redirect(base_cms().'destaquehome');
    }

    function detalhes($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('portfolio_detalhes')); // verifica se tem permissão para ver o conteudo
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['conteudo'] = $this->Conteudo_model->getConteudo($id)->row();
        $this->load->view(base_cms() . 'conteudoEditar', $data);
    }

    function atualizar($id) {
        $array = array(
            'id' => $id,
            'texto' => $this->input->post('texto'),
            'legenda' => $this->input->post('legenda')
        );
        $this->Conteudo_model->atualizar($id, $array);
        redirect(base_cms() . 'conteudo/detalhes/' . $id);
    }

    function upload($id) {
        //$this->load->helper(array('form', 'url'));
        /// Carregando arquivo de configuração
        $this->config->load("cms");
        /// setando configs para subir arquivo
        $config['allowed_types'] = $this->config->item('conteudo_allowed_types');
        $config['max_size'] = $this->config->item('conteudo_max_size');
        $config['max_width'] = $this->config->item('conteudo_max_width');
        $config['max_height'] = $this->config->item('conteudo_max_height');
        $config['upload_path'] = $this->config->item('path_temp'); //$_SERVER['DOCUMENT_ROOT']."/cliente/ohl/upload/temp/";
        // Nome da pasta que irá copiar o arquivo de imagem após envio e verificações
        $data['pastaFinal'] = $this->config->item('conteudo_path');
        /// FIM configs

        $this->load->library('upload', $config);

        $conteudo = $this->Conteudo_model->getConteudo($id)->row()->imagem;

        /// SUBIU A IMAGEM
        if ($this->upload->do_upload('image')) {
            //echo "subiu";
            $uploadLog = $this->upload->data();
            /// setando o nome da nova imagem
            $imgNomeNovo = url_title(uniqid() . "-" . $uploadLog['file_name']);

            $array = array(
                'id' => $id,
                'imagem' => $imgNomeNovo
            );

            if (copy($this->config->item('path_temp') . $uploadLog['file_name'], $this->config->item('conteudo_path') . $imgNomeNovo)) {
                if ($conteudo) {
                    unlink($this->config->item('conteudo_path') . $conteudo);
                }
                $this->Conteudo_model->atualizar($id, $array);
                unlink($this->config->item('path_temp') . $uploadLog['file_name']);
            }
            redirect(base_cms() . 'conteudo/detalhes/' . $id);
            echo "foi";
        } else {
            echo "deu pau";
            redirect('/' . base_cms() . 'conteudo/detalhes/' . $id);
        }
    }

}