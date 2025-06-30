<?php

class Pessoa extends Controller {

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
			
			$this->view->js = array('pessoa/js/funcoes');			
			$this->view->singleUser = NULL;
			$this->view->instanceDB = NULL;
			
		}
				
		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('pessoa/index');	
		}
		
		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('pessoa/listar');
		}
				
		public function create() {
			
			$data = array();
			$data['nome'] = Func::removeCaracters($_POST['nome']);			
			$data['cgc'] = $_POST['cgc'];
			$data['endereco'] = Func::removeCaracters($_POST['endereco']);
			$data['cidade'] = Func::removeCaracters($_POST['cidade']);
			$data['estado'] = Func::removeCaracters($_POST['estado']);
			$data['idprofissao'] = (int)$_POST['profissao'];
			$data['idfrequencia'] = (int)$_POST['frequencia'];
			$data['idtipo_pessoa'] = (int)$_POST['tipo_pessoa'];			
			$data['idtipo_assistencial1'] = (int)$_POST['idtipo_assistencial1'];
			$data['idtipo_assistencial2'] = (int)$_POST['idtipo_assistencial2'];
			$data['idtipo_assistencial3'] = (int)$_POST['idtipo_assistencial3'];
			$data['idtipo_assistencial4'] = (int)$_POST['idtipo_assistencial4'];
			$data['idtipo_assistencial5'] = (int)$_POST['idtipo_assistencial5'];
			$data['idtipo_assistencial6'] = (int)$_POST['idtipo_assistencial6'];
			$data['idtipo_assistencial7'] = (int)$_POST['idtipo_assistencial7'];
			$data['idtipo_assistencial8'] = (int)$_POST['idtipo_assistencial8'];
			$data['idtipo_assistencial9'] = (int)$_POST['idtipo_assistencial9'];			
			$data['idturma'] = (int)$_POST['turma'];
			$data['telefone2'] = $_POST['telefone2'];
			$data['telefone'] = $_POST['telefone'];
			$data['email'] = $_POST['email'];
			$data['curso'] = Func::removeCaracters($_POST['curso']);
			$data['trabalho_rua'] = Func::removeCaracters($_POST['trabalho_rua']);
			$data['cesta_basica'] = Func::removeCaracters($_POST['cesta_basica']);
			$data['dia_trabalho'] = Func::removeCaracters($_POST['dia_trabalho']);
			$data['data_inicio'] = $_POST['data_inicio'];
			$data['observacao'] = Func::removeCaracters($_POST['observacao']);
			$data['motivos'] = Func::removeCaracters($_POST['motivos']);
			$data['liberados'] = Func::removeCaracters($_POST['liberados']);			
			
			$this->model->create($data);
			header('location: ' .URL . 'pessoa');
		}
		
		public function update($id) {
			
			$data = array();
			$data['nome'] = Func::removeCaracters($_POST['nome']);			
			$data['cgc'] = $_POST['cgc'];
			$data['endereco'] = Func::removeCaracters($_POST['endereco']);
			$data['cidade'] = Func::removeCaracters($_POST['cidade']);
			$data['estado'] = Func::removeCaracters($_POST['estado']);
			$data['idprofisssao'] = $_POST['profissao'];
			$data['idfrequencia'] = $_POST['frequencia'];
			$data['idtipo_pessoa'] = $_POST['tipo_pessoa'];
			$data['idtipo_assistencial1'] = (int)$_POST['idtipo_assistencial1'];
			$data['idtipo_assistencial2'] = (int)$_POST['idtipo_assistencial2'];
			$data['idtipo_assistencial3'] = (int)$_POST['idtipo_assistencial3'];
			$data['idtipo_assistencial4'] = (int)$_POST['idtipo_assistencial4'];
			$data['idtipo_assistencial5'] = (int)$_POST['idtipo_assistencial5'];
			$data['idtipo_assistencial6'] = (int)$_POST['idtipo_assistencial6'];
			$data['idtipo_assistencial7'] = (int)$_POST['idtipo_assistencial7'];
			$data['idtipo_assistencial8'] = (int)$_POST['idtipo_assistencial8'];
			$data['idtipo_assistencial9'] = (int)$_POST['idtipo_assistencial9'];
			$data['idturma'] = $_POST['turma'];
			$data['telefone2'] = $_POST['telefone2'];
			$data['telefone'] = $_POST['telefone'];
			$data['email'] = $_POST['email'];
			$data['curso'] = Func::removeCaracters($_POST['curso']);
			$data['trabalho_rua'] = Func::removeCaracters($_POST['trabalho_rua']);
			$data['cesta_basica'] = Func::removeCaracters($_POST['cesta_basica']);
			$data['dia_trabalho'] = Func::removeCaracters($_POST['dia_trabalho']);
			$data['data_inicio'] = $_POST['data_inicio'];
			$data['observacao'] = Func::removeCaracters($_POST['observacao']);
			$data['motivos'] = Func::removeCaracters($_POST['motivos']);
			$data['liberados'] = Func::removeCaracters($_POST['liberados']);
			$data['id'] = $id;
			
			$this->model->update($data);
			header('location: ' .URL . 'pessoa/edit/' . $id);
		}
		
		public function edit($id) {				
			$this->view->singleUser = $this->model->singleUser($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
		
		public function xhrGetListings() {
			
			$pg = (int)$_POST['pg'];
			$string = '';
			$r 		= $this->model->xhrGetListings($pg);	
			
			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>ID</th>';
			$string .= '      <th>Nome</th>';
			$string .= '      <th>Profissão</th>';
			$string .= '      <th>Ativo</th>';
			$string .= '      <th class="text-right">Editar</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['id'] 		. '</td>';
						$string .=  '<td>' . utf8_encode($type['nome'])  . '</td>';
						$string .=  '<td>' . utf8_encode($type['profissao'])  . '</td>';
						$string .=  '<td>' . Func::getInativo($type['inativo'])		. '</td>';
						$string .=  '<td align="right"><a class="btn btn-default  btn-xs" href="' . URL . 'pessoa/edit/' . $type['id'] . '"><span class="glyphicon glyphicon-pencil text-info"></span> Editar</a> <a class="btn btn-default  btn-xs" href="' . URL . 'pessoa/delete/' . $type['id'] . '"><span class="glyphicon glyphicon-trash text-danger"></span> Deletar</a> </td>';
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';
			if(isset($r[0])) {
				$string .=  Func::paginacao((int)$r[0]['total'], LIMITE, $pg, "pessoa", 'setpag');
			}

			
			echo $string;
		
		}
	
}

?>