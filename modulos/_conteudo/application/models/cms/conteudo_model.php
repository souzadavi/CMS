<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conteudo_model extends CI_Model {
    const TABLE = 'conteudo';
    const TABLE_GALERIA_CATEGORIA = 'conteudo_galeria_categoria';
    const TABLE_GALERIA = 'conteudo_galeria';

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
    function getAllConteudo() {
        /* /// Status do Conteudo
         * 0 - pendente
         * 1 - publicado
         * 2 - rascunho
         * 3 - backup
         */

        $this->defaultDB->where('status', '1');
        $this->defaultDB->order_by("titulo ASC");
        return $this->defaultDB->get(self::TABLE);
    }

    function getConteudo($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE);
    }

    function atualizar($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE, $array);
        return true;
    }

    function inserir($array) {
        $this->defaultDB->insert(self::TABLE, $array);
        return true;
    }

    function getAllCategorias() {
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE_GALERIA_CATEGORIA);
    }

    function getAllRevisao($id){
        $this->defaultDB->order_by("id DESC");
        $this->defaultDB->where('conteudo_pai_id', $id);
        return $this->defaultDB->get(self::TABLE);
    }

}