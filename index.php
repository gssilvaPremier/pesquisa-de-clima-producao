<?php
ob_start(); 
session_cache_expire(0);
session_start();
date_default_timezone_set('America/Fortaleza');

$encerra = date('2025-11-20 00:00:00');

if(date("Y-m-d H:i:s") >= $encerra){
  echo "<body style='
          display: flex;
          justify-content: center;
          align-items: center;
          text-align: center;
          font-size: 20px;
          font-family: Arial, sans-serif;'>
          A pesquisa foi encerrada em " . date('d/m/Y H:i', strtotime($encerra)) . 'h.<br />Obrigado!
        </body>';
  exit;
}

// if($_GET['p'] == 'sair') {
// 	@session_destroy();
// 	$_SESSION['chave'] == "";
// 	header("Location: ./");
// }

// Verifique se o 'p' no GET é igual a 'sair'
if(isset($_GET['p']) && $_GET['p'] == 'sair') {
  // Destroi a sessão
  session_destroy();
  
  // Limpa a variável de sessão
  $_SESSION['chave'] = "";  // Corrigi o operador de comparação para atribuição

  // Redireciona para a página inicial
  header("Location: ./");
  
  // Finaliza o script após o redirecionamento
  exit();
}

require 'class/banco.class.php';
require 'class/conexao.class.php';
require 'inc/config.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<!-- <meta charset="iso-8859-1"> -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PremieR pet | Pesquisa de Satisfa&ccedil;&atilde;o</title>
<link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpf0cZWJaJ5lWAe6UlwxN4k7Jggxx_959JPw&usqp=CAU" />
<link href="<?php echo URL; ?>css/login.css?v=<?php echo date('h:i:s'); ?>" rel="stylesheet">
<link href="<?php echo URL; ?>css/bootstrap.min.css?v=<?php echo date('h:i:s'); ?>" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

 <!-- Modal -->
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog">
    
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Sucesso</h4>
            </div>
            <div class="modal-body">
              <p>Obrigado, seu formulário foi enviado com sucesso!</p>
              <!--<h2 style="text-align:center;" id="contador">5</h2>-->
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>-->
              <a href="<?php echo URL; ?>sair" class="btn btn-default">Fechar</a>
            </div>
          </div>
    
        </div>
  </div>



<?php include 'inc/controller.php'; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo URL; ?>js/bootstrap.min.js?v=<?php echo date('h:i:s'); ?>"></script>
<script src="<?php echo URL; ?>js/funcoes.js?v=<?php echo date('h:i:s'); ?>"></script>

<script>

  $('body').click(function(){
    $.get('./renovasessao.php', {}, function(r){})
  });

</script>
</body>
</html>

<?php ob_end_flush();  // Envia o buffer de saída
 ; ?>