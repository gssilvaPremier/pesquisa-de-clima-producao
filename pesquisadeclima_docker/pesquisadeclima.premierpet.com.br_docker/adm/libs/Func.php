<?php

require 'api/phpmailer/class.phpmailer.php';

class Func {

	public static function trocaTexto($texto, $key = 'X'){

		if(strlen(trim($texto)) > 0){
			return $key;
		} else {
			return '';
		}
	}

	public static function validaEmail($email){

		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		} else {
			return false;
		}
	}

	public static function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
			// Caracteres de cada tipo
			$lmin = 'abcdefghijklmnopqrstuvwxyz';
			$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$num = '1234567890';
			$simb = '!@#$%*-';
			// Variáveis internas
			$retorno = '';
			$caracteres = '';
			// Agrupamos todos os caracteres que poderão ser utilizados
			$caracteres .= $lmin;
			if ($maiusculas) $caracteres .= $lmai;
			if ($numeros) $caracteres .= $num;
			if ($simbolos) $caracteres .= $simb;
			// Calculamos o total de caracteres possíveis
			$len = strlen($caracteres);
			for ($n = 1; $n <= $tamanho; $n++) {
			// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
			$rand = mt_rand(1, $len);
			// Concatenamos um dos caracteres na variável $retorno
			$retorno .= $caracteres[$rand-1];
			}
			return strtolower($retorno);
	}


	/****** REMOVE CARACTERES **************/
	public static function removeCaracters($string) {

		$string = trim($string);
		$string = addslashes($string);

		$map =  array (

			'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
			'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
			'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
			'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
			'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Ŕ' => 'R',
			'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
			'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
			'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
			'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
			'þ' => 'b', 'ÿ' => 'y', 'ŕ' => 'r'
		);


		$string = strtolower($string);
		$string = strtr($string,$map);

		return strtoupper(trim($string));

	}

	/****** RETORNA NIVEL EM STRING **************/
	public static function getNivel($nivel) {
		if($nivel == 2) {
			return "Usuários";
		} else if($nivel == 1) {
			return "Gerentes";
		} else {
			return "Administradores";
		}
	}

	/****** RETORNA ATIVO EM STRING **************/
	public static function getInativo($nivel) {
		if($nivel == 0) {
			return "Ativo";
		} else {
			return "Inativo";
		}
	}

	/****** RETORNA ATIVO EM STRING **************/
	public static function getAtivo($nivel) {
		if($nivel == 1) {
			return "Ativo";
		} else {
			return "Inativo";
		}
	}

	/****** DATA **************/
	public static function setData($data) {
		$d = explode("/", $data);
		return date($d[2] . '-' . $d[1] . '-' . $d[0]);
	}


	/****** FUNÇÃO ANTI INJECTION SQL **************/
	public static function antiInjection($campo, $adicionaBarras = false) {

		$campo = preg_replace("/(from|alter table|select|insert|delete|update|were|drop table|show tables|#|\*|--|\\\\)/i","",$campo);
		$campo = trim($campo);
		$campo = strip_tags($campo);
		
		
	
	//	if($adicionaBarras) {
			$campo = addslashes($campo);
			return $campo;
	//	}

	}

	/****** CRIAR PASTAS DO SISTEMA **************/
	public static function creatPath() {

		if(!file_exists(DIR . '/' . PASTA_VIEWS . '/' . PASTA_UPLOADS)) {
			mkdir(DIR . '/' . PASTA_VIEWS . '/' . PASTA_UPLOADS, 0777, true);
		} else {
			chmod(DIR . '/' . PASTA_VIEWS . '/' . PASTA_UPLOADS, 0777);
		}

		foreach(unserialize(PASTA_FILE) as $value) {

			$file = DIR . '/' . PASTA_VIEWS . '/' . PASTA_UPLOADS . '/' . $value;

			if(!file_exists($file)) {
				mkdir($file, 0777, true);
			} else {
				chmod($file, 0777);
			}

		}
	}

	/****** PAGINAÇÃO **************/
	public static function paginacao($total, $limite, $pag, $pagina, $retorno) {

		$prox 		= ($pag + 1);
		$ant 		= ($pag - 1);
		$ultima_pag = ceil($total / $limite);
		$penultima 	= ($ultima_pag - 1);
		$adjacentes = 2;

		$paginacao = '<nav aria-label="Page navigation"><ul class="pagination pull-right">';
		$paginacao .= '<li>
						  <a href="javascript:void(0);" onClick="'.$retorno.'('.$ant.')" aria-label="Anterior">
							<span aria-hidden="true">&laquo;</span>
						  </a>
						</li>';

		if ($ultima_pag <= 5){
			for ($i=1; $i< $ultima_pag+1; $i++)	{
				if ($i == $pag)		{
					$paginacao .= '<li class="active"><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
				} else {
					$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
				}
			}
		}

		if ($ultima_pag > 5) {
			if ($pag < 1 + (2 * $adjacentes)) {
				for ($i=1; $i< 2 + (2 * $adjacentes); $i++){
					if ($i == $pag){
						$paginacao .= '<li class="active"><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					} else {
						$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					}
				}
				$paginacao .= '<li class="disabled"><a>...</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$penultima.')">'.$penultima.'</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$ultima_pag.')">'.$ultima_pag.'</a></li>';
			} elseif($pag > (2 * $adjacentes) && $pag < $ultima_pag - 3) {
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'(1)">1</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'(1)">2</a></li><li class="disabled"><a>...</a></li> ';
				for ($i = $pag-$adjacentes; $i<= $pag + $adjacentes; $i++){
					if ($i == $pag) {
						$paginacao .= '<li class="active"><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					} else {
						$paginacao .= '<li><a href="javascript:void(0);"  onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					}
				}
				$paginacao .= '<li class="disabled"><a>...</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$penultima.')">'.$penultima.'</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$ultima_pag.')">'.$ultima_pag.'</a></li>';
			} else {
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'(1)">1</a></li>';
				$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'(1)">2</a></li><li class="disabled"><a>...</a></li> ';
				for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++){
					if($i == $pag) {
						$paginacao .= '<li class="active"><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					} else {
						$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$i.')">'.$i.'</a></li>';
					}
				}
			}
		}

		if ($prox <= $ultima_pag && $ultima_pag > 2){
			$paginacao .= '<li><a href="javascript:void(0);" onClick="'.$retorno.'('.$prox.')">&raquo;</a></li>';
		}

		if($total > 1) {
			$paginacao .= '<li class="disabled"><a>Foram encontrados <b>'.$total.' registros</a></li>';
		} else {
			$paginacao .= '<li class="disabled"><a>Foi encontrado <b>'.$total.' registro</a></li>';
		}

		$paginacao . '</ul></nav>';

		return $paginacao;
	}


// 	public static function enviaEmail($id, $nomedestinatario, $emaildestinatario, $idempresa, $reenvio = false) {

// 		$url = $_SERVER['SERVER_NAME'].URL_EMAIL;

// 		if($idempresa == '1') {
// 			$img = '<img src="http://'.$url . '/img/logo_granfood.png" />';
// 		} else if($idempresa == '2') {
// 			$img = '<img src="http://'.$url . '/img/logo_premier.png" height="50" />';
// 		} else if($idempresa == '3') {
// 			$img = '<img src="http://'.$url . '/img/logo_premier.png" height="50" />';
// 		} else if($idempresa == '4') {
// 			$img = '<img src="http://'.$url . '/img/logo_brascorp.png" />';
// 		}

// 		$img = '<img src="http://'.$url . '/img/logo_clima.png" height="100" />';

// 		$mail = new PHPMailer;
// 		$mail->IsSMTP();        								// Ativar SMTP
// 		$mail->SMTPDebug = false;       						// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
// 		$mail->SMTPAuth = true;     							// Autenticação ativada
// 		$mail->SMTPSecure = ''; 								// SSL REQUERIDO pelo GMail

// 	//	$mail->Host = 'sharedrelay-cluster.mandic.net.br'; 		//SMTP utilizado
// 	//	$mail->Port = 587;
// 	//	$mail->FromName = 'PremieRpet';
// 	//	$mail->From     = 'noreply@premierpet.com.br'; 			// EMAIL
// 	//	$mail->Username = 'premierpet@shared.mandic.net.br';  	// USUÁRIO
// 	//	$mail->Password = 'Premier@2019#'; 						// SENHA DO USUÁRIO
	
	
// 		$mail->Host = 'sharedrelay-cluster.mandic.net.br'; 		//SMTP utilizado
// 		$mail->Port = 587;
// 		$mail->FromName = 'PremieRpet';
// 		$mail->From     = 'noreply@premierpet.com.br'; 			// EMAIL
// 		$mail->Username = 'grandfood@shared.mandic.net.br';  	// USUÁRIO
// 		$mail->Password = 'Grand@2019#'; 						// SENHA DO USUÁRIO



// 		$mail->CharSet = 'UTF-8';
// 		$emailget =$emaildestinatario;

// 		$html  = ' <div style="width:700px; font-family:Arial, Lucida Grande, sans-serif; font-size:12px;">';
// 		$html .= $img;

// 		if($reenvio){
// 			$html .= '<h3 style="color:red">Caso já tenha recebido o link para preenchimento e respondido a pesquisa anteriormente, por favor desconsidere esse e-mail.</h3>';
// 		}

// 		$html .= '   <h4 style="margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;">';
// 		$html .= ' 	 <b><span style="font-size:13.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#333333">A pesquisa de clima organizacional é uma ferramenta para análise do ambiente da empresa.</span></b><span style="font-size:13.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#333333"><u></u><u></u></span></h4>';

// 		$html .= '     <p>Ela possibilita identificar pontos de melhorias no modelo de gestão, permitindo a análise da satisfação e da motivação dos nossos colaboradores.<br>';
// 		$html .= '       O preenchimento é individual e confidencial. O Colaborador não será identificado.<br>';
// 		$html .= '     Queremos ouvir você, a sua opinião é muito importante para a empresa.</p>';

// 		$html .= '     Por favor, clique no link abaixo e preencha a Pesquisa de Clima 2024:<br />';
// 		$html .= ' 	   <br />';

// 		$html .= '     <strong>Não possuo chave de acesso</strong><br />';
// 		$html .= '     Se você ainda não possui sua chave de acesso, <a href="http://'.$_SERVER['SERVER_NAME'].URL_EMAIL . 'gerador/'. $emailget. '" target="_blank">clique aqui</a> e gere agora mesmo.<br /><br />';

// 		$html .= '     <strong>Já possuo chave de acesso</strong><br />';
// 		$html .= '     Se você já possui sua chave de acesso <a href="http://'.$_SERVER['SERVER_NAME'].URL_EMAIL. '" target="_blank">clique aqui</a> e preencha nosso formulário de satisfação.';

// 		$html .= ' <hr color="#EBEBEB" />';
// 		$html .= ' Muito obrigado!<br />';
// 		$html .= ' </div>';


// 		$mail->addAddress($emaildestinatario, $nomedestinatario);

// 		if(!$reenvio){
// 			$mail->Subject = "Participe da nossa pesquisa de satisfação!";
// 		} else {
// 			$mail->Subject = "LEMBRETE – Pesquisa de Clima";
// 		}

// 		$mail->msgHTML($html);
// 		if ($mail->send()) {
// 			return array("erro" => 0, "mensagem" => "Enviado com sucesso");
// 		} else {
// 			return array("erro" => 1, "mensagem" => '<span class="text-danger">' . $mail->ErrorInfo . '</span>');			
// 		}
// 	}

public static function enviaEmail($id, $nomedestinatario, $emaildestinatario, $idempresa, $reenvio = false) {

		$url = $_SERVER['SERVER_NAME'].URL_EMAIL;

		if($idempresa == '1') {
			$img = '<img src="http://'.$url . '/img/logo_granfood.png" />';
		} else if($idempresa == '2') {
			$img = '<img src="http://'.$url . '/img/logo_premier.png" height="50" />';
		} else if($idempresa == '3') {
			$img = '<img src="http://'.$url . '/img/logo_premier.png" height="50" />';
		} else if($idempresa == '4') {
			$img = '<img src="http://'.$url . '/img/logo_brascorp.png" />';
		} else if($idempresa == '12') {
			$img = '<img src="http://'.$url . '/img/logo_progato.png" />';
		}

		$img = '<img src="http://'.$url . '/img/logo_clima.png" height="100" />';

		$mail = new PHPMailer;
		$mail->IsSMTP();        								// Ativar SMTP
		$mail->SMTPDebug = false;       						// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;     							// Autenticação ativada
		$mail->SMTPSecure = ''; 								// SSL REQUERIDO pelo GMail

	//	$mail->Host = 'sharedrelay-cluster.mandic.net.br'; 		//SMTP utilizado
	//	$mail->Port = 587;
	//	$mail->FromName = 'PremieRpet';
	//	$mail->From     = 'noreply@premierpet.com.br'; 			// EMAIL
	//	$mail->Username = 'premierpet@shared.mandic.net.br';  	// USUÁRIO
	//	$mail->Password = 'Premier@2019#'; 						// SENHA DO USUÁRIO
	
	
		$mail->Host = 'sharedrelay-cluster.mandic.net.br'; 		//SMTP utilizado
		$mail->Port = 587;
		$mail->FromName = 'PremieRpet';
		$mail->From     = 'noreply@premierpet.com.br'; 			// EMAIL
		$mail->Username = 'grandfood@shared.mandic.net.br';  	// USUÁRIO
		$mail->Password = 'Grand@2019#'; 						// SENHA DO USUÁRIO



		$mail->CharSet = 'UTF-8';
		$emailget =$emaildestinatario;

		$html  = ' <div style="width:700px; font-family:Arial, Lucida Grande, sans-serif; font-size:12px;">';
		$html .= $img;

		if($reenvio){
			$html .= '<h3 style="color:red">Caso já tenha recebido o link para preenchimento e respondido a pesquisa anteriormente, por favor desconsidere esse e-mail.</h3>';
		}

		$html .= '   <h4 style="margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;">';
		$html .= ' 	 <b><span style="font-size:13.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#333333">A pesquisa de clima organizacional é uma ferramenta para análise do ambiente da empresa.</span></b><span style="font-size:13.5pt;font-family:&quot;Helvetica&quot;,sans-serif;color:#333333"><u></u><u></u></span></h4>';

		$html .= '     <p>Ela possibilita identificar pontos de melhorias no modelo de gestão, permitindo a análise da satisfação e da motivação dos nossos colaboradores.<br>';
		$html .= '       O preenchimento é individual e confidencial. O Colaborador não será identificado.<br>';
		$html .= '     Queremos ouvir você, a sua opinião é muito importante para a empresa.</p>';

		$html .= '     Por favor, clique no link abaixo e preencha a Pesquisa de Clima 2024:<br />';
		$html .= ' 	   <br />';

		$html .= '     <strong>Não possuo chave de acesso</strong><br />';
		$html .= '     Se você ainda não possui sua chave de acesso, <a href="http://'.$_SERVER['SERVER_NAME'].URL_EMAIL . 'gerador/'. $emailget. '" target="_blank">clique aqui</a> e gere agora mesmo.<br /><br />';

		$html .= '     <strong>Já possuo chave de acesso</strong><br />';
		$html .= '     Se você já possui sua chave de acesso <a href="http://'.$_SERVER['SERVER_NAME'].URL_EMAIL. '" target="_blank">clique aqui</a> e preencha nosso formulário de satisfação.';

		$html .= ' <hr color="#EBEBEB" />';
		$html .= ' Muito obrigado!<br />';
		$html .= ' </div>';


		$mail->addAddress($emaildestinatario, $nomedestinatario);

		if(!$reenvio){
			$mail->Subject = "Pesquisa de Clima";
		} else {
			$mail->Subject = "LEMBRETE – Pesquisa de Clima";
		}

		$mail->msgHTML($html);
		if ($mail->send()) {
			return array("erro" => 0, "mensagem" => "Enviado com sucesso");
		} else {
			return array("erro" => 1, "mensagem" => '<span class="text-danger">' . $mail->ErrorInfo . '</span>');			
		}
	}



	public static function CreateLog($db, $idempresa, $descricao) {

		Session::init();
		$idusuario = intval(Session::get('idUsuario'));

		$sth = $db->prepare("INSERT INTO log_sistema(data_criacao, idusers, idempresa, descricao) VALUES ('" . date('Y-m-d H:i:s') . "', " . $idusuario . ", " . $idempresa . ", '" . $descricao . "'); ");
		$sth->execute();
	}


	/****** COMBOS **************/
	/****
	/**** READONLY -> É POSSIVEL ALTERAR OS COMBOS E OBTER O VALOR DO COMPONENTE
	/**** DISABLED -> NÃO É POSSIVEL ALTERA-LO E NEM OBTER O VALOR DO COMPONENTE
	*****/

	//EMPRESA
	public static function comboEmpresa($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
		$dis = "";
		$sth = $db->prepare("SELECT id as codigo, nome FROM empresa WHERE 1=1 $condicao ORDER BY nome;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" >Todas</option>';
				$r .= '<option value="0" disabled >--------------</option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//DISTRIBUIDOR
	public static function comboDistribuidora($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
		$dis = "";
		$sth = $db->prepare("SELECT id as codigo, nome FROM distribuidor_setor WHERE 1=1 $condicao ORDER BY nome;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" >Todas</option>';
				$r .= '<option value="0" disabled >--------------</option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//SETOR
	public static function comboSetor($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
		$dis = "";
		$sth = $db->prepare("SELECT id as codigo, nome FROM fazenda_setor WHERE 1=1 $condicao ORDER BY nome;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" >Todos</option>';
				$r .= '<option value="0" disabled >--------------</option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}
	
	//progatoSetor
		public static function progatoSetor($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
			$dis = "";
			$sth = $db->prepare("SELECT id as codigo, nome FROM progato_setor WHERE 1=1 $condicao ORDER BY nome;");
			$sth->execute();
			$r1 = $sth->fetchAll();
	
			if($disabled) {
				$dis = "disabled";
			} else if($readonly) {
				$dis = "readonly";
			}
	
			$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
				if($iniciar_index_vazio){
					$r .= '<option value="0" >Todos</option>';
					$r .= '<option value="0" disabled >--------------</option>';
				}
	
				foreach($r1 as $rs) {
					if ($valor == $rs['codigo']) {
						$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
					} else {
						$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
					}
				}
			$r .= '</select>';
	
			return $r;
		}


	//LOTE
	public static function comboLote($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
		//SELECT id codigo, UPPER(nome) as nome FROM clientes WHERE inativo = 0  ORDER BY nome ASC;
		$dis = "";
		$sth = $db->prepare("SELECT data_geracao as codigo, data_geracao as nome FROM chaves WHERE valida =1 GROUP BY data_geracao;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//PESSOAS
	public static function comboPessoas($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {
		//SELECT id codigo, UPPER(nome) as nome FROM clientes WHERE inativo = 0  ORDER BY nome ASC;
		$dis = "";
		$sth = $db->prepare("SELECT id codigo, UPPER(nome) as nome FROM clientes WHERE inativo=0 $condicao ORDER BY nome ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.utf8_encode($rs['nome']).'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.utf8_encode($rs['nome']).'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}


	//PROFISSÃO
	public static function comboProfissoes($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {

		$dis = "";
		$sth = $db->prepare("SELECT id codigo, UPPER(descricao) as nome FROM profissao WHERE ativo=1 $condicao ORDER BY nome ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.$rs['nome'].'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.$rs['nome'].'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//FREQUÊNCIA
	public static function comboFrequencias($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {

		$dis = "";
		$sth = $db->prepare("SELECT id codigo, UPPER(descricao) as nome FROM frequencia WHERE ativo=1 $condicao ORDER BY nome ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.$rs['nome'].'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.$rs['nome'].'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//TIPO PESSOA
	public static function comboTipoPessoa($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {

		$dis = "";
		$sth = $db->prepare("SELECT id codigo, UPPER(descricao) as nome FROM tipo_pessoa WHERE ativo=1 $condicao ORDER BY nome ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.$rs['nome'].'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.$rs['nome'].'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//TURMA
	public static function comboTurma($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {

		$dis = "";
		$sth = $db->prepare("SELECT id codigo, UPPER(nome) as nome FROM turma WHERE ativo=1 $condicao ORDER BY nome ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.$rs['nome'].'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.$rs['nome'].'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

	//TIPO ASSISTENCIAL
	public static function comboTipoAssistencial($valor, $nome_do_select, $iniciar_index_vazio, $db, $condicao, $readonly, $disabled) {

		$dis = "";
		$sth = $db->prepare("SELECT id codigo, descricao nome FROM tipo_assistencial WHERE ativo=1 $condicao ORDER BY descricao ASC;");
		$sth->execute();
		$r1 = $sth->fetchAll();

		if($disabled) {
			$dis = "disabled";
		} else if($readonly) {
			$dis = "readonly";
		}

		$r = '<select id="'.$nome_do_select.'" name="'.$nome_do_select.'"  class="form-control" ' . $dis . '>';
			if($iniciar_index_vazio){
				$r .= '<option value="0" ></option>';
			}

			foreach($r1 as $rs) {
				if ($valor == $rs['codigo']) {
					$r .= '<option value="'.$rs['codigo'].'" selected>'.$rs['nome'].'</option>';
				} else {
					$r .= '<option value="'.$rs['codigo'].'">'.$rs['nome'].'</option>';
				}
			}
		$r .= '</select>';

		return $r;
	}

}


?>