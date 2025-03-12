<?php

class Login extends Controller {
	
	function __construct() {		
		parent::__construct();
		$this->view->js = array('login/js/funcoes');
	}
	
	function index() {		
		$this->view->css = array('login/css/estilo');
		$this->view->render('login/index');
	}
	
	function run() {
		$this->model->run();		
	}	
	
	function verifyCookie() {
		$this->model->verifyCookie();	
	}
	
	
}