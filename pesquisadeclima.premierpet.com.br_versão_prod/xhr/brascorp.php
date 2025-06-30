<?php
session_start();

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
			$insert .= "INSERT INTO votos(idempresa, chave, campo, voto) VALUES (" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao1', '".(int)$_POST['direcao1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao2', '".(int)$_POST['direcao2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao3', '".(int)$_POST['direcao3']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao4', '".(int)$_POST['direcao4']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao5', '".(int)$_POST['direcao5']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao6', '".(int)$_POST['direcao6']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao7', '".(int)$_POST['direcao7']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao8', '".(int)$_POST['direcao8']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao9', '".(int)$_POST['direcao9']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao10', '".(int)$_POST['direcao10']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'direcao_justificativa', '".converte($_POST['direcao_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio1', '".(int)$_POST['beneficio1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio2', '".(int)$_POST['beneficio2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio3', '".(int)$_POST['beneficio3']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio4', '".(int)$_POST['beneficio4']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio5', '".(int)$_POST['beneficio5']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio6', '".(int)$_POST['beneficio6']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio7', '".(int)$_POST['beneficio7']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'beneficio_justificativa', '".converte($_POST['beneficio_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores1', '".(int)$_POST['gestores1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores2', '".(int)$_POST['gestores2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores3', '".(int)$_POST['gestores3']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores4', '".(int)$_POST['gestores4']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores5', '".(int)$_POST['gestores5']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores6', '".(int)$_POST['gestores6']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores7', '".(int)$_POST['gestores7']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores8', '".(int)$_POST['gestores8']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores9', '".(int)$_POST['gestores9']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores10', '".(int)$_POST['gestores10']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores11', '".(int)$_POST['gestores11']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores12', '".(int)$_POST['gestores12']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores13', '".(int)$_POST['gestores13']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores14', '".(int)$_POST['gestores14']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores15', '".(int)$_POST['gestores15']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores16', '".(int)$_POST['gestores16']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores17', '".(int)$_POST['gestores17']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores18', '".(int)$_POST['gestores18']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'gestores_justificativa', '".converte($_POST['gestores_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'recursos_humanos1', '".(int)$_POST['recursos_humanos1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'recursos_humanos2', '".(int)$_POST['recursos_humanos2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'recursos_humanos3', '".(int)$_POST['recursos_humanos3']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'recursos_humanos4', '".(int)$_POST['recursos_humanos4']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'recursos_humanos_justificativa', '".converte($_POST['recursos_humanos_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comunicacao_interna1', '".(int)$_POST['comunicacao_interna1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comunicacao_interna2', '".(int)$_POST['comunicacao_interna2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comunicacao_interna_justificativa', '".converte($_POST['comunicacao_interna_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'seguranca_trabalho1', '".(int)$_POST['seguranca_trabalho1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'seguranca_trabalho2', '".(int)$_POST['seguranca_trabalho2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'seguranca_trabalho_justificativa', '".converte($_POST['seguranca_trabalho_justificativa'])."'), ";

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'tecnologia_informacao1', '".(int)$_POST['tecnologia_informacao1']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'tecnologia_informacao2', '".(int)$_POST['tecnologia_informacao2']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'tecnologia_informacao3', '".(int)$_POST['tecnologia_informacao3']."'), ";
			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'tecnologia_informacao_justificativa', '".converte($_POST['tecnologia_informacao_justificativa'])."'), ";
			

			$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'trabalho', '".(int)$_POST['trabalho']."'), ";

		//	$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comentario_fazenda', '".converte($_POST['comentario'])."'), ";

			if(1==2){
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros1', '".(int)$_POST['outros1']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros2', '".(int)$_POST['outros2']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros3', '".(int)$_POST['outros3']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros4', '".(int)$_POST['outros4']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros5', '".(int)$_POST['outros5']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros6', '".(int)$_POST['outros6']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros7', '".(int)$_POST['outros7']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'outros_justificativa', '".converte($_POST['outros_justificativa'])."'), ";
			}

			if(1==2){
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office1', '".(int)$_POST['home_office1']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office2', '".(int)$_POST['home_office2']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office3', '".(int)$_POST['home_office3']."'), ";
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office4', '".(int)$_POST['home_office4']."'), ";

				$home_office5 = '';
				if(strlen(@$_POST['home_office_aumento']) > 2){
					$home_office5 .= @$_POST['home_office_aumento'] . ",";
				}

				if(strlen(@$_POST['home_office_flexibilidade']) > 2){
					$home_office5 .= @$_POST['home_office_flexibilidade'] . ",";
				}

				if(strlen(@$_POST['home_office_qualidade']) > 2){
					$home_office5 .= @$_POST['home_office_qualidade'] . ",";
				}

				if(strlen(@$_POST['home_office_possibilidade']) > 2){
					$home_office5 .= @$_POST['home_office_possibilidade'] . ",";
				}

				if(strlen(@$_POST['home_office_tempo']) > 2){
					$home_office5 .= @$_POST['home_office_tempo'] . ",";
				}

				if(strlen($home_office5) > 2){
					$home_office5 = substr($home_office5, 0, -1);

					$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office_multipla1', '".converte($home_office5)."'), ";			
				}
				$insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'home_office_justificativa', '".converte($_POST['home_office_justificativa'])."'), ";			
			}

	        $insert .= "(" .(int)$_SESSION['empresa'] . ", '" . $_SESSION['chave'] . "', 'comentario_fazenda', '".converte($_POST['comentario'])."'); ";

           
			//include ('padrao.php');
			
			$update  = "";
			$update .= "UPDATE chaves SET valida=0 WHERE chave= '".trim($_SESSION['chave'])."'; ";

			$db->query("begin;");
			$r = $db->query($insert);
			$r = $db->query($update);
			if($r) {
				$db->query("commit;");
				@session_destroy();
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