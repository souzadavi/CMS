<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mensagem {

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
		$this->ci->load->config('config', TRUE);
    }

    function call($mensagem){
         return "mensagem('".$mensagem."')";
    }
}
/* End of file Permissions.php */
/* Location: ./application/libraries/mensagem.php */