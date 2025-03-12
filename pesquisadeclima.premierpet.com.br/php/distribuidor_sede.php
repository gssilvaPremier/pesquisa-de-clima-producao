<nav class="navbar navbar-default" style="margin-top: -40px;">
    <div class="container" style="margin-top:5px; margin-bottom:10px; line-height:20px;">
    <div class="row">
      <div class="col-xs-12 col-md-8 col-lg-8">
      		<img src="<?php echo URL; ?>img/logo_premier.png" class="img-responsive pull-left" style="max-height:50px; margin-top:25px;" />
      </div>
      <div class="col-xs-12 col-md-4 col-lg-4">
      		<img src="<?php echo URL; ?>img/logo_clima.png" class="img-responsive pull-right" style="max-height:80px; margin-top:10px;" />
      </div>
    </div>
  </div>
</nav>
<div class="container">
  <form action="" class="form-signin" method="post">
    <h2 class="form-signin-heading">Distribuidor</h2>
    <p class="text-warning">Escolha abaixo a distribuidora no qual trabalha</p>
    <?php

	if(isset($_POST['setor'])) {
		if($_POST['setor'] != "0") {
            // echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Sucesso</strong>, clique em avançar';
            // echo '<button id="recarregarPagina" class="btn btn-md btn-default pull-right" type="submit" style="margin-top:-7px;"><span class=""></span>Avançar</button>
            // </div>';
            // echo '<style>';
            // echo '#setor, .button_none { display: none!important; }'; // Oculta os elementos label e select
            // echo '</style>';
			$_SESSION['distribuidor_setor'] = $_POST['setor'];
			header("Location: ./");

		} else {
			echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Informe uma <strong>Distribuidora</strong></div>';
		}
	}


	$db = new Conexao($banco);
	$rs = $db->sel("SELECT * FROM distribuidor_setor ORDER BY nome ASC;");
	$db = NULL;


	?>
    <label for="cnpj" class="sr-only">Eu sou da</label>
    <select id="setor" name="setor" class="form-control" required autofocus>
            <option value="0"></option>
            <?php foreach($rs as $value) { ?>
            	<option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
            <?php } ?>
    </select>
    <button class="btn btn-md btn-default pull-right button_none" type="submit" style="margin-top:10px;"><span class="glyphicon glyphicon-ok"></span> Acessar</button>
  </form>
</div>