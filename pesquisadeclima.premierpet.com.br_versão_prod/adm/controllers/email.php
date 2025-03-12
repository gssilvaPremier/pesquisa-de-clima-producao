<?php

class Email extends Controller {

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

			$this->view->js = array('email/js/funcoes');
			$this->view->instanceDB = NULL;

		}

		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('email/index');
		}

		public function reenviar() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('email/reenviar');
		}

		public function envia(){

			$quantidade = intval(str_replace('-', '',$_POST['qtd']));

			if($quantidade < 1){
				echo "Informe na quantidade no mínimo 1";
				return;
			}

			if($quantidade > 50){
				echo "Informe na quantidade no máximo 50";
				return;
			}

			$this->model->envia($quantidade);

		}

		public function xhrGetListings() {

			$string = '';
			$r 		= $this->model->xhrGetListings();

			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>Empresa</th>';
			$string .= '      <th>Quantidade de votos</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['nome'] 		. '</td>';
						$string .=  '<td>' . $type['votos']  . '</td>';
					$string .=  '</tr>';
				}
			$string .= '</tbody>';
			$string .= '</table>';

			echo $string;

		}
}