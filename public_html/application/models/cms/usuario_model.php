<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    const TABLE			= 'users';
	const TABLE_PROFILE		= 'user_profiles';
   
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
	 
    function getAllUsuario() {
       $this->defaultDB->order_by("username ASC");
       //return $this->defaultDB->get(self::TABLE);
	   return $this->defaultDB->query("SELECT *, DATE_FORMAT(last_login,'%d/%m/%Y') AS last_login, DATE_FORMAT(modified,'%d/%m/%Y') AS modified FROM ".self::TABLE." ORDER BY username ASC");
    }
	
	function getUsuario($id){
        $this->defaultDB->where('id',$id);
        return $this->defaultDB->get(self::TABLE);
    }
	
	function getProfile($id){
        $this->defaultDB->where('user_id',$id);
        return $this->defaultDB->get(self::TABLE_PROFILE);
    }
	
	function atualizar($id,$array){
		$this->defaultDB->where('id', $id);
		$this->defaultDB->update(self::TABLE, $array);
		return true;
   }
   
   function atualizarProfile($id,$array){
		$this->defaultDB->where('user_id', $id);
		if($this->defaultDB->get(self::TABLE_PROFILE)->num_rows() == 0){
			$this->defaultDB->insert(self::TABLE_PROFILE, $array);
		}else{
			$this->defaultDB->update(self::TABLE_PROFILE, $array);
		}return true;
   }

}