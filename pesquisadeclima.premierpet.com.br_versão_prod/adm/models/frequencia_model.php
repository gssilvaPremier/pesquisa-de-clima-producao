<?php

class Frequencia_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function freqList() {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM frequencia');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function singleFreq($id) {
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM frequencia WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function create($data) {
		$sth = $this->db->prepare('INSERT INTO frequencia (descricao, ativo) 
									VALUES (
									:descricao,:ativo)');
		$sth->execute(array(
				':descricao' => $data[descricao],
				':ativo' => $data[status]							
				));	
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE frequencia 
										SET descricao=:descricao, 
											ativo=:ativo 
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
		$sth = $this->db->prepare('DELETE FROM frequencia WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'frequencia');	
	}
	
	
}


?>