<?php

class Tipo_pessoa extends Controller {


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
			
			$this->view->js = array('tipo_pessoa/js/funcoes');
			$this->view->singleType = NULL;
			
		}
				
		public function Index() {
			$this->view->tipoList = $this->model->tipoList();
			$this->view->render('tipo_pessoa/index');	
		}
				
		public function create() {

			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = $_POST['status'];
			
			$this->model->create($data);
			header('location: ' .URL . 'tipo_pessoa');
		}
		
		public function update($id) {
			
			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = $_POST['status'];
			$data['id'] = $id;
			
			$this->model->update($data);
			header('location: ' .URL . 'tipo_pessoa');
		}
		
		public function edit($id) {				
			$this->view->singleType = $this->model->singleType($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
	
}

?>