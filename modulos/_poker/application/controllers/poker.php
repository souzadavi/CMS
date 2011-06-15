<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poker extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->Model(base_cms() . "poker_model");
        $this->config->load('poker');
    }

    function index($id) {

        $data['torneios'] = $this->poker_model->getAllTorneioStatus(1);
        $data['ranking'] = $this->poker_model->getRanking($id);
        $data['torneioID'] = $id;
        
        $this->load->view('poker_ranking', $data);
    }
    
    function torneioAlterar(){
        redirect(base_url()."poker/index/".$this->input->post('torneio'));
    }
}