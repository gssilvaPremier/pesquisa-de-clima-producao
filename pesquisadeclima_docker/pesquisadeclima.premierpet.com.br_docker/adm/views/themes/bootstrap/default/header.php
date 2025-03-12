<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADM | PremieR pet</title>
<link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpf0cZWJaJ5lWAe6UlwxN4k7Jggxx_959JPw&usqp=CAU" />
<base href="<?php echo URL; ?>" />
<link href="<?php echo URL . PASTA_API . '/' . API; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo URL . PASTA_API . '/' . API; ?>/adm/css/style.css" rel="stylesheet">
<link href="<?php echo URL . PASTA_API . '/' . API; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo URL . PASTA_API . '/' . API; ?>/dist/css/AdminLTE.min.css" rel="stylesheet">
<link href="<?php echo URL . PASTA_API . '/' . API; ?>/dist/css/skins/skin-blue.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" >
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<?php

	if(isset($this->css)) {
		
		foreach($this->css as $css) {
			echo '<link href="' . URL .  PASTA_VIEWS . '/themes/' . API .'/' . TEMPLATE . '/' . $css . '.css" rel="stylesheet">';
		}
		
	}

?>
</head>
<body class="hold-transition skin-blue sidebar-mini">