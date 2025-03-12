<?php

class Frequencia extends Controller {


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
			
			$this->view->js = array('frequencia/js/funcoes');
			$this->view->singleFreq = NULL;
			
		}
				
		public function Index() {
			$this->view->freqList = $this->model->freqList();
			$this->view->render('frequencia/index');	
		}
				
		public function create() {
			
			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = (int)$_POST['status'];

			
			$this->model->create($data);
			header('location: ' .URL . 'frequencia');
		}

		public function update($id) {
			
			$data = array();
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = (int)$_POST['status'];
			$data['id'] = $id;
			
			$this->model->update($data);
			header('location: ' .URL . 'frequencia');
		}
		
		public function edit($id) {				
			
			$this->view->singleFreq = $this->model->singleFreq($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
	
}

?>