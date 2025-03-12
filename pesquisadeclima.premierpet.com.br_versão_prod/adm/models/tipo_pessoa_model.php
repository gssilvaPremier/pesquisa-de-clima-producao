<?php

class Tipo_pessoa_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function tipoList() {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM tipo_pessoa');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function singleType($id) {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM tipo_pessoa WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function create($data) {
		$sth = $this->db->prepare('INSERT INTO tipo_pessoa (descricao, ativo) 
									VALUES (:descricao,:ativo)');
		$sth->execute(array(
				':descricao' => $data[descricao],
				':ativo' => $data[status]										
				));	
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE tipo_pessoa
										  SET descricao=:descricao, ativo=:ativo
										  WHERE id=:id;');
		$sth->execute(array(
				':descricao' => $data[descricao],
				':ativo' => $data[status],
				':id' => $data[id]
				));	
	}
	
	function edit($id) {
		
	}
	
	function delete($id) {
		$sth = $this->db->prepare('DELETE FROM tipo_pessoa WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'tipo_pessoa');	
	}
	
	
}


?>