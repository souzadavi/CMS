<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Conteudo_model extends CI_Model {
    const TABLE			= 'conteudo';
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
       $this->defaultDB->order_by("titulo ASC");
       return $this->defaultDB->get('conteudo');
    }
	
	function getConteudo($id){
        $this->defaultDB->where('id',$id);
        return $this->defaultDB->get(self::TABLE);
    }
	function atualizar($id,$array){
		$this->defaultDB->where('id', $id);
		$this->defaultDB->update(self::TABLE, $array);
		return true;
   }

}