<?php

class Apuracao extends Controller {

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

			$this->view->js = array('apuracao/js/funcoes');
			$this->view->instanceDB = NULL;

		}

		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('apuracao/index');
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

			$r 		= $this->model->xhrGetListingsSetorPremier();

			$string .= '<h2>Setores Premier</h2>';

			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>Localidade</th>';
			$string .= '      <th>Setor</th>';
			$string .= '      <th>Quantidade de votos</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['localidade'] 		. '</td>';
						$string .=  '<td>' . utf8_encode($type['setor'])  . '</td>';
						$string .=  '<td>' . $type['qtd_votos']  . '</td>';
					$string .=  '</tr>';
				}
			$string .= '</tbody>';
			$string .= '</table>';


			echo $string;

		}
}