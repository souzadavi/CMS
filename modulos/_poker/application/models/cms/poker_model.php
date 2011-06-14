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
    
    function getJogador($id){
        $this->defaultDB->where("id",$id);
        return $this->defaultDB->get(self::TABLE_JOGADOR);
    }
    
    function inserirJogador($array) {
        $this->defaultDB->insert(self::TABLE_JOGADOR, $array);
        return true;
    }
    function atualizarJogador($id, $array) {
        $this->defaultDB->where('id', $id);
        $this->defaultDB->update(self::TABLE_JOGADOR, $array);
        return true;
    }

    function getJogadoresTorneio($id){
        $this->defaultDB->where('torneio_id', $id);
        $this->defaultDB->select('*', FALSE); 
        $this->defaultDB->select_sum(self::TABLE_JOGADOR_TORNEIO.'.pontos','pontos_total');
        $this->defaultDB->order_by(self::TABLE_JOGADOR.'.nome ASC');
        $this->defaultDB->join(self::TABLE_JOGADOR, self::TABLE_JOGADOR_TORNEIO.'.jogador_id = '.self::TABLE_JOGADOR.'.id');
        $this->defaultDB->group_by(self::TABLE_JOGADOR_TORNEIO.".jogador_id"); 
        return $this->defaultDB->get(self::TABLE_JOGADOR_TORNEIO);
        //SELECT *, SUM(pontos) as pontos_total FROM poker_relacao JOIN poker_jogador ON poker_relacao.jogador_id = poker_jogador.id WHERE poker_relacao.torneio_id = 1 GROUP BY jogador_id
    }
    function inserirJogadorTorneio($array){
        //$this->defaultDB->insert_batch(self::TABLE_JOGADOR_TORNEIO, $array); 
        if($this->defaultDB->insert(self::TABLE_JOGADOR_TORNEIO, $array)){
            return true;
        }else{
            return false;
        }
    }
    
    function inserirJogadorTorneioPontuacao($array){
        //$this->defaultDB->insert_batch(self::TABLE_JOGADOR_TORNEIO, $array); 
        if($this->defaultDB->insert(self::TABLE_JOGADOR_TORNEIO, $array)){
            // Atualizar Etapa Atual do Torneio
            $this->defaultDB->where('id', $array['torneio_id']);
            //$this->defaultDB->set('realizada_etapas','23');
            $this->defaultDB->update(self::TABLE, array('realizada_etapas' => $array['etapa']),"id = ".$array['torneio_id']);
            return true;
        }else{
            return false;
        }
    }
    
    function verificarJogadorTorneio($array){
        $this->defaultDB->where($array);
        if($this->defaultDB->get(self::TABLE_JOGADOR_TORNEIO)->num_rows()>0){
            return false;
        }else{
            return true;
        }
        
    }
    
    function verificarJogadorCodigo($array){
        $this->defaultDB->where($array);
        if($this->defaultDB->get(self::TABLE_JOGADOR)->num_rows()>0){
            return false;
        }else{
            return true;
        }
        
    }
    
    function deletarJogadorTorneio($array){
        $this->defaultDB->where($array);
        if($this->defaultDB->delete(self::TABLE_JOGADOR_TORNEIO)){
            return true;
        }else{
            return false;
        }
    }
}