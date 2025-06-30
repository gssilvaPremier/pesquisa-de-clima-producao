<?php

class Profissao extends Controller {


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
			
			$this->view->js = array('profissao/js/funcoes');
			$this->view->singleProf = NULL;
			
		}
				
		public function Index() {
			$this->view->profissaoList = $this->model->profissaoList();
			$this->view->render('profissao/index');	
		}
				
		public function create() {

			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = $_POST['ativo'];
			
			$this->model->create($data);
			header('location: ' .URL . 'profissao');
		}
		
		public function update($id) {
			
			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['ativo'] = $_POST['ativo'];
			$data['id'] = $id;

			$this->model->update($data);
			header('location: ' .URL . 'profissao');
		}
		
		public function edit($id) {				
			$this->view->singleProf = $this->model->singleProf($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
	
}

?>