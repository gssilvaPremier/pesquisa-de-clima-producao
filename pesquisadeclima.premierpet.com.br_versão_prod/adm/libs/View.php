<?php

class View {
	
	function __construct() {}
	
	function render($name, $noInclude = false) {
		
		if($noInclude == true) {
			require PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/' . $name . '.php';			
		} else {
			require PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/header.php';
			if(isset($_SESSION)) {
				Session::init();
				$logado = Session::get('loggedIn');
			} else {
				$logado = false;	
			}
			if($logado == true) {	
				require PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/menu.php';
			}
			require PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/' . $name . '.php';
			require PASTA_VIEWS . '/themes/' . API . '/' . TEMPLATE . '/footer.php';			
		}
			
		
	}
	
}

?>