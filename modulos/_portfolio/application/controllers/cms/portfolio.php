<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portfolio extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->library('tank_auth');
        //$this->load->library('pagination');
        $this->load->Model(base_cms() . "Portfolio_model");
        $this->load->library('mensagem');
        $this->config->load('portfolio');
        if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms() . 'login');
        }
        
        // Validar permissoes
        $this->load->library('permissions');
        $this->permissions->check_permission($this->config->item('portfolio'));
    }

    function index() {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['categoriaId'] = 0;
        $data['categorias'] = $this->Portfolio_model->getAllCategorias();
        $data['portfolios'] = $this->Portfolio_model->getAllPortfolios();
        $data['categoriaNome'] = "Todas Categorias";
        $this->load->view(base_cms() . 'portfolio', $data);
    }

    function categoria($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['categoriaId'] = $id;
        $data['categorias'] = $this->Portfolio_model->getAllCategorias();
        $data['portfolios'] = $this->Portfolio_model->getPortfoliosCategoria($id);
        $data['categoriaNome'] = $this->Portfolio_model->getCategoria($id)->row()->nome;
        $this->load->view(base_cms() . 'portfolio', $data);
    }

    function status($id, $status) {
        // alterar o status da noticia de acordo com o id
        if ($status == "1") {
            $sta = 0;
        }
        if ($status == "0") {
            $sta = 1;
        }

        /// VALIDA STATUS PARA NAO OCORRER ERRO DE STATUS.
        if ($sta < 2) {
            $array = array(
                'id' => $id,
                'status' => $sta
            );
            if($this->Portfolio_model->alterarStatus($id, $array)){
                redirect(base_cms() . "portfolio");
            }
        }
    }

    function categoriaNova(){
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('portfolio_categoria'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['modo'] = "novo";
        if($this->input->post('nome')){
            $array = array(
                    'nome' => $this->input->post('nome')
                );
            $this->Portfolio_model->inserirCategoria($array);
            redirect(base_cms()."portfolio");
        }

        $this->load->view(base_cms() . 'portfolio_categoria', $data);
    }

    function categoriaEditar($id){
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('portfolio_categoria_editar'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['categoriaId'] = $id;
        $data['categoriaNome'] = $this->Portfolio_model->getCategoria($id)->row()->nome;
        $data['modo'] = "editar";
        if($this->input->post('nome')){
            $array = array(
                    'nome' => $this->input->post('nome')
                );
            $this->Portfolio_model->atualizarCategoria($id,$array);
            redirect(base_cms()."portfolio");
        }

        $this->load->view(base_cms() . 'portfolio_categoria', $data);
    }

    function novo(){
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('portfolio_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('portfolio')); // montar menu lateral

        $data['modo'] = "novo";

        if(!is_dir($this->config->item('path_upload_portfolio'))){
            $data['script_head'] = $this->mensagem->call($this->config->item('folder_no_existe')."<br>".base_cms().$this->config->item('path_upload_portfolio'));
            log_message('level', $this->config->item('folder_no_existe'));
            //show_error('messag1111e' ,500 );
        }
        $data['categorias'] = $this->Portfolio_model->getAllCategorias();
        $this->load->view(base_cms() . 'portfolio_novo', $data);
    }


     function inserir(){

         $data['modo'] = "novo";

         $this->load->library('form_validation');
         $this->load->library('input');

        $this->form_validation->set_rules('categoria_id', 'categoria_id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('titulo', 'titulo', 'trim|required');
        //$this->form_validation->set_rules('img_thumb', 'img_thumb', 'required');
        $this->form_validation->set_rules('publicacao', 'publicacao', 'trim|required');

        if($this->form_validation->run()){
            
             /// UPLOAD
             /// setando configs para subir arquivo
             $config['allowed_types'] = $this->config->item('conteudo_allowed_types');
             $config['max_size'] = $this->config->item('conteudo_max_size');
             $config['max_width'] = $this->config->item('conteudo_max_width');
             $config['max_height'] = $this->config->item('conteudo_max_height');
             $config['upload_path'] = $this->config->item('path_upload_portfolio');
             /// setando o nome da nova imagem
             $config['file_name'] = url_title(uniqid() . "-".url_title($this->input->post('titulo'))."-".$_FILES['img_thumb']['name']);

             //echo var_dump($config);

             $this->load->library('upload', $config);
             if ($this->upload->do_upload('img_thumb')) {
                $uploadLog = $this->upload->data();
                $img_thumb = $uploadLog['file_name'];
             }



             // Subir outra imagem
             if($_FILES['img_big']){
                $this->upload->do_upload('img_big');
                $config['file_name'] = url_title(uniqid() . "-".url_title($this->input->post('titulo'))."-".$_FILES['img_big']['name']);
                $this->upload->initialize($config);
                $this->upload->do_upload('img_big');
                $uploadLog = $this->upload->data();
                $img_big = $uploadLog['file_name'];
             }else{
                 $img_big = "vai ta aq";
             }
             //echo var_dump($this->upload->display_errors());
             /// FIM UPLOAD

             $array = array(
                    'users_id' =>  $this->tank_auth->get_user_id(),
                    'categoria_id' => $this->input->post('categoria_id'),
                    'status' => $this->input->post('status'),
                    'titulo' => $this->input->post('titulo'),
                    'img_thumb' => $img_thumb,
                    'img_big' => $img_big,
                    'descricao' => $this->input->post('descricao'),
                    'publicacao' => $this->input->post('publicacao'),
                );
            if($this->Portfolio_model->inserirPortfolio($array)){
                $this->categoria($this->input->post('categoria_id'));
                $data['script_head'] = $this->mensagem->call($this->config->item('Salvo com sucesso'));
            }else{
                //$data['script_head'] = $this->mensagem->call($this->config->item('folder_no_existe')."<br>".base_cms().$this->config->item('path_upload_portfolio'));
                $data['mensagem'] = "Erro ao Salvar no Banco.";
            }
        }else{
            $data['mensagem'] = "Preencha os campos corretamente.";
        }
        //$this->load->view(base_cms() . 'portfolio_novo', $data);
     }


     function upload($id) {
        //$this->load->helper(array('form', 'url'));
        /// Carregando arquivo de configura��o

        /// setando configs para subir arquivo
        $config['allowed_types'] = $this->config->item('conteudo_allowed_types');
        $config['max_size'] = $this->config->item('conteudo_max_size');
        $config['max_width'] = $this->config->item('conteudo_max_width');
        $config['max_height'] = $this->config->item('conteudo_max_height');
        $config['upload_path'] = $this->config->item('path_temp'); //$_SERVER['DOCUMENT_ROOT']."/cliente/ohl/upload/temp/";
        // Nome da pasta que ir� copiar o arquivo de imagem ap�s envio e verifica��es
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