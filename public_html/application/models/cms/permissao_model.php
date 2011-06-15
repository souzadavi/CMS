<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissao_model extends CI_Model {
    const TABLE			= 'permissao';
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
	 
    function getAllPermissao() {
       //$this->defaultDB->order_by("username ASC");
       return $this->defaultDB->get(self::TABLE);
    }
	
	function getLogsPermissao($id){
        $this->defaultDB->where('id',$id);
        return $this->defaultDB->get(self::TABLE);
    }
	function atualizar($id,$idPermissao){
		$this->defaultDB->where('users_id', $id);
		$this->defaultDB->where('users_rules_id', $idPermissao);
		if($this->defaultDB->get("users_has_rules")->num_rows() > 0){
			// deletar linha do BD
			$this->defaultDB->where('users_id', $id);
			$this->defaultDB->where('users_rules_id', $idPermissao);
			$this->defaultDB->delete('users_has_rules'); 
		}else{
			// inserir linha do BD
			$data = array(
               'users_id' => $id,
               'users_rules_id' => $idPermissao,
			   'ip' => $this->input->ip_address()
            );
			$this->defaultDB->insert('users_has_rules', $data); 
		}
		
		
		
		//$this->defaultDB->update(self::TABLE, $array);
		return true;
   }
   function habilitadas($id){
		$this->defaultDB->select('users_rules.id','users_rules.nome','users_rules.pai','users_has_rules.users_id','users_has_rules.users_rules_id');
		$this->defaultDB->from('user_rules');
		$this->defaultDB->join('users_has_rules', 'users_has_rules.users_rules_id = users_rules.id');
		$this->defaultDB->where('users_has_rules.users_id',$id);
		
   }
   function listar($id){
	   return $this->defaultDB->query("SELECT pai.nome AS pai_nome, pai.id AS pai_id, pai1.id AS filho1_id, pai1.nome AS filho1_nome, pai2.id AS filho2_id, pai2.nome AS filho2_nome, 
					IF((SELECT uhr.users_rules_id FROM users_has_rules AS uhr WHERE uhr.users_rules_id = pai.id AND uhr.users_id = $id), '1','0') AS habilitadaP,
					IF((SELECT uhr.users_rules_id FROM users_has_rules AS uhr WHERE uhr.users_rules_id = pai1.id AND uhr.users_id = $id), '1','0') AS habilitada,
					IF((SELECT uhr.users_rules_id FROM users_has_rules AS uhr WHERE uhr.users_rules_id = pai2.id AND uhr.users_id = $id), '1','0') AS habilitada2
					FROM users_rules AS pai
					LEFT OUTER JOIN users_rules AS pai1 ON pai1.pai = pai.id
					LEFT OUTER JOIN users_rules AS pai2 ON pai2.pai = pai1.id
					WHERE pai.pai = 0 AND pai.moduloAtivado = 1 ORDER BY pai_nome, filho1_nome");
   }
/*
//LISTAGEM COMPLETA VERIFICANDO PERMISSOES ATIVA OU DESATIVADAS   
SELECT pai.nome AS pai_nome, pai.id AS pai_id, pai1.id AS filho1_id, pai1.nome AS filho1_nome, pai2.id AS filho2_id, pai2.nome AS filho2_nome, 
IF((SELECT uhr.users_rules_id FROM users_has_rules AS uhr WHERE uhr.users_rules_id = pai1.id AND uhr.users_id = 17), '1','0') AS habilitada,
IF((SELECT uhr.users_rules_id FROM users_has_rules AS uhr WHERE uhr.users_rules_id = pai2.id AND uhr.users_id = 17), '1','0') AS habilitada2
FROM users_rules AS pai
LEFT OUTER JOIN users_rules AS pai1 ON pai1.pai = pai.id
LEFT OUTER JOIN users_rules AS pai2 ON pai2.pai = pai1.id
WHERE pai.pai = 0 ORDER BY pai_nome, filho1_nome
*/ 
   
/*
/// PEGAR PERMISSOES HABILITADAS
SELECT ur.id, ur.nome, ur.pai, uhr.users_id, uhr.users_rules_id 
FROM users_rules AS ur INNER JOIN users_has_rules AS uhr ON uhr.users_rules_id = ur.id WHERE uhr.users_id = 5

/// Pegar Permissões desabilitadas
SELECT DISTINCT ur.id 
FROM users_rules AS ur WHERE ur.id NOT IN (SELECT uhr.id FROM users_has_rules AS uhr WHERE uhr.users_id = 5);
*/ 

}