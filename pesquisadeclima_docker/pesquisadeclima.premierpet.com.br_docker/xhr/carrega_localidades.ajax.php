<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/json; charset=UTF-8');

	require '../class/banco.class.php';
	require '../class/conexao.class.php';
	require '../inc/config.php';

	$setor = trim($_GET['setor']);

	$p = array();

	$sql = "SELECT id, nome FROM premier_setor WHERE dourado = " . (int) $setor . " ORDER BY nome;";
	
	$db = new Conexao($banco);			
	$rs = $db->sel($sql);
	$db = NULL;
			
	foreach($rs as $row) {
		$p[] = array(
			"id"					=> $row['id'],
			"nome"					=> utf8_encode($row['nome'])
		);
	}

	echo(json_encode($p));