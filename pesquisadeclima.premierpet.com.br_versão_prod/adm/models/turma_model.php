<?php

class Turma_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function turmaList() {
		$sth = $this->db->prepare('SELECT * FROM turma');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function instanceDB() {
		return $this->db;	
	}
	
	function singleTurma($id) {
		$sth = $this->db->prepare('SELECT * FROM turma WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function create($data) {
		$sth = $this->db->prepare('INSERT INTO turma (nome,descricao,ativo,idpessoa_responsavel, idtipo_assistencial,idfrequencia) 
									VALUES (:nome,:descricao,:ativo,:responsavel,:idtipo_assistencial,:idfrequencia)');
		$sth->execute(array(
				':nome' => $data[nome],
				':descricao' => $data[descricao],
				':ativo' => $data[status],
				':responsavel' => $data[responsavel],				
			    ':idtipo_assistencial' => $data[idtipo_assistencial],
				':idfrequencia' => $data[idfrequencia]					
				));	
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE turma
										  SET nome=:nome, descricao=:descricao, ativo=:ativo,idpessoa_responsavel=:responsavel,idtipo_assistencial=:idtipo_assistencial,idfrequencia=:idfrequencia
										  WHERE id=:id;');
		$sth->execute(array(
				':nome' => $data[nome],
				':descricao' => $data[descricao],
				':ativo' => $data[status],
				':id' => $data[id],
				':responsavel' => $data[responsavel],
				':idtipo_assistencial' => $data[idtipo_assistencial],
				':idfrequencia' => $data[idfrequencia]
				));		
				
	}
	
	function edit($id) {
		
	}
	
	function delete($id) {
		$sth = $this->db->prepare('DELETE FROM turma WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'turma');	
	}
	
	function xhrGetListings () {
		$sth = $this->db->prepare('SELECT 
										t.id,
										t.nome,
										t.ativo,
										t.descricao,
										c.nome responsavel,
										ta.descricao tipo,
										UPPER(f.descricao) frequencia,
										count(*) OVER() total
										FROM turma t
										LEFT JOIN clientes c ON c.id=t.idpessoa_responsavel
										LEFT JOIN tipo_assistencial ta ON ta.id=t.idtipo_assistencial
										LEFT JOIN frequencia f ON f.id = t.idfrequencia;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	function xhrGetList () {
		$sth = $this->db->prepare('SELECT id, nome, descricao FROM turma WHERE idtipo_assistencial ='.$_GET['tipo_assistencial'].' AND ativo=1 ORDER BY nome;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	function xhrGetListAssistencial () {
		$sth = $this->db->prepare('SELECT 
										ta.id, ta.descricao as nome
										FROM tipo_assistencial ta
										INNER JOIN turma t ON t.idtipo_assistencial=ta.id
										WHERE ta.ativo=1 AND t.idfrequencia='.(int)$_GET['frequencia'].'
										GROUP BY ta.id, ta.descricao
										ORDER BY ta.descricao;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
}


?>