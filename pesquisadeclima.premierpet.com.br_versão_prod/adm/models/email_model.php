<?php

class Email_Model extends Model {

	function __construct() {
		parent::__construct();
		$this->condicao_premier = NULL;
	}

	function instanceDB() {
		return $this->db;
	}

	function envia($qtd){

		$sql = "SELECT
					e.id, e.email, c.idempresa,  c.chave, ('UPDATE emails SET reenviou = 1 WHERE id=' || e.id) as query
					FROM emails e
					LEFT JOIN ref_email_chave as r ON r.idemails=e.id
					LEFT JOIN chaves as c ON c.id=r.idchaves
					WHERE e.reenviou = 0
					LIMIT " . $qtd . ";";

		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		$i = 0;

		foreach ($data as $key => $value) {

			$executou = $this->db->exec($value['query']);

			if($executou) {
				Func::enviaEmail(intval($value['id']), 'PremierPet', $value['email'], intval($value['idempresa']), true);
				$i++;
			}
		}

		echo "Foi(ram) reenviado(s) <b>" . $i . "</b> email(s)";

	}

	function xhrGetListings () {

		$sql = "SELECT
					e.nome,
					COUNT(1) votos
					FROM empresa as e
					INNER JOIN chaves AS c ON c.idempresa=e.id
					WHERE valida=0
					GROUP BY e.nome";

		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

}