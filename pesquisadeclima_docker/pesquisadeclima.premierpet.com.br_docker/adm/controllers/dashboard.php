<?php

class Dashboard extends Controller {

	function __construct() {
		parent::__construct();

		Session::init();
		$logged = Session::get('loggedIn');
		if($logged == false) {
			Session::onDestroy();
			header('location: ' . URL . 'login');
			exit;
		}

		$this->view->js = array('dashboard/js/funcoes');
		$this->view->instanceDB = NULL;
	}

	function Index() {
		$this->view->instanceDB = $this->model->instanceDB();
		$this->view->render('dashboard/index');
	}


	function logout() {
		Session::init();
		Session::onDestroy();
		if(COOKIE) {
			Cookie::onUnset('senha', COOKIE_PATH);
		}
		header('location: ' .URL . 'login');
		exit;
	}


	function xhrInsert() {
		$this->model->xhrInsert();
	}

	function xhrGetListings() {
		$this->model->xhrGetListings();
	}

	function xhrDeleteListing(){
		$this->model->xhrDeleteListing();
	}

}


?>