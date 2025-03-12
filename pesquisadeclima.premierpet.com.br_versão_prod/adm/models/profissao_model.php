<?php

class Profissao_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function profissaoList() {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM profissao');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function singleProf($id) {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM profissao WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function create($data) {
		$sth = $this->db->prepare('INSERT INTO profissao (descricao,ativo) 
									VALUES (:descricao,:ativo)');
		$sth->execute(array(
				
				':descricao' => $data[descricao],
				':ativo' => $data[status]
										
				));	
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE profissao
										  SET descricao=:descricao, ativo=:ativo
										  WHERE id=:id;');
		$sth->execute(array(
				
				':descricao' => $data[descricao],
				':ativo' => $data[ativo],
				':id' => $data[id]
				));	
	}
	
	function edit($id) {
		
	}
	
	function delete($id) {
		$sth = $this->db->prepare('DELETE FROM profissao WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'profissao');	
	}
	
	
}


?>