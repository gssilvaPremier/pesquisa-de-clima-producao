<?php

class Error extends Controller {
	
	function __construct() {
		parent::__construct();		
	}
	
	function index() {
		$this->view->msg = 'Esta pagina n�o existe';
		$this->view->render('error/index');
	}
	
}

?>