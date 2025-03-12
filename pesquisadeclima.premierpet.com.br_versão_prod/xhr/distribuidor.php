<?php
@session_start();

require '../class/banco.class.php';
require '../class/conexao.class.php';
require '../inc/config.php';
$chave_utilizada = 0;

$mensagem = "";

	$db = new Conexao($banco);
	$rs = $db->sel("SELECT valida FROM chaves WHERE chave= '".trim($_SESSION['chave'])."'; ");


	if(count($rs) > 0) {

		if($rs[0]['valida'] == 0) {
			$mensagem = '<strong>Erro</strong> Chave de acesso j&aacute; utilizada <a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>';
			@session_destroy();
			$chave_utilizada = 1;
		} else {

			$insert  = "";
			$insert .= "INSERT INTO votos(distribuidor_setor, idempresa, chave, campo, voto) VALUES (" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao1', '".(int)$_POST['visao1']."'), ";
            $insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao2', '".(int)$_POST['visao2']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao3', '".(int)$_POST['visao3']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao4', '".(int)$_POST['visao4']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao5', '".(int)$_POST['visao5']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao6', '".(int)$_POST['visao6']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao7', '".(int)$_POST['visao7']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao8', '".(int)$_POST['visao8']."'), ";
			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'visao_justificativa', '".converte($_POST['visao_justificativa'])."'), ";


			$insert .= "(" . (int) $_SESSION['distribuidor_setor'] . ", " .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comentario_distribuidor', '".converte($_POST['comentario'])."'); ";
		    
		    	
			$update .= "UPDATE chaves SET valida=0 WHERE chave= '".trim($_SESSION['chave'])."'; ";


			$db->query("begin;");
			$r = $db->query($insert);
			$r = $db->query($update);
			if($r) {
				$db->query("commit;");
				@session_destroy();
				//$mensagem = '<strong>Sucesso</strong>, formul&aacute;rio foi enviado com sucesso <a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>';
				//$mensagem = '<a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>';
			} else {
				$db->query("rollback;");
				$mensagem = '<strong>Erro</strong>, ocorreu um erro  ao enviar o formul&aacute;rio <a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>';
			}


		}

	} else {
		$mensagem = '<strong>Erro</strong> Chave de acesso n&atilde;o encontrada em nosso sistema <a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>';
	}


	$db = NULL;

	echo $mensagem;
	if($chave_utilizada == 1) {
		echo '<meta http-equiv="refresh" content="2">';
	}

?>