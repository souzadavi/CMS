<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->load->library('mensagem');
        $this->load->library('session');
        //$this->load->library('pagination');

        if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms() . 'login');
        }

        $this->load->Model(base_cms() . "produto_model");
        $this->config->load('produto');
        $this->load->library('permissions');
        $this->permissions->check_permission($this->config->item('produto'));
        $this->load->library('input');
    }

    function index() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('produto')); // montar menu lateral

        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }

        $data['produtos'] = $this->produto_model->getLastProdutos();
        $data['categorias'] = $this->produto_model->getAllCategorias();
        $this->load->view(base_cms() . 'produto', $data);
        //redirect(base_cms().'destaquehome');
    }

    function novo() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('produto_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('produto')); // montar menu lateral

        $data['modo'] = "novo";

        if (!is_dir($this->config->item('path_upload_produto'))) {
            $data['script_head'] = $this->mensagem->call($this->config->item('folder_no_existe') . "<br>" . $this->config->item('path_upload_poker'));
            log_message('level', $this->config->item('folder_no_existe'));
        }
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }

        $data['categorias'] = $this->produto_model->getAllCategorias();
        $this->load->view(base_cms() . 'produto_detalhes', $data);
    }

    function inserir() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('produto_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('produto')); // montar menu lateral

        $this->load->library('form_validation');

        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('valor', 'valor', 'trim');
        $this->form_validation->set_rules('resumo', 'resumo', 'trim');
        $imagem =  NULL;
        //$this->form_validation->set_rules('descricao', 'descricao', 'trim|required');

        if ($this->form_validation->run()) {


            if ($_FILES['imagem']['name'] != "") {
                /// UPLOAD
                /// setando configs para subir arquivo
                $config['allowed_types'] = $this->config->item('allowed_types');
                $config['max_size'] = $this->config->item('max_size');
                $config['max_width'] = $this->config->item('max_width');
                $config['max_height'] = $this->config->item('max_height');
                $config['upload_path'] = $this->config->item('path_upload_produto');
                /// setando o nome da nova imagem
                $config['file_name'] = url_title(uniqid() . "-" . $this->input->post('nome') . "-" . $_FILES['imagem']['name']);
                //echo var_dump($config);

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('imagem')) {
                    $uploadLog = $this->upload->data();
                    $imagem = $uploadLog['file_name'];
                    $tipo = $uploadLog['file_ext'];

                    
                } else {
                    // ERRO NO UPLOAD DA IMAGEM
                    $this->session->set_flashdata("script_head", "Erro ao Subir arquivo. " . $this->upload->display_errors());
                    redirect(base_cms() . 'produto/novo');
                }
            }
            
            $array = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'categoria_id' => $this->input->post('categoria_id'),
                        'nome' => $this->input->post('nome'),
                        'status' => $this->input->post('status'),
                        'imagem' => $imagem,
                        'valor' => $this->input->post('valor'),
                        'resumo' => $this->input->post('resumo'),
                        'descricao' => $this->input->post('descricao')
                    );

            if ($this->produto_model->inserirProduto($array)) {
                    //$this->categoria($this->input->post('categoria_id'));
                    //$data['script_head'] = $this->mensagem->call($this->config->item('Salvo com sucesso'));
                    //INICIO LOGS
                    $this->load->library('logs');
                    $arrayLog = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'url' => "produto/inserir",
                        'log' => print_r($array, true),
                        'ip' => $this->input->ip_address()
                    );
                    $this->logs->gravar($arrayLog);
                    ///FIM LOGS

                    $this->session->set_flashdata("script_head", "Produto Salvo com Sucesso.");
                    redirect(base_cms() . 'produto');
                } else {
                    $this->session->set_flashdata("script_head", "Erro ao Salvar no Banco.");
                    redirect(base_cms() . 'produto/novo');
                }
            
        } else {
            $this->session->set_flashdata("script_head", "Preencha os campos corretamente.");
            redirect(base_cms() . 'produto/novo');
        }
    }
    

    function alterar($id) {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('produto_detalhes'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('produto')); // montar menu lateral


        $data['modo'] = "editar";

        $this->load->library('form_validation');

        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('total_etapas', 'total_etapas', 'trim|required');
        $this->form_validation->set_rules('maximo_pontos', 'maximo_pontos', 'trim|required');
        //$this->form_validation->set_rules('descricao', 'descricao', 'trim|required');

        if ($this->form_validation->run()) {

            /// UPLOAD
            /// setando configs para subir arquivo
            $config['allowed_types'] = $this->config->item('poker_allowed_types');
            $config['max_size'] = $this->config->item('poker_max_size');
            $config['max_width'] = $this->config->item('poker_max_width');
            $config['max_height'] = $this->config->item('poker_max_height');
            $config['upload_path'] = $this->config->item('path_upload_poker');
            /// setando o nome da nova imagem
            if ($_FILES['imagem']['name'] != "") {
                //echo "entreui aqui". var_dump($_FILES['imagem']);
                $imagem = $this->poker_model->getTorneio($id)->row()->imagem;
                $config['file_name'] = $imagem;
                if(file_exists($config['upload_path'] . $imagem)){
                    unlink($config['upload_path'] . $imagem);
                }
                //echo var_dump($config);

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('imagem')) {
                    $uploadLog = $this->upload->data();
                    $imagem = $uploadLog['file_name'];
                    $tipo = $uploadLog['file_ext'];
                } else {
                    // ERRO NO UPLOAD DA IMAGEM
                    $this->session->set_flashdata("script_head", "Erro ao Subir arquivo. " . $this->upload->display_errors());
                    redirect(base_cms() . "poker/detalhes/" . $id);
                }
            }

            $array = array(
                'users_id' => $this->tank_auth->get_user_id(),
                'status' => $this->input->post('status'),
                'nome' => $this->input->post('nome'),
                'total_etapas' => $this->input->post('total_etapas'),
                'maximo_pontos' => $this->input->post('maximo_pontos'),
                'descricao' => $this->input->post('descricao')
            );
            if ($this->poker_model->atualizar($id, $array)) {

                //INICIO LOGS
                $this->load->library('logs');
                $arrayLog = array(
                    'users_id' => $this->tank_auth->get_user_id(),
                    'url' => "poker/alterar",
                    'log' => print_r($array, true),
                    'ip' => $this->input->ip_address()
                );
                $this->logs->gravar($arrayLog);
                ///FIM LOGS

                $this->session->set_flashdata("script_head", "Dados alterado com sucesso.");
                redirect(base_cms() . "poker/detalhes/" . $id);
            } else {
                $this->session->set_flashdata("script_head", "Erro ao Salvar no Banco.");
                redirect(base_cms() . "poker/detalhes/" . $id);
            }
        } else {
            $this->session->set_flashdata("script_head", "Preencha os campos corretamente.");
            redirect(base_cms() . "poker/detalhes/" . $id);
        }
    }

    function detalhes($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_detalhes'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }

        $data['modo'] = "editar";

        $data['torneio'] = $this->poker_model->getTorneio($id)->row();
        $data['jogadores'] = $this->poker_model->getAllJogador();
        $data['jogadoresInscritos'] = $this->poker_model->getJogadoresTorneio($id);
        //$data['bannerCliques'] = $this->banner_model->getBannerCliques($id);
        //$data['categorias'] = $this->banner_model->getAllCategorias();
        $this->load->view(base_cms() . 'poker_torneio_detalhes', $data);
    }
    
    

}