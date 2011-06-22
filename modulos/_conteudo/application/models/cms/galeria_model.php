<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeria_model extends CI_Model {
    const TABLE = 'galeria';
    const TABLE_CATEGORIA = 'conteudo_galeria_categoria';

    function __construct() {
        parent::__construct();
        $this->defaultDB = $this->load->database('default', TRUE);
    }
    function getAllCategorias(){
        $this->defaultDB->order_by("nome Asc");
        return $this->defaultDB->get(self::TABLE_CATEGORIA);
    }

    /**
     * Get user record by Id
     *
     * @param	int
     * @param	bool
     * @return	object
    
    
    function inserirGrupo($array) {
        $this->defaultDB->insert(self::TABLE_GALERIA_CATEGORIA, $array);
        return $this->defaultDB->insert_id();
    }

    function inserirArquivos($array) {
        $this->defaultDB->insert(self::TABLE, $array);
        return $this->defaultDB->insert_id();
        echo var_dump($array);
    }

    function listarImagens($id) {
        $this->defaultDB->order_by("ordem ASC");
        $this->defaultDB->where("id_grupo", $id);
        return $this->defaultDB->get(self::TABLE);
    }

    function getArquivo($src) {
        //$this->defaultDB->where("src",$src);
        //return $this->defaultDB->get(self::TABLE);
        return $this->defaultDB->query("SELECT *, DATE_FORMAT(data_add,'%d/%m/%Y às %H:%i:%s') AS data_add FROM " . self::TABLE . " WHERE src = '" . $src . "'");
    }

    function grupoListar() {
        return $this->defaultDB->get(self::TABLE_GALERIA_CATEGORIA);
    }

    function grupo($id) {
        $this->defaultDB->where("id_grupo", $id);
        return $this->defaultDB->get(self::TABLE_GALERIA_CATEGORIA);
    }

    function atualizar($id, $array) {
        $this->defaultDB->where("id", $id);
        //$this->defaultDB->set('ordem',$ordem);
        $this->defaultDB->update(self::TABLE, $array);
    }

    function deletar($src) {
        //$this->defaultDB->delete();
        $this->defaultDB->delete(self::TABLE, array('src' => $src));
    } */

}