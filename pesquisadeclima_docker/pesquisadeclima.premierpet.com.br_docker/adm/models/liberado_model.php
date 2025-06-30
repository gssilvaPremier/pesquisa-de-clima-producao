<?php

class Liberado_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function userList() {
		$sth = $this->db->prepare('SELECT * FROM clientes');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function instanceDB() {
		return $this->db;	
	}
	
	function singleUser($id) {
		$sth = $this->db->prepare('SELECT * FROM clientes WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function delete($id) {
		$sth = $this->db->prepare('DELETE FROM clientes WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'falta/listar');	
	}
	
	function impressao() {
		
		Session::init();
		if(Session::get('liberado_impressao') != "") {
			$sth = $this->db->prepare(Session::get('liberado_impressao'));		
		}
										
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
		
	}
	
	function xhrGetListings ($pagina) {		
		$inicio   = ($pagina - 1) * LIMITE;		
		$condicao = "";
		
		
		if($_POST['tipo_pessoa']) {
			$condicao .= " AND c.idtipo_pessoa = " . (int)$_POST['tipo_pessoa'];
		}
		
		if(strlen($_POST['motivo']) > 1) {
			$condicao .= " AND UPPER(c.motivos)  LIKE '%" . Func::removeCaracters($_POST['motivo']) . "%' ";
		}
		
		if(strlen($_POST['data_de']) == 10 && strlen($_POST['data_ate']) == 10) {
			$condicao .= " AND (c.data_inicio >= '" . date("Y-m-d", strtotime(str_replace("/", "-", $_POST['data_de']))) . "' AND c.data_inicio <= '" . date("Y-m-d", strtotime(str_replace("/", "-", $_POST['data_ate']))) . "') ";
		}
		
		
		$sql = "SELECT 	
						c.nome, tp.descricao as tipo_pessoa, to_char(c.data_inicio, 'DD/MM/YYYY')::varchar(10) as data_inicio, c.liberados, c.motivos, c.telefone2 as celular, c.email,
						count(*) OVER() total
						FROM clientes as c
						LEFT JOIN tipo_pessoa as tp ON tp.id=c.idtipo_pessoa
						WHERE c.liberados <> ''
						" . $condicao;
				
		$sth = $this->db->prepare($sql . " ORDER BY c.nome ASC
										   LIMIT ". LIMITE . ' OFFSET ' . $inicio);
		
		Session::init();
		Session::set('liberado_impressao', $sql . " ORDER BY c.nome ASC ");	
		Session::set('impressao_de', $_POST['data_de']);
		Session::set('impressao_ate', $_POST['data_ate']);	
										
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	
}


?>