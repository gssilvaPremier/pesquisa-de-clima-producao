<?php

class Apuracao_Model extends Model {

	function __construct() {
		parent::__construct();
		$this->condicao_premier = NULL;
	}

	function xhrGetListings () {

// 		$sql = "SELECT
// 					e.nome,
// 					COUNT(1) votos
// 					FROM empresa as e
// 					INNER JOIN chaves AS c ON c.idempresa=e.id
// 					WHERE valida=0
// 					GROUP BY e.nome";
        $sql = "SELECT 
                    e.nome, 
                    CASE 
                        WHEN e.id = 3 THEN (
                            SELECT COUNT(*) 
                            FROM (
                                SELECT v.chave 
                                FROM premier_setor p 
                                INNER JOIN votos v ON v.premier_setor = p.id 
                                GROUP BY p.id, v.chave
                            ) AS sub
                        )
                        ELSE COUNT(c.id)
                    END AS votos
                FROM empresa AS e
                LEFT JOIN chaves AS c ON c.idempresa = e.id AND c.valida = 0
                GROUP BY e.nome, e.id
                HAVING votos > 0;";

		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

	function xhrGetListingsSetorPremier () {

		$sql = "SELECT CASE WHEN p.dourado = 0 THEN
						'Escritório SP'
					WHEN p.dourado = 1 THEN
						'Fabrica Dourado'
					WHEN p.dourado = 2 THEN
						'Cd''s Centros de Distribuição'
					WHEN p.dourado = 3 THEN
						'Demais Localidades'
					WHEN p.dourado = 4 THEN
						'Esc. Rondon&oacute;polis'
					WHEN p.dourado = 5 THEN
						'F&aacute;brica Paran&aacute;'
					END localidade,
					p.nome as setor, count(1) as qtd_votos FROM (
				SELECT
					count(1), p.id, v.chave
					FROM premier_setor p
					INNER JOIN votos as v ON v.premier_setor=p.id
					GROUP BY p.id, v.chave) AS t
				INNER JOIN premier_setor as p ON p.id=t.id
				GROUP BY p.nome,p.dourado
				ORDER BY p.dourado, p.nome";

		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

	function xhrGetListingsSetorProgato() {
		$sql = "SELECT 
                    ps.nome AS setor,
                    COUNT(DISTINCT v.chave) AS qtd_votos
                FROM progato_setor ps
                LEFT JOIN votos v ON v.progato_setor = ps.id
                WHERE LEFT(v.chave, 1) = 'r' 
                GROUP BY ps.nome
                ORDER BY ps.nome";
					
		// Preparação e execução da consulta
		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
	
		return $sth->fetchAll();
	}

	function xhrGetListingsSetorGrandfood() {
		$sql = "SELECT 
                    fs.nome AS setor,
                    COUNT(DISTINCT v.chave) AS qtd_votos
                FROM granfood_setor fs
                LEFT JOIN votos v ON fs.id = v.fazenda_setor
                WHERE v.idempresa = 1
                GROUP BY fs.nome
                ORDER BY fs.nome;";
					
		// Preparação e execução da consulta
		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
	
		return $sth->fetchAll();
	}
	

	function instanceDB() {
		return $this->db;
	}

}