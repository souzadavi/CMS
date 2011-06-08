<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poker_model extends CI_Model {
    const TABLE = 'poker_torneio';

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
    function getAllTorneio() {
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE);
    }

    function getTorneio($id) {
        $this->defaultDB->where('id', $id);
        return $this->defaultDB->get(self::TABLE);
    }

    function inserirTorneio($array) {
        $this->defaultDB->insert(self::TABLE, $array);
        return true;
    }

    function atualizar($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE, $array);
        return true;
    }

}