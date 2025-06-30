<?php
	$pg = "";

    //$url = str_replace("https://pesquisadeclima.premierpet.com.br/", "", $_SERVER["REQUEST_URI"]);
   
    $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], '/')+1);
    $url_cod = explode('/', $url);
    
    
	if($_GET['p'] == "gerador" || $url_cod[0] == "gerador" ) {
		include 'php/senha.php';
	} else if($_GET['p'] == "sucesso") {
			echo '<div class="container">
				  <div class="row">
					<div class="col-xs-12 col-md-12 col-lg-12">
					<h1>Sucesso</h1>
					 Muito obrigado, o seu voto foi computado com sucesso! <a href="./sair" class="btn btn-sm btn-success pull-right">Sair</a>
					</div>
				  </div>
				</div>';
	}  else {

		if(strlen($_SESSION['chave']) > 5) {

			$db = new Conexao($banco);
			$rs = $db->sel("SELECT valida FROM chaves WHERE chave= '".trim($_SESSION['chave'])."'; ");

			if(count($rs) > 0) {
				if($rs[0]['valida'] == 0) {

					echo '<div class="container">
						  <div class="row">
						  	<div class="col-xs-12 col-md-12 col-lg-12">
							<h1>Aten&ccedil;&atilde;o</h1>
							 Chave de acesso j&aacute; utilizada, clique em sair para desconectar! <a href="./sair" class="btn btn-sm btn-danger pull-right">Sair</a>
							</div>
						  </div>
						</div>';
					exit;
				}
			}

			if($_SESSION['empresa'] == 1) {

				if($_SESSION['fazenda_setor'] == "0") {
					$pg = 'fazenda_sede';
				} else {
					$pg = 'fazenda';
				}

				//$pg = 'fazenda_2017';

			} else if($_SESSION['empresa'] == 2) {

				if($_SESSION['distribuidor_setor'] == "0") {
					$pg = 'distribuidor_sede';
				} else {
					$pg = 'distribuidor';
				}

			} else if($_SESSION['empresa'] == 3) {

				if($_SESSION['premier_setor'] == "0") {
					$pg = 'premier_sede';
				} else {
					$pg = 'premier';
				}

			} else if($_SESSION['empresa'] == 5) {

				if($_SESSION['granfood_setor'] == "0") {
					$pg = 'granfood_setor';
				} else {
					$pg = 'granfood';
				}

			} else if($_SESSION['empresa'] == 6) {

				if($_SESSION['granfood_setor'] == "0") {
					$pg = 'granfood_setor';
				} else {
					$pg = 'granfood';
				}

				
			} else if($_SESSION['empresa'] == 12) {

				if($_SESSION['progato_setor'] == "0") {
					$pg = 'progato_setor';
				} else {
					$pg = 'progato';
				}

			}else if($_SESSION['empresa'] == 4) {
				$pg = 'brascorp';
			} else {
				$pg = 'login';
			} 

			include 'php/' . $pg . '.php';

		} else {
			include 'php/login.php';
		}
	}