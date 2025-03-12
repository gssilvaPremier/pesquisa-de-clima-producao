<nav class="navbar navbar-default" style="margin-top: -40px;">
  <div class="container" style="margin-top:30px; margin-bottom:10px; line-height:20px;">
    <div class="row">
      <div class="col-xs-12 col-md-8 col-lg-8">
      		<h4>A pesquisa de clima organizacional &eacute; uma ferramenta para an&aacute;lise do ambiente da empresa</h4>
            <p class="small">Ela possibilita identificar pontos de melhorias no modelo de gest&atilde;o, permitindo a an&aacute;lise da satisfa&ccedil;&atilde;o e da motiva&ccedil;&atilde;o dos nossos colaboradores.<br />
                O preenchimento &eacute; individual e confidencial. O Colaborador n&atilde;o ser&aacute; identificado.<br />
                Queremos ouvir voc&ecirc;, a sua opini&atilde;o &eacute; muito importante para a empresa</p>
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4">
      		<img src="<?php echo URL; ?>img/logo_clima.png" class="img-responsive pull-right" style="max-height:150px;" />
      </div>
    </div>
  </div>
  </nav>
  <div class="container">
  <form action="" class="form-signin" method="post">
    <h2 class="form-signin-heading">Gera&ccedil;&atilde;o de Chaves</h2>
    <p class="text-warning">Clique abaixo para gerar uma chave</p>
    <?php
    
    $url = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], '/')+1);
    $url_cod = explode('/', $url);

	if(isset($_POST['email'])) {
	  
		if(strlen($_POST['email']) > 2) {
		  
			$db = new Conexao($banco);
			$rs = $db->sel("SELECT
								c.idempresa, c.chave
								FROM chaves c
								INNER JOIN ref_email_chave ref ON ref.idchaves=c.id
								INNER JOIN emails e ON e.id=ref.idemails
								WHERE e.email = '".trim($_POST['email'])."';");
			$db = NULL;
			//WHERE MD5(e.id || '_' || e.email)='".trim($_POST['email'])."';");
		

			if(count($rs) > 0) {
				$_SESSION['chave'] = $rs[0]['chave'];
				$_SESSION['empresa'] = $rs[0]['idempresa'];
				$chave = $rs[0]['chave'];

				//ZERO AS VARIAVEIS DE ESCOLHA
				$_SESSION['fazenda_setor'] = "0";
				$_SESSION['distribuidor_setor'] = "0";
				$_SESSION['premier_setor'] = "0";
				$_SESSION['progato_setor'] = "0";


				echo '<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Chave de Acesso</strong> gerada com sucesso<br /><br />
				Copie e guarde o seu c&oacute;digo ou clique <a href="../">aqui</a> para preencher o formul&aacute;rio.
				</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Erro ao gerar a <strong>Chave de Acesso</strong></div>';
			}



		} else {
			echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Erro ao gerar a <strong>Chave de Acesso</strong></div>';
		}
	}
	?>
    <label for="cnpj" class="sr-only">CHAVE</label>
    <input type="hidden" name="email" id="email" value="<?php echo  $url_cod[1]; ?>" />
    <input type="text" id="chave_acesso" name="chave_acesso" class="form-control" placeholder="" value="<?php echo $chave; ?>" required autofocus readonly>
    <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:10px;"><span class="glyphicon glyphicon-ok"></span> Gerar minha chave</button>
  </form>
</div>