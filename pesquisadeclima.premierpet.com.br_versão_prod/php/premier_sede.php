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
        <h2 class="form-signin-heading">PremieRpet<sup>&reg;</sup></h2>
        <p class="text-warning">Escolha abaixo a localidade na qual trabalha</p>
         <?php
            if(isset($_POST['localidade'])) {
            	if($_POST['localidade'] != "") {            
            	   // echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-info-sign"></span> <strong>Sucesso</strong>, clique em avançar';
                //     echo '<button id="recarregarPagina" class="btn btn-md btn-default pull-right" type="submit" style="margin-top:-7px;"><span class=""></span>Avançar</button>
                //     </div>';
                //     echo '<style>';
                //     echo 'label, select, .btn-acesso { display: none!important; }'; // Oculta os elementos label e select
                //     echo '</style>';
            		$_SESSION['premier_setor'] = $_POST['localidade'];
                 	$_SESSION['premier_setor_um'] = $_POST['setor'];
            		header("Location: ./");            
            	} else {
            		echo '<div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Informe a sua <strong>Localidade</strong> e <strong>Setor</strong></div>';
            	}
            }
            
            ?>
        <label for="setor">Localidade</label>
        <select id="setor" name="setor" class="form-control" required autofocus>
            <option value=""></option>
            <option value="1">Fabrica Dourado</option>
            <option value="2">Cd's Centros de Distribui&ccedil;&atilde;o</option>
            <option value="0">Escrit&oacute;rio SP</option>
            <option value="3">Externos</option>
            <option value="4">Esc. Rondon&oacute;polis</option>
            <option value="5">F&aacute;brica Paran&aacute;</option>
        </select>
        <label for="setor">Setor</label>
        <select id="localidade" name="localidade" class="form-control" required >
            <option value="" disabled> Informe o seu setor</option>
        </select>
        <button class="btn btn-md btn-default pull-right btn-acesso" type="submit" style="margin-top:10px;"><span class="glyphicon glyphicon-ok"></span> Acessar</button>
    </form>
</div>