<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

date_default_timezone_set('America/Fortaleza');

// $encerra = date('2024-12-18 08:00:00');

// if(date("Y-m-d H:i:s") >= $encerra){
//   echo "A pesquisa foi encerrada em " . date('d/m/Y H:i', strtotime($encerra)) . "\nObrigado!";
//   exit;
// }

require 'config/App.php';
App::ini();
$app = new Bootstrap();