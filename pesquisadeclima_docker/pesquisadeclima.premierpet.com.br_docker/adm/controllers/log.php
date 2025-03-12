<?php

class Log extends Controller {

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

			$this->view->js = array('log/js/funcoes');
			$this->view->singleProf = NULL;
			$this->view->instanceDB = NULL;

		}

		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('log/listar');
		}


		public function xhrGetListings() {

			$pg = (int)$_POST['pg'];
			$string = '';
			$r 		= $this->model->xhrGetListings($pg);

			if(count($r) < 1){
				$string .= '<div class="alert alert-default text-danger">';
				$string .= '	Nenhum log de alteração localizado para essa empresa';
				$string .= '</div>';
				echo $string;
				exit;
			}

			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>Usuário</th>';
			$string .= '      <th>Empresa</th>';
			$string .= '      <th>Descrição</th>';
			$string .= '      <th class="text-right">Data</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['usuario'] . '</td>';
						$string .=  '<td>' . $type['empresa'] . '</td>';
						$string .=  '<td>' . $type['descricao'] . '</td>';
						$string .=  '<td align="right">' . $type['data']  . '</td>';
					$string .=  '</tr>';
				}
			$string .= '</tbody>';
			$string .= '</table>';
			if(isset($r[0])) {
				$string .=  Func::paginacao((int)$r[0]['total'], LIMITE, $pg, "chave", 'setpag');
			}


			echo $string;

		}

		public function Index() {
			// NÃO IMPLEMENTADO
		}
}