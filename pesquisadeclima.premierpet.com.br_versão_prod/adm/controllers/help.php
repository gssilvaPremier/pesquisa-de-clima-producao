<?php

class Help extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->language->write('help/index');
		$this->view->msg = 'Estamos na view do Help';
		$this->view->render('help/index');
	}
	
	public function other($arg = false) {		
		require PASTA_MODELS . '/help_model.php';
		$modal = new Help_Model();
		$this->view->blah = $modal->blah();
	}
	
}


?>