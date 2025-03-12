<?php

class User extends Controller {


		function __construct() {
			parent::__construct();	
			Session::init();
			$logged = Session::get('loggedIn');
			$role   = Session::get('nivel');
			if($logged == false || $role != 0) {
				Session::onDestroy();
				header('location: ' .URL . 'login');
				exit;
			}
			
			$this->view->js = array('user/js/funcoes');			
			$this->view->singleUser = NULL;
			
			
		}		
				
		public function Index() {
			$this->view->userList = $this->model->userList();
			$this->view->render('user/index');	
		}
				
		public function create() {
						
			$data = array();
			$data['login'] = $_POST['login'];
			$data['password'] = md5($_POST['password'] . TOKEN);
			$data['nivel'] = $_POST['nivel'];
			
			$this->model->create($data);
			header('location: ' .URL . 'user');
		}
		
		public function update($id) {
			
			$data = array();
			$data['login'] = $_POST['login'];
			$data['password'] = md5($_POST['password'] . TOKEN);
			$data['nivel'] = $_POST['nivel'];
			$data['id'] = $id;
			
			$this->model->update($data);
			header('location: ' .URL . 'user');
		}
		
		public function edit($id) {				
			$this->view->singleUser = $this->model->singleUser($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
	
}

?>