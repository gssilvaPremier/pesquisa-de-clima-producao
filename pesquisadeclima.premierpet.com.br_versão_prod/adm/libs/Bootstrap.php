<?php

class Bootstrap {
	
	function __construct() {

		if(isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
		} else {
			$url = PAGINA_INICIAL;
		}		
		
		$url = explode('/', $url);		
		
		$file = PASTA_CONTROLLER . '/' . $url[0] . '.php';
		
		if(file_exists($file)) {
			require $file;
		} else {
			require PASTA_CONTROLLER . '/error.php';
			$controller = new Error();
			$controller->Index();
			return false;
		}
		
		$controller = new $url[0];
		$controller->loadModel($url[0]);

		if(isset($url[2])) {
			if(method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			} else {
				echo 'Methodo nao existe';				
			}
		} else {
			if(isset($url[1])) {
				if(method_exists($controller, $url[1])) {
					$controller->{$url[1]}();
				} else {
					echo 'Methodo nao existe';	
				}
			} else {
				$controller->Index();
			}
		}
		
	}
	
}