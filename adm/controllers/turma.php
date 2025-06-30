<?php

class Turma extends Controller {


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
			
			$this->view->js = array('turma/js/funcoes');
			$this->view->singleTurma = NULL;
			$this->view->instanceDB = NULL;
			
		}
				
		public function Index() {
			$this->view->turmaList = $this->model->turmaList();
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('turma/index');	
		}
				
		public function create() {

			$data = array();
			$data['nome'] = Func::removeCaracters($_POST['nome']);
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = $_POST['status'];
			$data['responsavel'] = $_POST['responsavel'];
			$data['idtipo_assistencial'] = $_POST['idtipo_assistencial'];
			$data['idfrequencia'] = $_POST['idfrequencia'];
			
			$this->model->create($data);
			header('location: ' .URL . 'turma');
		}
		
		public function update($id) {
			
			$data = array();
			$data['nome'] = Func::removeCaracters($_POST['nome']);
			$data['descricao'] = Func::removeCaracters($_POST['descricao']);
			$data['status'] = $_POST['status'];
			$data['responsavel'] = $_POST['responsavel'];
			$data['idtipo_assistencial'] = $_POST['idtipo_assistencial'];
			$data['idfrequencia'] = $_POST['idfrequencia'];
			$data['id'] = $id;
			
			$this->model->update($data);
			header('location: ' .URL . 'turma');
		}
		
		public function edit($id) {				
			$this->view->singleTurma = $this->model->singleTurma($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
		
		public function xhrGetListings() {
			$string = '';
			$r 		= $this->model->xhrGetListings();	
			
			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>ID</th>';
			$string .= '      <th>Nome</th>';
			$string .= '      <th>Tipo</th>';
			$string .= '      <th>Descrição</th>';
			$string .= '      <th>Frequência</th>';
			$string .= '      <th>Status</th>';
			$string .= '      <th>Responsavél</th>';
			$string .= '      <th class="text-right">Editar</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['id'] 		. '</td>';
						$string .=  '<td>' . $type['nome']  . '</td>';
						$string .=  '<td>' . $type['tipo']  . '</td>';
						$string .=  '<td>' . $type['descricao'] 	. '</td>';
						$string .=  '<td>' . $type['frequencia']  . '</td>';
						$string .=  '<td>' . Func::getAtivo($type['ativo'])	. '</td>';
						$string .=  '<td>' . $type['responsavel']		. '</td>';
						$string .=  '<td align="right"><a class="btn btn-default  btn-xs" href="' . URL . 'turma/edit/' . $type['id'] . '"><span class="glyphicon glyphicon-pencil text-info"></span> Editar</a> <a class="btn btn-default  btn-xs" href="' . URL . 'turma/delete/' . $type['id'] . '"><span class="glyphicon glyphicon-trash text-danger"></span> Deletar</a> </td>';
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';
			$string .=  Func::paginacao($r[0]['total'], LIMITE, (int)$_POST['pg'], "turma", 'setpag');

			
			echo $string;
		
		}
		
		public function xhrGetList() {
			
			$p = array();			
			$r = $this->model->xhrGetList();		
			
			foreach($r as $type) {
				$p[] = array(
					'id'	=> $type['id'],
					'nome'	=> $type['nome'],
					'descricao'	=> $type['descricao']				
				);
			}
			
			echo( json_encode( $p ) );	
		}
		
		public function xhrGetListAssistencial() {
			
			$p = array();			
			$r = $this->model->xhrGetListAssistencial();		
			
			foreach($r as $type) {
				$p[] = array(
					'id'	=> $type['id'],
					'nome'	=> $type['nome']				
				);
			}
			
			echo( json_encode( $p ) );	
		}
	
}

?>