<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poker extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->load->library('mensagem');
        $this->load->library('session');

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
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }
        //$data['categoriaId'] = 0;
        //$data['categorias'] = $this->banner_model->getAllCategorias();
        $data['torneios'] = $this->poker_model->getAllTorneio();
        $data['categoriaNome'] = "Todas as Categorias";
        $this->load->view(base_cms() . 'poker', $data);
    }

    function novo() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        $data['modo'] = "novo";

        if (!is_dir($this->config->item('path_upload_poker'))) {
            $data['script_head'] = $this->mensagem->call($this->config->item('folder_no_existe') . "<br>" . $this->config->item('path_upload_poker'));
            log_message('level', $this->config->item('folder_no_existe'));
            //show_error('messag1111e' ,500 );
        }
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }
        $this->load->view(base_cms() . 'poker_torneio_detalhes', $data);
    }

    function inserir() {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral


        $data['modo'] = "novo";

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
            $config['file_name'] = url_title(uniqid() . "-" . $this->input->post('nome') . "-" . $_FILES['imagem']['name']);
            //echo var_dump($config);

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('imagem')) {
                $uploadLog = $this->upload->data();
                $imagem = $uploadLog['file_name'];
                $tipo = $uploadLog['file_ext'];

                $array = array(
                    'users_id' => $this->tank_auth->get_user_id(),
                    'status' => $this->input->post('status'),
                    'nome' => $this->input->post('nome'),
                    'total_etapas' => $this->input->post('total_etapas'),
                    'maximo_pontos' => $this->input->post('maximo_pontos'),
                    'imagem' => $imagem,
                    'descricao' => $this->input->post('descricao')
                );
                if ($this->poker_model->inserirTorneio($array)) {
                    //$this->categoria($this->input->post('categoria_id'));
                    //$data['script_head'] = $this->mensagem->call($this->config->item('Salvo com sucesso'));
                    //INICIO LOGS
                    $this->load->library('logs');
                    $arrayLog = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'url' => "poker/inserir",
                        'log' => print_r($array, true),
                        'ip' => $this->input->ip_address()
                    );
                    $this->logs->gravar($arrayLog);
                    ///FIM LOGS

                    redirect(base_cms() . 'poker');
                } else {
                    $this->session->set_flashdata("script_head", "Erro ao Salvar no Banco.");
                    $this->novo();
                }
            } else {
                // ERRO NO UPLOAD DA IMAGEM
                $this->session->set_flashdata("script_head", "Erro ao Subir arquivo. " . $this->upload->display_errors());
                $this->novo();
            }
        } else {
            $this->session->set_flashdata("script_head", "Preencha os campos corretamente.");
            $this->novo();
        }
    }

    function alterar($id) {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_alterar'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral


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
    
    function jogadorLista() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_jogador_listar'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        $data['jogadores'] = $this->poker_model->getAllJogador();
        
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }

        $this->load->view(base_cms() . 'poker_jogador_lista', $data);
    }

    function inserirJogadorTorneio($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_inserir_jogador'));

        $jogador = array(
            'torneio_id' => $id,
            'jogador_id' => $this->input->post('jogador_id')
        );

        if ($this->poker_model->verificarJogadorTorneio($jogador)) {
            $array = array(
                'torneio_id' => $id,
                'jogador_id' => $this->input->post('jogador_id'),
                'pontos' => 0,
                'etapa' => 0
            );
            if ($this->poker_model->inserirJogadorTorneio($array)) {
                //INICIO LOGS
                $this->load->library('logs');
                $arrayLog = array(
                    'users_id' => $this->tank_auth->get_user_id(),
                    'url' => "poker/inserir",
                    'log' => print_r($array, true),
                    'ip' => $this->input->ip_address()
                );
                $this->logs->gravar($arrayLog);
                //FIM LOGS
                $this->session->set_flashdata("script_head", "Jogador cadastrado com sucesso!");
                redirect(base_cms() . "poker/detalhes/" . $id);
            }
        } else {
            $this->session->set_flashdata("script_head", "Jogador já cadastrado.");
            redirect(base_cms() . "poker/detalhes/" . $id);
        }
    }

    function deletarJogadorTorneio($jogador_id, $torneio_id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_deletar_jogador'));

        $array = array(
            'torneio_id' => $torneio_id,
            'jogador_id' => $jogador_id
        );

        if ($this->poker_model->deletarJogadorTorneio($array)) {
            $this->session->set_flashdata("script_head", "Jogador deletado do torneio com sucesso.");
            //INICIO LOGS
            $this->load->library('logs');
            $arrayLog = array(
                'users_id' => $this->tank_auth->get_user_id(),
                'url' => "poker/deletarJogadorTorneio",
                'log' => print_r($array, true),
                'ip' => $this->input->ip_address()
            );
            $this->logs->gravar($arrayLog);
            ///FIM LOGS
        } else {
            $this->session->set_flashdata("script_head", "Erro ao deletar jogador do torneio.");
        }
        redirect(base_cms() . "poker/detalhes/" . $torneio_id);
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
            if ($this->poker_model->atualizar($id, $array)) {
                $this->session->set_flashdata("script_head", "Status atualizado com Sucesso.");
                redirect(base_cms() . "poker");
            }
        }
    }

    function etapasAtualizar($torneio, $etapa) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_torneio_atualizar_pontos'));

        //inserirJogadorTorneio
        foreach ($_POST['jogador'] as $dados) {

            if (isset($dados['selecionado'])) {
                $array = array(
                    'torneio_id' => $torneio,
                    'jogador_id' => $dados['jogador_id'],
                    'pontos' => $dados['pontos'],
                    'etapa' => $_POST['etapaAtual']
                );
                if ($this->poker_model->inserirJogadorTorneioPontuacao($array)) {
                    $this->session->set_flashdata("script_head", "Pontuação Atualizada com Sucesso.");
                    //INICIO LOGS
                    $this->load->library('logs');
                    $arrayLog = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'url' => "poker/etapasAtualizar",
                        'log' => print_r($array, true),
                        'ip' => $this->input->ip_address()
                    );
                    $this->logs->gravar($arrayLog);
                    ///FIM LOGS
                } else {
                    $this->session->set_flashdata("script_head", "Erro ao atualizar Pontuação.");
                }
            } //else {
                //$this->session->set_flashdata("script_head", "Etapa não foi atualizada.");
            //}
        }
        redirect(base_cms() . "poker/detalhes/" . $torneio);
    }

    function jogador() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_jogador_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        $data['modo'] = "novo";

        if (!is_dir($this->config->item('path_upload_poker'))) {
            $data['script_head'] = $this->mensagem->call($this->config->item('folder_no_existe') . "<br>" . $this->config->item('path_upload_poker'));
            log_message('level', $this->config->item('folder_no_existe'));
            //show_error('messag1111e' ,500 );
        }
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }
        $this->load->view(base_cms() . 'poker_jogador', $data);
    }

    function inserirJogador() {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_jogador_novo'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral


        $data['modo'] = "novo";

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('codigo', 'codigo', 'trim|required');

        if ($this->form_validation->run()) {
            /// UPLOAD
            /// setando configs para subir arquivo
            $config['allowed_types'] = $this->config->item('poker_allowed_types');
            $config['max_size'] = $this->config->item('poker_max_size');
            $config['max_width'] = $this->config->item('poker_max_width');
            $config['max_height'] = $this->config->item('poker_max_height');
            $config['upload_path'] = $this->config->item('path_upload_poker');
            /// setando o nome da nova imagem
            $imagem = Null;

            //echo var_dump($config);

            $jogador = array(
                'codigo' => $this->input->post('codigo'),
            );
            if($this->poker_model->verificarJogadorCodigo($jogador)){ // VERIFICA SE O CODIGO JA É CADASTRADO
                if ($_FILES['imagem']['name'] != "") {
                    $config['file_name'] = url_title(uniqid() . "-" . $this->input->post('nome') . "-" . $_FILES['imagem']['name']);
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('imagem')) {
                        $uploadLog = $this->upload->data();
                        $tipo = $uploadLog['file_ext'];
                        $imagem = $config['file_name'];
                    } else {
                        // ERRO NO UPLOAD DA IMAGEM
                        $this->session->set_flashdata("script_head", "Erro ao Subir arquivo. " . $this->upload->display_errors());
                        $this->novo();
                    }
                }

                $array = array(
                    'users_id' => $this->tank_auth->get_user_id(),
                    'nome' => $this->input->post('nome'),
                    'codigo' => $this->input->post('codigo'),
                    'foto' => $imagem
                );

                if ($this->poker_model->inserirJogador($array)) {
                    //INICIO LOGS
                    $this->load->library('logs');
                    $arrayLog = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'url' => "poker/inserirJogador",
                        'log' => print_r($array, true),
                        'ip' => $this->input->ip_address()
                    );
                    $this->logs->gravar($arrayLog);
                    ///FIM LOGS
                    $this->session->set_flashdata("script_head", "Jogador Inserido com Sucesso.");
                    redirect(base_cms() . 'poker/jogadorLista');
                } else {
                    $this->session->set_flashdata("script_head", "Erro ao Salvar no Banco.");
                    $this->jogador();
                }
            }else{
                $this->session->set_flashdata("script_head", "Código de Jogador já cadastrado no Sistema.");
                $this->jogador();
            }
        } else {
            $this->session->set_flashdata("script_head", "Preencha os campos corretamente.");
            $this->jogador();
        }
    }

    function jogadorDetalhes($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_jogador_detalhes'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        $data['modo'] = "editar";

        
        if ($this->session->flashdata('script_head')) {
            $data['script_head'] = $this->mensagem->call($this->session->flashdata('script_head'));
        }

        $data['jogador'] = $this->poker_model->getJogador($id)->row();

        $this->load->view(base_cms() . 'poker_jogador', $data);
    }
    
    function jogadorAlterar($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->permissions->check_permission($this->config->item('poker_jogador_alterar'));
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('poker')); // montar menu lateral

        $data['modo'] = "editar";

        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'nome', 'trim|required');
        $this->form_validation->set_rules('codigo', 'codigo', 'trim|required');

        if ($this->form_validation->run()) {
            /// UPLOAD
            /// setando configs para subir arquivo
            $config['allowed_types'] = $this->config->item('poker_allowed_types');
            $config['max_size'] = $this->config->item('poker_max_size');
            $config['max_width'] = $this->config->item('poker_max_width');
            $config['max_height'] = $this->config->item('poker_max_height');
            $config['upload_path'] = $this->config->item('path_upload_poker');
            /// setando o nome da nova imagem
            if($this->poker_model->getJogador($id)->row()->foto != ""){
                $imagem = $this->poker_model->getJogador($id)->row()->foto;
            }else{
                $imagem = url_title(uniqid() . "-" . $this->input->post('nome') . "-" . $_FILES['imagem']['name']);
            }

                if ($_FILES['imagem']['name'] != "") {
                    $config['file_name'] = $imagem;
                    $this->load->library('upload', $config);
                    if(file_exists($config['upload_path'] . $imagem)){
                        unlink($config['upload_path'] . $imagem);
                    }
                    if ($this->upload->do_upload('imagem')) {
                        $uploadLog = $this->upload->data();
                        $tipo = $uploadLog['file_ext'];
                    } else {
                        // ERRO NO UPLOAD DA IMAGEM
                        $this->session->set_flashdata("script_head", "Erro ao Subir arquivo. " . $this->upload->display_errors());
                        redirect(base_cms() . 'poker/jogadorDetalhes/'.$id);
                    }
                }

                $array = array(
                    'users_id' => $this->tank_auth->get_user_id(),
                    'nome' => $this->input->post('nome'),
                    'foto' => $imagem
                );

                if ($this->poker_model->atualizarJogador($id, $array)) {
                    //INICIO LOGS
                    $this->load->library('logs');
                    $arrayLog = array(
                        'users_id' => $this->tank_auth->get_user_id(),
                        'url' => "poker/jogadorAlterar",
                        'log' => print_r($array, true),
                        'ip' => $this->input->ip_address()
                    );
                    $this->logs->gravar($arrayLog);
                    ///FIM LOGS
                    $this->session->set_flashdata("script_head", "Jogador alterado com Sucesso.");
                    redirect(base_cms() . 'poker/jogadorLista');
                } else {
                    $this->session->set_flashdata("script_head", "Erro ao Salvar no Banco.");
                    redirect(base_cms() . 'poker/jogadorDetalhes/'.$id);
                }
        } else {
            $this->session->set_flashdata("script_head", "Preencha os campos corretamente.");
            redirect(base_cms() . 'poker/jogadorDetalhes/'.$id);
        }
    }

}