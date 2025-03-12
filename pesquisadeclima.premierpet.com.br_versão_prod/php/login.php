<nav class="navbar navbar-default" style="margin-top: -40px;">
  <div class="container" style="margin-top:30px; margin-bottom:10px; line-height:20px;">
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12 text-center">
      		<img src="<?php echo URL; ?>img/logo_clima.png" class="img-responsive" style="max-height:100px; margin: 0 auto; margin-bottom: 30px;" />
      		<h4>A sua opini&atilde;o &eacute; muito importante para a PremieRpet<sup>&reg;</sup>!</h4>
            <p class="small">Por isso te convidamos a participar desta Pesquisa de Clima da empresa.<br />
                As informa&ccedil;&otilde;es coletadas servir&atilde;o para medir a satisfa&ccedil;&atilde;o geral e identificar poss&iacute;veis pontos de melhorias.</p>
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4" style="display: none;">
      		<img src="<?php echo URL; ?>img/logo_clima.png" class="img-responsive pull-right" style="max-height:150px;" />
      </div>
    </div>
  </div>
</nav>


<?php
date_default_timezone_set('America/Fortaleza');
if(1==2){
if(date("Y-m-d") > date("2019-11-22")) { ?>

	<div class="container text-center">
	  <div class="row">
	    <div class="col-xs-12 col-md-12 col-lg-12"> </div>
	  </div>
	  	<h1 class="form-signin-heading text-primary">Pesquisa Encerrada</h1>
	    <h2 class="text-warning">A pesquisa da PremieRpet<sup>&reg;</sup> encerrou!</h2>
	</div>

<?php

	exit;
	}
}
?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12"> </div>
  </div>
  <form action="" class="form-signin" method="post">
  <h2 class="form-signin-heading">Informe sua chave</h2>
    <p class="text-warning">Para preencher o formul&aacute;rio informe sua chave e clique em validar</p>
    <?php

	if(isset($_POST['chave_acesso'])) { 
		if(strlen($_POST['chave_acesso']) > 5) {
		    

			$db = new Conexao($banco);
			
			$rs = $db->sel("SELECT idempresa, valida FROM chaves WHERE chave= '".trim($_POST['chave_acesso'])."';");
				
			$db = NULL;
			
		

			if(count($rs) > 0) {

				if($rs[0]['valida'] == 0) {
					echo '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Chave de Acesso</strong> j&aacute; utilizada</div>';
				} else {
				// 	echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Sucesso</strong>, clique em avançar';
				// 	echo '<button id="recarregarPagina" class="btn btn-md btn-default pull-right" type="submit" style="margin-top: -6px;"><span class=""></span>Avançar</button>
    //                 </div>';
				// 	echo '<style>';
    //                 echo 'input, .chave_acesso, .btn-block { display: none!important; }'; // Oculta os elementos label e select
    //                 echo '</style>';
					$_SESSION['chave'] = trim($_POST['chave_acesso']);
					$_SESSION['empresa'] = $rs[0]['idempresa'];

					//ZERO AS VARIAVEIS DE ESCOLHA
					$_SESSION['fazenda_setor'] = "0";
					$_SESSION['distribuidor_setor'] = "0";
					$_SESSION['premier_setor'] = "0";
					$_SESSION['granfood_setor'] = "0";
					$_SESSION['progato_setor'] = "0";


					header("Location: ./");
				}


			} else {
				echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Chave de Acesso</strong> n&atilde;o encontrada em nosso sistema</div>';
			}

		} else {
			echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Informe uma <strong>Chave de Acesso</strong> v&aacute;lida</div>';
		}
	}
	?>
    <label for="cnpj" class="sr-only">CHAVE</label>
    <input type="text" id="chave_acesso" name="chave_acesso" class="form-control" placeholder="Informe aqui sua chave" required autofocus>
    <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:10px;"><span class="glyphicon glyphicon-ok"></span> Validar</button>
  </form>
</div>
