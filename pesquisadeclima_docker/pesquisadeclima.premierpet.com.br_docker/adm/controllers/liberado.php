<?php

class Liberado extends Controller {

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
			
			$this->view->js = array('liberado/js/funcoes');			
			$this->view->singleUser = NULL;
			$this->view->instanceDB = NULL;
			
		}
				
		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('liberado/index');	
		}
		
		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('liberado/listar');
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}	
		
		public function impressao() {
						
			$r = $this->model->impressao();	
			$string  = '<html><body style="font-family:Arial; font-size:12px;">';
			
			$string .= '<table border="0" width="100%" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td><h1>Liberados Trabalho Assistencial</h1></td>';
			$string .= '      <td align="right" valign="middle">De ' . Session::get('impressao_de') . ' atè ' . Session::get('impressao_ate') . '</td>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '</table>';
			
			
			$string .= '<table border="1" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td><strong>Nome</strong></td>';
			$string .= '      <td><strong>Tipo Pessoa</strong></td>';
			$string .= '      <td><strong>Data Inicio</strong></td>';
			$string .= '      <td><strong>Liberado</strong></td>';
			$string .= '      <td><strong>Motivo</strong></td>';
			$string .= '      <td><strong>Celular</strong></td>';
			$string .= '      <td><strong>Email</strong></td>';			
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
					$string .=  '<td>' . $type['nome'] 			. '</td>';
					$string .=  '<td>' . $type['tipo_pessoa'] 	. '</td>';
					$string .=  '<td>' . $type['data_inicio'] 	. '</td>';
					$string .=  '<td>' . $type['liberados']     . '</td>';
					$string .=  '<td>' . $type['motivos']    	. '</td>';					
					$string .=  '<td>' . $type['celular']    	. '</td>';
					$string .=  '<td>' . $type['email']    	    . '</td>';					
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
			$string .= '      <td><strong>Data Inicio</strong></td>';
			$string .= '      <td><strong>Liberado</strong></td>';
			$string .= '      <td><strong>Motivo</strong></td>';
			$string .= '      <td><strong>Celular</strong></td>';
			$string .= '      <td><strong>Email</strong></td>';			
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
					$string .=  '<td>' . $type['nome'] 			. '</td>';
					$string .=  '<td>' . $type['tipo_pessoa'] 	. '</td>';
					$string .=  '<td>' . $type['data_inicio'] 	. '</td>';
					$string .=  '<td>' . $type['liberados']     . '</td>';
					$string .=  '<td>' . $type['motivos']    	. '</td>';					
					$string .=  '<td>' . $type['celular']    	. '</td>';
					$string .=  '<td>' . $type['email']    	    . '</td>';					
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';
			if(isset($r[0])) {
				$string .=  Func::paginacao((int)$r[0]['total'], LIMITE, $pg, "liberado", 'setpag');
			}

			
			echo $string;
		
		}
	
}

?>