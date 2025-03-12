<?php

class Controller {
	
	function __construct() {
		$this->view = new View();				
	}
	
	public function loadModel($name) {
		
		$path = PASTA_MODELS . '/' . $name . '_model.php';		
		if(file_exists($path)) {
			require $path;
			$modalName = $name . '_Model';
			$this->model = new $modalName();			
		}		
	}	
}