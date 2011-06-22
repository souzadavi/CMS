<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeria extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth');
        $this->load->library('mensagem');
        $this->load->library('session');
        //$this->load->library('form_validation');

        if (!$this->tank_auth->is_logged_in()) {
            redirect(base_cms() . 'login');
        }

        $this->load->Model(base_cms() . "galeria_model");
        $this->config->load('galeria');
        $this->load->library('permissions');
        $this->permissions->check_permission($this->config->item('galeria'));
        $this->load->library('input');
    }

    function index() {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu($this->config->item('galeria')); // montar menu lateral

        $data['galerias'] = $this->galeria_model->getAllCategorias();

        $this->load->view(base_cms() . 'galeria', $data);
    }
    
    function editar($id) {

        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $data['menuLinks'] = $this->permissions->monta_menu(); // montar menu superior
        $data['menus'] = $this->permissions->monta_menu(24); // montar menu lateral

        $data['galeria'] = $this->Galeria_model->grupo($id)->row();
        $data['imagens'] = $this->Galeria_model->listarImagens($id);
        $data['pastaTemp'] = $this->config->item('path_temp');
        $this->load->view(base_cms() . 'galeriaEditar', $data);
    }



    function ordenar() {
        /// ordenar imagens! from http://www.webresourcesdepot.com/dynamic-dragn-drop-with-jquery-and-php/
        //$action                 = $_POST['action'];
        $updateRecordsArray = $_POST['recordsArray'];
        $ordem = 1;

        foreach ($updateRecordsArray as $id) {
            // atualizar ordem dentro da galeria
            $array = array(
                'id' => $id,
                'ordem' => $ordem
            );
            $this->Galeria_model->atualizar($id, $array);
            $ordem = $ordem + 1;
        }
    }

    function deletar() {
        $this->config->load("cms");
        $this->Galeria_model->deletar($this->input->post('src'));
        unlink($this->config->item('galeria_path') . $this->input->post('src'));
        //echo $this->config->item('galeria_path').$this->input->post('src');
        //$this->Galeria_model->ordenar($id);
    }

    /*
      Retornar a propriedade de um arquivo da galeria
      parametro id do arquivo na galeria
      return json
     */

    function propriedade($src) {
        $arquivo = $this->Galeria_model->getArquivo($src)->row();
        $array = array(
            'id' => $arquivo->id,
            'arquivo' => $arquivo->src,
            'data' => $arquivo->data_add,
            'link' => $arquivo->link,
            'legenda' => $arquivo->legenda
        );

        echo json_encode($array);
    }

    /*
      Atualiza os dados do arquivo da galeria
      parametros via post.
      imprimi mensagem de sucesso ou erro.
     */

    function atualizarArquivo() {
        if ($this->input->post('arquivoId') != "") {
            $array = array(
                'id' => $this->input->post('arquivoId'),
                'legenda' => $this->input->post('legenda'),
                'link' => $this->input->post('link')
            );
            $this->Galeria_model->atualizar($this->input->post('arquivoId'), $array);
            echo "Propriedade do arquivo atualizada com sucesso!";
        } else {
            echo "Não foi possível atualizar o arquivo.";
        }
    }

    function uploadify($id) {
        $data['user_id'] = $this->tank_auth->get_user_id();
        $data['username'] = $this->tank_auth->get_username();
        $this->config->load("cms");
        //Decode JSON returned by /js/uploadify/upload.php
        $file = $this->input->post('filearray');
        $json = json_decode($file, true); // definir como true para trazer como array
        //$this->config->load("cms");
        /// informações estão cadastradas no BD na tabela galeria_tipo
        switch ($json['file_ext']) {
            case '.swf':
                $id_tipo = 2;
                break;

            default:
                $id_tipo = 1;
        }
        //$nomeImg = uniqid()."-".url_title($json['file_name']);
        $nomeImg = uniqid();
        $this->load->Model(base_cms() . "galeria_model");
        $array = array(
            'users_id' => $data['user_id'],
            'id_tipo' => $id_tipo, //TIPO IMAGEM (JPG, GIF, PNG)
            'id_grupo' => $id, /// inserir o id do grupo
            'src' => $nomeImg . $json['file_ext'],
            'legenda' => NULL
        );
        $insertId = $this->galeria_model->inserirArquivos($array);
        if (copy($this->config->item('path_temp') . $json['file_name'], $this->config->item('galeria_path') . $nomeImg . $json['file_ext'])) {
            /// sucesso
            //if($id_tipo == '2'){

            $jsonRetorno = array(
                'id' => $insertId,
                'tipo' => $json['file_ext'], // .jpg, .swf
                'imagem' => $nomeImg // nome final da imagem
            );
            echo json_encode($jsonRetorno);
            //echo "<li id='recordsArray_".$insertId."' src='".$nomeImg."' onclick=\"javascript:getPropriedade('".$nomeImg."');\"><img src='../labmin/img/flash.jpg' width='100' height='100' /></li>";
            //}else{
            //echo "<li id='recordsArray_".$insertId."' src='".$nomeImg."' onclick=\"javascript:getPropriedade('".$nomeImg."');\"><img src='../upload/thumb.php?h=100&w=100&img=galeria/" . $nomeImg . "' width='100' height='100' /></li>";
            //}
            $data["msg"] = "Arquivo enviado com sucesso!";
        } else {
            $data["msg"] = "Ocorreu um erro ao enviar o arquivo";
        }
    }

}