<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logs {

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
		$this->ci->load->config('config', TRUE);
    }
	
	function gravar($array){
		 $this->ci->db->insert('log',$array); 
	}
}
/* End of file Log.php */
/* Location: ./application/libraries/Log.php */