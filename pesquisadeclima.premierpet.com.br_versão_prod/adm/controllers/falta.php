<?php

class Falta extends Controller {

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
			
			$this->view->js = array('falta/js/funcoes');			
			$this->view->singleUser = NULL;
			$this->view->instanceDB = NULL;
			
		}
				
		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('falta/index');	
		}
		
		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('falta/listar');
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
			header('location: ' .URL . 'falta');
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
			header('location: ' .URL . 'falta/edit/' . $id);
		}
		
		public function edit($id) {				
			$this->view->singleUser = $this->model->singleUser($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
		
		public function impressao() {
			
			Session::init();			
						
			$r = $this->model->impressao();	
			$string  = '<html><body style="font-family:Arial; font-size:12px;">';
			
			$string .= '<table border="0" width="100%" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td><h1>Relatório de Faltas</h1></td>';
			$string .= '      <td align="right" valign="middle">De ' . Session::get('impressao_de') . ' atè ' . Session::get('impressao_ate') . '</td>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '</table>';
			
			$string .= '<table border="1" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Nome</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Tipo Pessoa</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Observação</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Turma</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Faltas</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Justificativas</strong></td>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody style="font-size:9px;">';
				foreach($r as $type) {
					$string .=  '<tr>';
					$string .=  '<td>' . $type['nome'] 			. '</td>';
					$string .=  '<td>' . $type['tipo_pessoa'] 	. '</td>';
					$string .=  '<td>' . $type['observacao'] 	. '</td>';
					$string .=  '<td>' . $type['turma']     	. '</td>';
					$string .=  '<td>' . $type['faltas']    	. '</td>';					
					$string .=  '<td>' . $type['justificativa']    	. '</td>';
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';

			
			echo $string;
			
			echo '<script>
					window.onload = function () {
					  window.print();
					  setTimeout(function(){window.close();}, 1);
					}
				  </script>
				  </body></html>';			
		}
		
		public function xhrGetListings() {
			
			$pg = (int)$_POST['pg'];
			$string = '';
			$r 		= $this->model->xhrGetListings($pg);	
			
			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td><strong>Nome</strong></td>';
			$string .= '      <td><strong>Tipo Pessoa</strong></td>';
			$string .= '      <td><strong>Observação</strong></td>';
			$string .= '      <td><strong>Turma</strong></td>';
			$string .= '      <td><strong>Faltas</strong></td>';
			$string .= '      <td><strong>Justificativas</strong></td>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
					$string .=  '<td>' . $type['nome'] 			. '</td>';
					$string .=  '<td>' . $type['tipo_pessoa'] 	. '</td>';
					$string .=  '<td>' . $type['observacao'] 	. '</td>';
					$string .=  '<td>' . $type['turma']     	. '</td>';
					$string .=  '<td>' . $type['faltas']    	. '</td>';					
					$string .=  '<td>' . $type['justificativa']    	. '</td>';
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';
			if(isset($r[0])) {
				$string .=  Func::paginacao((int)$r[0]['total'], LIMITE, $pg, "falta", 'setpag');
			}

			
			echo $string;
		
		}
	
}

?>