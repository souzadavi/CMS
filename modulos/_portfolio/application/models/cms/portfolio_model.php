<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portfolio_model extends CI_Model {
    const TABLE = 'portfolio';
    const TABLE_CAT = 'portfolio_categoria';

    function __construct() {
        parent::__construct();
        $this->defaultDB = $this->load->database('default', TRUE);
    }

    /**
     * Get user record by Id
     *
     * @param	int
     * @param	bool
     * @return	object
     */
    function getAllCategorias() {
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE_CAT);
    }

    function getCategoria($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE_CAT);
    }

    function inserirCategoria($array) {
        $this->defaultDB->insert(self::TABLE_CAT, $array);
        return true;
    }

    function atualizarCategoria($id, $array){
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE_CAT, $array);
        return true;
    }

    function getAllPortfolios() {
        $this->defaultDB->order_by("id DESC");
        return $this->defaultDB->get(self::TABLE);
    }
    function getAllPortfoliosAtivos() {
        $this->defaultDB->where("status","1");
        $this->defaultDB->order_by("id DESC");
        return $this->defaultDB->get(self::TABLE);
    }
    function getPortfolio($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE);
    }
    function getPortfoliosCategoria($id) {
        $this->defaultDB->where('categoria_id', $id);
        return $this->defaultDB->get(self::TABLE);
    }
    function getPortfoliosAtivosCategoria($id) {
        $this->defaultDB->where('categoria_id', $id);
        return $this->defaultDB->get(self::TABLE);
    }
    function alterarStatus($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE, $array);
        return true;
    }

    function inserirPortfolio($array) {
        if($this->defaultDB->insert(self::TABLE, $array)){
            return true;
        }
        return false;
    }

}