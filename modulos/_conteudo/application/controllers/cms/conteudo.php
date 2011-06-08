<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conteudo extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->load->library('pagination');
        $this->load->library('mensagem');
        $this->load->helper('form');

        if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms() . 'login');
        }

        $this->load->Model(base_cms() . "conteudo_model");
        $this->config->load('conteudo');
        $this->load->library('permissions');
        $this->permissions->check_permission($this->config->item('conteudo'));
    }

    function index() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('conteudo')); // montar menu lateral
        $this->permissions->check_permission($this->config->item('conteudo'));

        $data['conteudos'] = $this->conteudo_model->getAllConteudo();
        $this->load->view(base_cms() . 'conteudo', $data);
        //redirect(base_cms().'destaquehome');
    }

    function pagina(){
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('conteudo')); // montar menu lateral
        $this->permissions->check_permission($this->config->item('conteudo_pagina'));

        $data['conteudos'] = $this->conteudo_model->getAllConteudo();
        $this->load->view(base_cms() . 'conteudo_pagina', $data);

    }

    function paginaEditar($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission(3); // verifica se tem permissão para ver o conteudo
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('conteudo')); // montar menu lateral
        $this->permissions->check_permission($this->config->item('conteudo_pagina_editar'));

        $data['conteudo'] = $this->conteudo_model->getConteudo($id)->row();
        $data['revisoes'] = $this->conteudo_model->getAllRevisao($id);

        $data['galeriaCategorias'] = $this->conteudo_model->getAllCategorias();
        $data['galeriaAtivada'] = $this->config->item('conteudo_galeria_ativada');

        
        $this->load->view(base_cms() . 'conteudo_pagina_detalhes', $data);
    }

    function noticia(){
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('conteudo')); // montar menu lateral
        $this->permissions->check_permission($this->config->item('conteudo_noticia'));

        $data['conteudos'] = $this->conteudo_model->getAllConteudo();
        $this->load->view(base_cms() . 'conteudo_noticia', $data);

    }

    function atualizar($id) {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission(3); // verifica se tem permissão para ver o conteudo
        //$data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        //$data['menus'] = $this->permissions->monta_menu($this->config->item('conteudo')); // montar menu lateral
        $this->permissions->check_permission($this->config->item('conteudo_pagina_editar'));

        if($this->input->post('galeria_id') == '0'){
            $galeria_id = NULL;
        }else{
           $galeria_id = $this->input->post('galeria_id');
        }
        /// SALVANDO BACKUP DO CONTEUDO
        $dados = $this->conteudo_model->getConteudo($id)->row();
        $arrayBackup = array(
            'conteudo_pai_id' => $id,
            'users_id' => $this->tank_auth->get_user_id(),
            'galeria_categoria_id' => $dados->galeria_categoria_id,
            'status' => '3',
            'visibilidade' => $dados->visibilidade,
            'tipo' => $dados->tipo,
            'titulo' => $dados->titulo,
            'descricao' => $dados->descricao,
            'resumo' => $dados->resumo,
            'ip' => $this->input->ip_address(),
            'imagem' => $dados->imagem,
            'legenda' => $dados->legenda
        );
        $this->conteudo_model->inserir($arrayBackup);

        /// ATUALIZANDO CONTEÚDO
        $array = array(
            'conteudo_pai_id' => NULL,
            'galeria_categoria_id' => $galeria_id,
            'status' => '1',
            'descricao' => $this->input->post('texto'),
            'resumo' => $this->input->post('resumo'),
            'legenda' => $this->input->post('legenda')
        );
        $this->conteudo_model->atualizar($id, $array);

        redirect(base_cms() . 'conteudo/paginaEditar/' . $id);
    }

    function upload($id) {
        //$this->load->helper(array('form', 'url'));
        /// Carregando arquivo de configuração
        $this->config->load("conteudo");
        $this->config->load("cms");
        /// setando configs para subir arquivo
        $config['allowed_types'] = $this->config->item('conteudo_allowed_types');
        $config['max_size'] = $this->config->item('conteudo_max_size');
        $config['max_width'] = $this->config->item('conteudo_max_width');
        $config['max_height'] = $this->config->item('conteudo_max_height');
        $config['upload_path'] = $this->config->item('path_temp'); 
        // Nome da pasta que irá copiar o arquivo de imagem após envio e verificações
        $data['pastaFinal'] = $this->config->item('conteudo_path');
        /// FIM configs

        $this->load->library('upload', $config);

        $conteudo = $this->conteudo_model->getConteudo($id)->row()->imagem;

        /// SUBIU A IMAGEM
        if ($this->upload->do_upload('image')) {
            //echo "subiu";
            $uploadLog = $this->upload->data();
            /// setando o nome da nova imagem
            $imgNomeNovo = url_title(uniqid() . "-" . $uploadLog['file_name']);

            $array = array(
                'imagem' => $imgNomeNovo
            );

            if (copy($this->config->item('path_temp') . $uploadLog['file_name'], $this->config->item('conteudo_path') . $imgNomeNovo)) {
                if ($conteudo) {
                    if(file_exists($this->config->item('conteudo_path') . $conteudo)){
                        unlink($this->config->item('conteudo_path') . $conteudo);
                    }
                }
                $this->conteudo_model->atualizar($id, $array);
                if(file_exists($this->config->item('path_temp') . $uploadLog['file_name'])){
                    unlink($this->config->item('path_temp') . $uploadLog['file_name']);
                }
            }
            //echo "foi";
            redirect(base_cms() . 'conteudo/paginaEditar/' . $id);
        } else {
            //echo "deu pau";
            echo var_dump($this->upload->data());
            $data['script_head'] = $this->mensagem->call("Erro ao Subir arquivo.");
            $this->paginaEditar($id);//redirect('/' . base_cms() . 'conteudo/paginaEditar/' . $id);
        }
    }

}