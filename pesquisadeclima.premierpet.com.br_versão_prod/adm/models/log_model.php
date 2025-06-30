<?php

class Log_Model extends Model {

	function __construct() {
		parent::__construct();
	}

	function instanceDB() {
		return $this->db;
	}

	function xhrGetListings ($pagina) {
		$inicio   = ($pagina - 1) * LIMITE;
		$condicao = "";

		if($_POST['empresa'] != "") {
			$condicao .= " AND ls.idempresa=".intval($_POST['empresa']);
		}

		if(strlen($_POST['descricao']) > 0) {
			$condicao .= " AND UPPER(TRIM(ls.descricao)) LIKE '%" . strtoupper(trim($_POST['descricao'])) . "%' ";
		}

		//Ajuste de data no Log
		$sql = "SELECT
            u.login as usuario, 
            em.nome as empresa, 
            count(1) OVER() as total,
            ls.descricao, 
            DATE_FORMAT(ls.data_criacao, '%d/%m/%Y %H:%i') as data
        FROM log_sistema as ls
        INNER JOIN users as u ON u.id=ls.idusers
        INNER JOIN empresa as em ON em.id=ls.idempresa
        WHERE 1=1 " . $condicao . "
        ORDER BY ls.data_criacao DESC";


		// $sql = "SELECT
		// 			u.login as usuario, em.nome as empresa, count(1) OVER() as total,
		// 			ls.descricao, date_format(ls.data_criacao, 'DD/MM/YYYY HH24:MI') as data
		// 			FROM log_sistema as ls
		// 			INNER JOIN users as u ON u.id=ls.idusers
		// 			INNER JOIN empresa as em ON em.id=ls.idempresa
		// 			WHERE 1=1 " . $condicao . "
		// 			ORDER BY ls.data_criacao DESC ";

		$sth = $this->db->prepare($sql . " LIMIT ". LIMITE . " OFFSET " . $inicio);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

}