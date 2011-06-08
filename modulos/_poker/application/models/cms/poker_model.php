<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poker_model extends CI_Model {
    const TABLE = 'poker_torneio';
    const TABLE_JOGADOR = 'poker_jogador';
    const TABLE_JOGADOR_TORNEIO = 'poker_relacao';

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

    function getAllJogador(){
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE_JOGADOR);
    }

    function getJogadoresTorneio($id){
        $this->defaultDB->where('id', $id);
        $this->defaultDB->order_by("nome ASC");
        return $this->defaultDB->get(self::TABLE_JOGADOR);
    }
    function inserirJogadorTorneio($array){
        return $this->defaultDB->insert(self::TABLE_JOGADOR_TORNEIO, $array);
    }
    
    function verificarJogadorTorneio($array){
        $this->defaultDB->where($array);
        if($this->defaultDB->get(self::TABLE_JOGADOR_TORNEIO)->num_rows()>0){
            return false;
        }else{
            return true;
        }
        
    }
}