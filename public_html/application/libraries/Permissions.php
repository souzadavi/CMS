<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends Tank_auth {

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
		$this->ci->load->config('config', TRUE);
    }
    
    function check_permission($id_rule)
    {
        if($this->is_logged_in()){
            if(!$this->_checked($id_rule)){
                $this->deny_access('negada',$id_rule);
				echo "erro";
            }
        }else{
            $this->deny_access('login');
			echo "erro2";
        }
    }

    function _checked($id_rule){
        $this->ci->db->select('users_has_rules.id');
        //$this->ci->db->join('roles', 'roles.id = roles_to_users.role_id');
        $this->ci->db->from('users_has_rules');
        $this->ci->db->where('users_has_rules.users_id', $this->get_user_id());
		$this->ci->db->where('users_has_rules.users_rules_id', $id_rule);
        $query = $this->ci->db->get();
        $result = $query->row_array();
        if($result){
            return true;
        }else{
            return false;
        }
    }

	function monta_menu($id_pai = '0'){
		///SELECT uhr.*, ur.nome FROM users_has_rules AS uhr INNER JOIN users_rules AS ur ON ur.id = uhr.users_rules_id WHERE uhr.users_id = 5 AND ur.pai = 0
		$this->ci->db->select('users_has_rules.*');
		$this->ci->db->select('users_rules.nome');
		$this->ci->db->select('users_rules.url');
        $this->ci->db->join('users_rules', 'users_rules.id = users_has_rules.users_rules_id');
        $this->ci->db->from('users_has_rules');
        $this->ci->db->where('users_has_rules.users_id', $this->get_user_id());
		$this->ci->db->where('users_rules.pai', $id_pai);
		$this->ci->db->where('users_rules.hidden', '0');/// deve ser zero para não aparecer no menu
        //$query = $this->ci->db->get();
		return $this->ci->db->get()->result();
	}

    function deny_access($url,$id_rule){
		$data = array(
               'url' => $_SERVER['PATH_INFO'],
               'users_id' => $this->get_user_id(),
               'users_rules_id' => $id_rule,
			   'ip' => $_SERVER['REMOTE_ADDR']
            );
		$this->ci->db->insert('users_rules_logs',$data);
		
        $this->ci->load->helper('url');
        redirect($this->ci->config->item('base_cms').$url, 'location');
        exit;
    }
}
/* End of file Permissions.php */
/* Location: ./application/libraries/Permissions.php */