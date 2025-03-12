<?php


class Dashboard_Model extends Model {

	function __construct() {
		parent::__construct();
	}

	function xhrInsert() {

		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			$text = Func::antiInjection($_POST['text']);

			$sth = $this->db->prepare('INSERT INTO dados (texto) VALUES (:texto)');
			$sth->execute(array(
							':texto' => $text)
							);
			$data = array('texto' => $text, 'id' => $this->db->lastInsertId('dados_id_seq'));
			echo json_encode($data);
		}

	}

	function instanceDB() {
		return $this->db;
	}

	function xhrGetListings () {
		$sth = $this->db->prepare('SELECT * FROM dados');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		echo json_encode($data);
	}


	function xhrDeleteListing() {
		$id = $_POST['id'];
		$sth = $this->db->prepare('DELETE FROM dados WHERE id = ' . $id);
		$sth->execute();
	}


}



?>