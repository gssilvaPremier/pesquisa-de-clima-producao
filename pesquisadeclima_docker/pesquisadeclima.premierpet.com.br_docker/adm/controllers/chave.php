<?php

class Chave extends Controller {

		public $myempresa = -1;

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

			$this->view->js = array('chave/js/funcoes');
			$this->view->singleProf = NULL;
			$this->view->instanceDB = NULL;

		}

		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('chave/listar');
		}

		public function emails(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('chave/emails');
		}

		public function relatorio($empresa){
			$this->view->instanceDB = $this->model->instanceDB();
			if($empresa == 1) {
				$this->view->render('chave/relatorio_fazenda');
			} else if($empresa == 2) {
				$this->view->render('chave/relatorio_distribuidor');
			} else if($empresa == 3) {
				$this->view->render('chave/relatorio_premier');
			} else if($empresa == 4) {
				$this->view->render('chave/relatorio_brascorp');
			} else if($empresa == 12) {
				$this->view->render('chave/relatorio_progato');
			} else {
				exit;
			}
		}

		public function exportar($empresa){

			$this->myempresa = $empresa;

			$this->view->instanceDB = $this->model->instanceDB();
			if($empresa == -1) {
				$this->view->render('chave/exportar_padrao');
			} else if($empresa == 1) {
				$this->view->render('chave/exportar_premier_dourado');
			} else if($empresa == 2) {
				$this->view->render('chave/exportar_distribuidor');
			} else if($empresa == 3) {
				$this->view->render('chave/exportar_premier');
			} else if($empresa == 4) {
				$this->view->render('chave/exportar_brascorp');
			} else if($empresa == 5) {
				$this->view->render('chave/exportar_granfood');
			} else if($empresa == 6) {
				$this->view->render('chave/exportar_premier_escritorio');
			} else if($empresa == 7) {
				$this->view->render('chave/exportar_premier_cd_externos');
			} else if($empresa == 8) {
				$this->view->render('chave/exportar_premier_fabrica');
			} else if($empresa == 9) {
				$this->view->render('chave/exportar_premier_escrondonopolis');
			} else if($empresa == 10) {
				$this->view->render('chave/exportar_premier_externos');
			} else if($empresa == 11) {
				$this->view->render('chave/exportar_premier_fabrica_parana');
			} else if($empresa == 12) {
				$this->view->render('chave/exportar_progato');
			}else {
				exit;
			}
		}


		public function impressao() {

			Session::init();

			$r = $this->model->impressao();
			$string   = '<html>';
			$string  .= ' <style>';
			$string  .= ' @page  ';
			$string  .= ' { ';
			$string  .= ' 	margin: 0 0;  ';
			$string  .= ' } ';
			$string  .= ' @media print {';
			$string  .= ' html, body {';
			$string  .= ' 	margin: 0 0;  ';
			$string  .= ' 	font-family: Tahoma;';
			$string  .= ' 	font-size: 3em;';
			$string  .= ' 	width: 100%;';
			$string  .= ' 	height: 100%;';
			$string  .= ' }';
			$string  .= ' table { page-break-inside:auto } ';
			$string  .= ' tr    { page-break-inside:avoid; page-break-after:auto } ';
			$string  .= ' thead { display:table-header-group } ';
			$string  .= ' tfoot { display:table-footer-group } ';
			$string  .= ' table {';
			$string  .= '  width:100%;';
			$string  .= ' }';
			$string  .= ' td {';
			$string  .= ' 	width: 33%;';
			$string  .= ' 	height: 98px;';
			$string  .= ' }';
			$string  .= ' }';
			$string  .= ' </style>';
			$string  .= ' <body>';

			//$string .= '<table border="0" width="100%" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			//$string .= '<thead>';
			//$string .= '    <tr>';
			//$string .= '      <td><h5>Chaves</h5></td>';
			//$string .= '      <td align="right"><h6>Impresso em ' . date("d/m/Y H:i:s") . '</h6></td>';
			//$string .= '    </tr>';
			//$string .= '  </thead>';
			//$string .= '</table>';

			$string .= '<table border="1" cellpadding="6" cellspacing="0" class="table  table-striped table-hover">';

			/*			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Empresa</strong></td>';
			$string .= '      <td bgcolor="#EBEBEB"><strong>Chave</strong></td>';
			$string .= '    </tr>';
			$string .= '  </thead>'; */

			$string .= '  <tbody>';

				$i = 0;
				foreach($r as $type) {

					if(($i%2) == 0) {
						$string .=  '<tr>';
					}

					$string .=  '<td><b>Acesse o endereço:</b><br />http://'.$_SERVER['SERVER_NAME'].URL_EMAIL . ' <br />Utilize a chave: <strong><i>' . $type['chave']   	. '</i></strong></td>';

					$i++;

					if(($i%2) == 0) {
						$string .=  '</tr>';
					}

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

		function importaemailsgrava (){

			$r = $this->model->importaemailsgrava();
			echo $r;

		}

		function importaemails(){

			Session::init();
			Session::set("EMAILS_CSV_QUERY", "");
			$data = explode(',', $_POST['base64']);
			$content = base64_decode($data[1]);			
			$emails = explode("\n", $content);
			$query = "";
			$retorno = array();

			foreach ($emails as $key => $value) {

				$value = str_replace('"', "",strtolower(strtoupper(trim($value))));
				
				if(Func::validaEmail($value)){
					
					$r = $this->model->emailExists($value, intval($_POST['idempresa']));

					if($r){ //E-MAIL JÁ CADASTRADO
						array_push(
									$retorno,
									array(
											"email" => $value,
											"cor" => "text-info",
											"mensagem" => "E-mail ja cadastrado para esta empresa."
										)
								);
					} else { //E-MAIL NÃO CADASTRADO
						$query  .= "INSERT INTO emails(idempresa, email) VALUES (".intval($_POST['idempresa']).", '".$value."'); ";

						array_push(
									$retorno,
									array(
											"email" => $value,
											"cor" => "text-success",
											"mensagem" => "E-mail sera inserido."
										)
								);
					}

				} else { //E-MAIL INVÁLIDO
					array_push(
									$retorno,
									array(
											"email" => $value,
											"cor" => "text-danger",
											"mensagem" => "E-mail invalido."
										)
								);
				}

			}

			Session::set("EMAILS_CSV_QUERY", $query);
			echo json_encode($retorno);
		}

		function excluirEmail(){
			$r = $this->model->excluirEmail();
			echo $r;
		}

		function gravamail (){
			$r = $this->model->gravamail();
			echo $r;
		}

		public function xhrGetListingsEmails() {

			$pg = (int)$_POST['pg'];
			$string = '';
			$r 		= $this->model->xhrGetListingsEmails($pg);

			if(count($r) < 1){
				$string .= '<div class="alert alert-default text-danger">';
				$string .= '	Nenhum e-mail localizado para essa empresa';
				$string .= '</div>';
				echo $string;
				exit;
			}			

			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>Empresa</th>';
			$string .= '      <th>E-mail</th>';
			$string .= '      <th>Situação</th>';
			$string .= '      <th class="text-right">Ações</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';					
						$string .=  '<td>' . $type['nome'] 	 . '</td>';
						$string .=  '<td>' . $type['email']  . '</td>';
						$string .=  '<td>' . $type['status']  . '</td>';
						$string .=  '<td class="text-right">';

						if(intval($type['reenviar']) != 2){ //CHAVE NÃO UTILIZADA
							if(intval($type['reenviar']) == 1){
								$string .=  '	<button class="btn btn-default btn-sm" onClick="reenviarEmail(\'' . $type['email'] . '\');"><i class="fa fa-mail-forward"></i></button>';
							}

							$string .=  '	<button class="btn btn-danger btn-sm" onClick="deleteEmail(\'' . $type['email'] . '\');"><i class="fa fa-trash"></i></button>
											
							<button class="btn btn-primary btn-sm"  onClick="editEmail(' . $type['id'] . ', \'' . $type['email'] . '\');"><i class="fa fa-pencil"></i></button>';

						}

						$string .='  </td>';					
						$string .=  '</tr>';
				}
			$string .= '</tbody>';
			$string .= '</table>';
			if(isset($r[0])) {
				$string .=  Func::paginacao((int)$r[0]['total'], LIMITE, $pg, "chave", 'setpag');
			}


			echo $string;

		}

		public function xhrGetListings() {

			$pg = (int)$_POST['pg'];
			$string = '';
			$r 		= $this->model->xhrGetListings($pg);

			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <th>Empresa</th>';
			$string .= '      <th>Chave</th>';
			$string .= '      <th class="text-right">Data</th>';
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';
						$string .=  '<td>' . $type['empresa'] 		. '</td>';
						$string .=  '<td>' . $type['chave']  . '</td>';
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

		public function xhrGetLotes() {

			$p = array();
			$r = $this->model->xhrGetLotes();

			foreach($r as $type) {
				$p[] = array(
					'codigo' => $type['codigo'],
					'nome'	 => utf8_encode($type['nome'])
				);
			}

			echo( json_encode( $p ) );
		}

		public function xhrGetList() {

			$p = array();
			$r = $this->model->xhrGetList();

			foreach($r as $type) {
				$p[] = array(
					'codigo' => $type['codigo'],
					'nome'	 => utf8_encode($type['nome'])
				);
			}

			echo( json_encode( $p ) );
		}

		public function xhrGetListingsRelatorios() {

			$retorno  		= '';
			$empresa 		= (int)$_POST['empresa'];
			$setor   		= @(int)$_POST['setor'];
			$setor_premier  = @(int)$_POST['setor_premier'];
			$progato_setor  = @(int)$_POST['progato_setor'];
			$r 		 		= @$this->model->xhrGetListingsRelatorios($empresa);
			$data    		= array();

			foreach($r as $type) {
				$data[$type['campo']][1] = $type['voto1'];
				$data[$type['campo']][2] = $type['voto2'];
				$data[$type['campo']][3] = $type['voto3'];
				$data[$type['campo']][4] = $type['voto4'];
				$data[$type['campo']][5] = $type['voto5'];
			}

			if($empresa == 1) { //FAZENDA
				$retorno = @$this->renderizapesquisafazenda($data, $setor);
			} else if($empresa == 2) { //DISTRIBUIDOR
				$retorno = @$this->renderizapesquisadistribuidora($data);
			} else if($empresa == 3) { //PREMIER
				$retorno = @$this->renderizapesquisapremier($data, $setor_premier);
			} else if($empresa == 4) { //BRASCORP
				$retorno = @$this->renderizapesquisabrascorp($data);
			} else if($empresa == 12) { //PROGATO
				$retorno = @$this->renderizapesquisaprogato($data, $progato_setor);
			}
			

			echo $retorno;

		}

		public function xhrGetListingsExcel() {

			$retorno  		= '';
			$empresa 		= (int)$_POST['empresa'];
			$r 		 		= @$this->model->xhrGetListingsExcel($empresa);
			@session_start();
			$iduser = intval($_SESSION['idUsuario']);
			if($empresa == -1 && $iduser == 1) { //PADRÃO CENSO 2021 SOMENTE PARA ADMINISTRAÇÃO
				$retorno = @$this->renderizaexcelpadrao($r); //AQUI FOI FEITO JÁ PARA BRASCORP
			} else if($empresa == 1) { //GF AGRICULTURA
				$retorno = @$this->renderizaexcelpremierdourado($r); //AQUI FOI FEITO JÁ PARA BRASCORP
			} else if($empresa == 2) { //DISTRIBUIDOR
				$retorno = @$this->renderizaexceldistribuidora($r); //AQUI FOI FEITO JÁ PARA BRASCORP
			} else if($empresa == 3) { //PREMIER - DEMAIS LOCALIDADES
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 4) { //BRASCORP
				$retorno = @$this->renderizaexcelbrascorp($r, $empresa); //AQUI FOI FEITO JÁ PARA BRASCORP
			} else if($empresa == 5) { //GRANFOOD
				$retorno = @$this->renderizaexcelgranfood($r); //AQUI FOI FEITO JÁ PARA BRASCORP
			} else if($empresa == 6) { //PREMIER - ESCRITÓRIO SP
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 7) { //PREMIER - CD'S
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 8) { //PREMIER - FABRICA DOURADO
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 9) { //PREMIER - Esc. Rondonopolis
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 10) { //EXTERNOS
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 11) { //FABRICA PARANA
				$retorno = @$this->renderizaexcelpremier($r, $empresa);
			} else if($empresa == 12) { //PROGATO
				$retorno = @$this->renderizaexcelprogato($r);
			}


			echo '<a href="' . URL . 'chave/excel" target="_blank" class="btn btn-success brn-large" style="margin-bottom:20px;">Exportar Excel</a>';

			Session::init();
			Session::set('excel_pesq', $retorno);
			echo $retorno;

		}

		function excel () {
			Session::init();

			header("Content-type: application/msexcel");
			header("Content-Disposition: attachment; filename=".date("YmdHis").".xls");
			header('Content-Transfer-Encoding: binary');
			header('Pragma: public');
			print "\xEF\xBB\xBF";
			header("Pragma: no-cache");
			header("Content-type: application/force-download");
			echo Session::get('excel_pesq');
		}

		private function renderizaexcelpadrao($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			//$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>LOCAL</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q1. Qual das opções abaixo descreve o seu cargo na empresa?</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q2. Qual &eacute; a sua idade?</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q3. Adotando a classifica&ccedil;&atilde;o do IBGE, como voc&ecirc; se auto declara?Para mais informa&ccedil;&otilde;es sobre a classifica&ccedil;&atilde;o do IBGE veja o esse link.</td>";
			$excel .= "       <td colspan='7' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q4. Assinale a(s) resposta(s) que se aplica(m) caso tenha algum tipo de defici&ecirc;ncia</td>";
			$excel .= "       <td colspan='2' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q5. Qual é a sua religião?</td>";			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q6. Você nasceu no Brasil?</td>";			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q7. Em qual estado brasileiro você nasceu?</td>";			
			$excel .= "       <td colspan='2' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q8. Você se identifica como:</td>";			
			$excel .= "       <td colspan='2' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q9. Ainda sobre identidade de gênero, você se definiria como:Observação: a pessoa transgênera é aquela que não se identifica com o gênero designado a ela no momento do nascimento.Exemplo: quando nasceu disseram que era menino e, ao longo da vida, começou a se apresentar como mulher. De outro lado, a pessoa cisgênero é aquele que não é transgênero (simples assim).Caso tenha dúvidas, veja esse vídeo: https://www.youtube.com/watch?v=_hoJg896LBw</td>";			
			$excel .= "       <td colspan='2' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q10. Qual sua orientação sexual?</td>";			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q11. Há quanto tempo que você faz parte da empresa?</td>";
			$excel .= "       <td colspan='3' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q12. Classifique a empresa quanto as afirmações abaixo.</td>";
			$excel .= "       <td colspan='4' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q13. Classifique quanto cada afirmativa abaixo descreve sua experiência na empresa</td>";
			$excel .= "       <td colspan='4' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q14. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com a sua liderança</td>";
			$excel .= "       <td colspan='4' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q15. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com seus colegas de trabalho</td>";
			$excel .= "       <td colspan='4' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q16. Termine as afirmações abaixo da forma como você acredita que melhor se aplica à sua experiência com outras lideranças(se você não tiver contato com outras lideranças, escolha a opção \"nunca\")</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q17. Você já foi VÍTIMA de alguma situação de desrespeito na empresa? (Ex: comentários, retaliações, interrupções sucessivas, ...)</td>";
			$excel .= "       <td colspan='13' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q18. Marque se você vivenciou desrespeito relacionado a alguma(s) das características abaixo:</td>";
			$excel .= "       <td colspan='8' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q19. Qual(is) das opções abaixo melhor representa a(s) pessoa(s) que reproduziram o desrespeito presenciado?</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q20. Você já PRESENCIOU alguma situação de desrespeito na empresa? (Ex: comentários, retaliações, interrupções sucessivas, ...)</td>";
			$excel .= "       <td colspan='13' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q21. Marque se você presenciou desrespeito relacionado a alguma(s) das características abaixo:</td>";
			$excel .= "       <td colspan='8' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q22. Qual(is) das opções abaixo melhor representa a(s) pessoa(s) que reproduziram o desrespeito presenciado?</td>";
			$excel .= "       <td colspan='10' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q23. Classifique quão confortável você estaria para falar (sobre assuntos profissionais ou pessoais) com pessoas dos grupos citados abaixo:</td>";
			$excel .= "       <td colspan='6' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q24. Classifique as afirmações abaixo pensando na relação com o(a) seu/sua líder</td>";
			$excel .= "       <td colspan='6' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q25. Classifique as afirmações abaixo pensando na relação com colegas de trabalho</td>";
			$excel .= "       <td colspan='6' align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q26. Classifique as afirmações abaixo de acordo com a sua experiência</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q27. Quanto o tema de diversidade e inclusão é importante para você?</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Q28. O censo de D&I é uma das etapas da estruturação do programa de diversidade e inclusão da PremieRpet.Você gostaria de deixar algum comentário, depoimento ou sugestão que nos ajudaria nas próximas etapas?</td>";

			$excel .= "     </tr>";



			$excel .= "     <tr>";
			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";		
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Auditiva</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Cognitiva</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>F&iacute;sica/motora</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Visual</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Nenhuma</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Prefiro n&atilde;o dizer</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (especifique)</td>";	
			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (especifique)</td>";	

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (descreva)</td>";
			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (descreva)</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (descreva)</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";
			
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa é comprometida com diversidade e inclusão</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Há esforço de toda a empresa em promover a diversidade</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar suas respostas:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Me sinto como uma pessoa \"estranha\" na empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que meus valores estão alinhados aos valores da empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que posso ser quem sou dentro da empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar suas respostas:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Escuto comentários preconceituosos</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que minhas opiniões são consideradas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que sou interrompido(a) excessivamente em reuniões</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar suas respostas:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Escuto comentários preconceituosos</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que minhas opiniões são consideradas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que sou interrompido(a) excessivamente em reuniões</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar suas respostas:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Escuto comentários preconceituosos</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que minhas opiniões são consideradas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que sou interrompido(a) excessivamente em reuniões</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar suas respostas:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Nenhuma das anteriores</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Idade</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Gênero</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Identidade de gênero</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Orientação sexual</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Escolaridade</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Deficiência</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Origem</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Religião</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Cor/raça/etnia</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Prefiro não dizer</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para adicionar outras características:</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Não vivenciei situações de desrespeito</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Colega(s) de trabalho</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Liderança geral</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Liderado(a/s)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Cliente(s)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fornecedor(a/es)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Prefiro não dizer</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (especifique)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Não vivenciei situações de desrespeito</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Nenhuma das anteriores</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Idade</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Gênero</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Identidade de gênero</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Orientação sexual</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Escolaridade</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Deficiência</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Origem</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Religião</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Cor/raça/etnia</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Prefiro não dizer</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para adicionar outras características:</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Não presenciei situações de desrespeito</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Colega(s) de trabalho</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Liderança geral</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Liderado(a/s)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Cliente(s)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fornecedor(a/es)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Prefiro não dizer</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Outro (especifique)</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Não presenciei situações de desrespeito</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de níveis hierárquicos diferentes</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de gênero diferente</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas LGBTQIA+</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de países diferentes</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de áreas diferentes</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas com deficiência</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de raça/etnia diferentes da sua</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas que falam uma língua nativa diferente da minha</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Pessoas de idades diferentes das minhas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar ou adicionar outros motivos para haver receio:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que posso propor  novas ideias ou tentar  novas formas de  desenvolver minhas  atividades</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  funções</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Compartilho ideias e  melhores práticas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que compartilham  ideias e melhores  práticas comigo</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Acredito que confiam  na minha capacidade  de realizar meu  trabalho</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar sobre as respostas acima</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que posso propor  novas ideias ou tentar  novas formas de  desenvolver minhas  atividades</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou aberto(a) a novas  ideias ou novas formas  de realizar minhas  funções</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Compartilho ideias e  melhores práticas</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto que compartilham  ideias e melhores  práticas comigo</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Acredito que confiam  na minha capacidade  de realizar meu  trabalho</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar sobre as respostas acima</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Acredito que todos têm iguais oportunidades de crescimento dentro da empresa, independente de cor/raça/etnia, gênero, orientação sexual ou outra característica pessoal</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Planejo continuar minha carreira e assumir cargos mais altos dentro da empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Confio na forma como o meu desempenho é avaliado</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Acredito que todos têm iguais oportunidades de aprendizado e acesso a treinamentos dentro da empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Acredito que sei/saberia como reportar alguma situação de assédio ou preconceito vivenciado na empresa</td>";
			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Fique à vontade para comentar sobre essa resposta:</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";

			$excel .= "       <td align='center' valign='middle' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Response</td>";


			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {
				$excel .= "     <tr>";
				//$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $contador . "</td>";
				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['local'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao3'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4a']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4b']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4c']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4d']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4e']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao4f']) . "</td>";				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao4_especifique'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao5'] . "</td>";				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao5_especifique'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao6'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao7'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao8'] . "</td>";				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao8_especifique'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao9'] . "</td>";				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao9_especifique'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao10_especifique'] . "</td>";
				
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao11'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao12a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao12b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao12_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao13a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao13b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao13c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao13_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao14a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao14b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao14c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao14_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao15a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao15b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao15c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao15_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao16a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao16b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao16c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao16_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao17'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18a']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18b']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18c']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18d']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18e']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18f']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18g']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18h']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18i']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18j']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18k']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao18_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao18l']) . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19a']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19b']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19c']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19d']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19e']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19f']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao19_especifique'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao19g']) . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao20'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21a']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21b']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21c']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21d']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21e']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21f']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21g']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21h']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21i']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21j']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21k']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao21_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao21l']) . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22a']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22b']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22c']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22d']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22e']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22f']) . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao22_especifique'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . Func::trocaTexto($value['padrao_questao22g']) . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23d'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23e'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23f'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23g'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23h'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23i'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao23_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24d'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24e'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao24_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25d'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25e'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao25_justificativa'] . "</td>";


				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26a'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26b'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26c'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26d'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26e'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao26_justificativa'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao27'] . "</td>";

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center' valign='middle'>" . $value['padrao_questao28'] . "</td>";

				$excel .= "     </tr>";

				$contador++;
			}
			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;

		}


		private function renderizaexcelbrascorp($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";

			//DIREÇÃO
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Eu recomendaria aos meus parentes e amigos a Empresa como um excelente lugar para trabalhar.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O ambiente de trabalho da Empresa facilita o relacionamento entre os colaboradores.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Do ano passado para cá a empresa melhorou.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os processos, procedimentos e rotinas de trabalho da Empresa são organizados e eficientes.</td>"; //5
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança no Futuro da Empresa.</td>"; //6
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar na Empresa.</td>"; //7
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>"; //8
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os objetivos da empresa são claros e divulgados a todos os colaboradores.</td>"; //9
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Empresa ouve e coloca em prática as sugestões de seus colaboradores.</td>"; //10
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			//FINAL DIREÇÃO


			//BENEFICIOS
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano de saúde atende as minhas necessiadades e da minha família.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano odontológico atende as minhas necessidades e da minha família.</td>"; //2
			$excel .= "        <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O vale transporte atende as minhas necessidades.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O vale refeição atende as minhas necessidades.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com as campanhas como: Dia das Mães, Dia dos Pais, Final de Ano e outras.</td>"; //5
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com o resultado do PPR - Programa de Participação nos Resultados.</td>"; //6
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O benefício da Golden Farma, atende as minhas necessidades.</td>";//7
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			//FINAL BENEFICIOS

			//GESTORES
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O meu superior imediato é um líder de respeito e credibilidade.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Recebo claramente de meu superior imediato todas as orientações que preciso para fazer bem o meu trabalho.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho um bom relacionamento com meu superior imediato.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato conhece profundamente sua área de atuação.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>"; //5
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>"; //6
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou sempre bem atendido quando peço orientações ao meu superior imediato.</td>"; //7
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injustiçado.</td>"; //8
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ouve e respeita a opinião da sua equipe.</td>"; //9
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>"; //10
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho todo equipamento e material necessários para realizar bem o meu trabalho.</td>"; //11
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato é coerente, usa \"o mesmo peso e a mesma medida\" nas suas decisões.</td>"; //12
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>"; //13
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me livre para contribuir com críticas e sugestões ao meu superior imediato.</td>"; //14
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou estimulado a sempre melhorar a forma como é feito o meu trabalho.</td>"; //15
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança naquilo que meu superior imediato diz.</td>"; //16
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Na Empresa todos os gestores agem de acordo com o que dizem.</td>"; //17
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os gestores sabem demonstrar como podemos contribuir com os objetivos da Empresa.</td>"; //18
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			//FINAL GESTORES


			//RH
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As ações do RH são compatíveis à realidade dos colaboradores.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho na velocidade necessária ao colaborador.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH presta um bom atendimento e atenção aos colaboradores.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//FINAL RH

			
			//CI
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna é clara e objetiva.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna realiza um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//FINAL CI

			
			//ST
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Existe uma orientação da equipe de segurança do trabalho sobre a utilização de EPI\'s.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A segurança do trabalho realiza um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//FINAL ST


			//TI
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os sistemas utilizados na empresa atendem as necessidades gerais.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI realiza um trabalho de qualidade.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//FINAL TI


			//TRABALHO
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TRABALHA HÁ</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";
			//FINAL TRABALHO

			if(1==2){
				//OUTROS
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal seca &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal congelada &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meus filhos adoram os brinquedos que ganham da empresa</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O auxilio material escolar &eacute; bom e me ajuda muito com os gastos do in&iacute;cio do ano.</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O aux&iacute;lio estacionamento &eacute; &oacute;timo e atende as minhas necessidades</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano de previd&ecirc;ncia privada atende as minhas expectativas</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As medidas de preven&ccedil;&atilde;o da Covid 19 implantadas pela empresa, atendeu minhas expectativas.</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
				//FINAL OUTROS
			}

			if(1==2){
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A minha experi&ecirc;ncia com o Home Office superou minhas expectativas.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa me proporcionou toda infraestrutura necess&aacute;ria para o trabalho Home Office.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser parcial (50% empresa e 50% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser permanente (100% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Quais os principais benef&iacute;cios do trabalho Home Office para voc&ecirc;? (Escolha at&eacute; 2 op&ccedil;&otilde;es)</td>";			
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";		
				//FINAL HOME OFFICE
			}


			$excel .= "     </tr>";
			$excel .= "     <tr>";

			//DIREÇÃO
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			//FINAL DIREÇÃO


			//BENEFICIOS
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			//FINAL BENEFICIOS


			//GESTORES
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			//FINAL GESTORES


			//RH
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			//FINAL RH


			//CI
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			//FINAL CI

			
			//ST
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			//FINAL ST			


			//TI
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			//FINAL TI

			//TEMPO
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";
			//FINAL TEMPO

			if(1==2){
				//OUTROS
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				//FINAL OUTROS
			}


			if(1==2){
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				//FINAL HOME OFFICE
			}
			

			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {
				$excel .= "     <tr>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				//DIREÇÃO
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao10'] . "</td>";		
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao_justificativa'] . "</td>";
				//FINAL DIREÇÃO


				//BENEFICIOS
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio_justificativa'] . "</td>";
				//FINAL BENEFICIOS


				//GESTORES
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores11'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores12'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores13'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores14'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores15'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores16'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores17'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores18'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores_justificativa'] . "</td>";
				//FINAL GESTORES


				//RH
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos_justificativa'] . "</td>";
				//FINAL RH


				//CI
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna2'] . "</td>";	
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna_justificativa'] . "</td>";
				//FINAL CI

				
				//ST	
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho_justificativa'] . "</td>";
				//FINAL ST
				

				
				//TI
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao_justificativa'] . "</td>";
				//FINAL TI


				//TRABALHO
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['trabalho'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_fazenda'] . "</td>";
				//FINAL TRABALHO


				if(1==2){
					//OUTROS
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros3'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros4'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros5'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros6'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros7'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";
					//FINAL OUTROS
				}

				if(1==2){
					//HOME OFFICE
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office2'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office3'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office4'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_multipla1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_justificativa'] . "</td>";
					//FINAL HOME OFFICE
				}


				$excel .= "     </tr>";

				$contador++;
			}
			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;

		}

		private function renderizaexceldistribuidora($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";
			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>DISTRIBUIDOR</h2></td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A PremieR pet é uma marca premium, que se diferencia dos concorrentes.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A marca PremieR pet tem uma imagem positiva perante os clientes.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Confio na qualidade dos produtos Premier Pet.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Você tem abertura para dar ideias e sugestões.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança no Futuro da PremieR pet.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar para a PremieR pet.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";

			$excel .= "     </tr>";
			$excel .= "     <tr>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>VISÃO</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {

				$excel .= "     <tr>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['setor'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['visao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_distribuidor'] . "</td>";
				$excel .= "     </tr>";
				$contador++;

			}

			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;

		}

		private function renderizaexcelpremier($r, $empresa) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";

			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>LOCALIDADE</h2></td>";

			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>SETOR</h2></td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Eu recomendaria aos meus parentes e amigos a Empresa como um excelente lugar para trabalhar.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O ambiente de trabalho da Empresa facilita o relacionamento entre os colaboradores.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Do ano passado para cá a empresa melhorou.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os processos, procedimentos e rotinas de trabalho da Empresa são organizados e eficientes.</td>"; //5
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança no Futuro da Empresa.</td>"; //6
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar na Empresa.</td>"; //7
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>"; //8
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os objetivos da empresa são claros e divulgados a todos os colaboradores.</td>"; //9
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Empresa ouve e coloca em prática as sugestões de seus colaboradores.</td>"; //10
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";

			if($empresa == 11){
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Você possui o plano de saúde da empresa?  </td>"; //1
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Você utiliza o transporte oferecido pela empresa (Fretado)?</td>"; //2
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Você utiliza o serviço de restaurante oferecido pela empresa?</td>"; //3
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com as campanhas como: Dia das Mães, Dia dos Pais, Final de Ano e outras.</td>"; //5
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com o resultado do PPR - Programa de Participação nos Resultados.</td>"; //6
				$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O benefício da Golden Farma, atende as minhas necessidades.</td>"; //7

			} else {
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano de saúde atende as minhas necessiadades e da minha família.</td>"; //1
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano odontológico atende as minhas necessidades e da minha família.</td>"; //2
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O vale transporte atende as minhas necessidades.</td>"; //3
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com as campanhas como: Dia das Mães, Dia dos Pais, Final de Ano e outras.</td>"; //5
    			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com o resultado do PPR - Programa de Participação nos Resultados.</td>"; //6
			}
		
			if($empresa != 11){ // FABRICA DE PARANÁ SÓ TEM BENEFÍCIOS ATÉ O 3 E MAIS A JUSTIFICATIVA
				$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O vale refeição atende as minhas necessidades.</td>"; //4
			}
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O benefício da Golden Farma, atende as minhas necessidades.</td>"; //7

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			//}

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O meu superior imediato é um líder de respeito e credibilidade.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Recebo claramente de meu superior imediato todas as orientações que preciso para fazer bem o meu trabalho.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho um bom relacionamento com meu superior imediato.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato conhece profundamente sua área de atuação.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>"; //5
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>"; //6
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou sempre bem atendido quando peço orientações ao meu superior imediato.</td>"; //7
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injustiçado.</td>"; //8
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ouve e respeita a opinião da sua equipe.</td>"; //9
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>"; //10
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho todo equipamento e material necessários para realizar bem o meu trabalho.</td>"; //11
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato é coerente, usa \"o mesmo peso e a mesma medida\" nas suas decisões.</td>"; //12
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>"; //13
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me livre para contribuir com críticas e sugestões ao meu superior imediato.</td>"; //14
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou estimulado a sempre melhorar a forma como é feito o meu trabalho.</td>"; //15
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança naquilo que meu superior imediato diz.</td>"; //16
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Na Empresa todos os gestores agem de acordo com o que dizem.</td>"; //17
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os gestores sabem demonstrar como podemos contribuir com os objetivos da Empresa.</td>"; //18
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";


			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As ações do RH são compatíveis à realidade dos colaboradores.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho na velocidade necessária ao colaborador.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH presta um bom atendimento e atenção aos colaboradores.</td>"; //4
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

			//FINAL RH

			//if($empresa != 11){
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna é clara e objetiva.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna realiza um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//}

			//if($empresa != 9 && $empresa != 6){ //Esc. Rondonopolis ou Escritorio SP
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Existe uma orientação da equipe de segurança do trabalho sobre a utilização de EPI\'s.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A segurança do trabalho realiza um trabalho de qualidade.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			//}
			
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>"; //1
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os sistemas utilizados na empresa atendem as necessidades gerais.</td>"; //2
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI realiza um trabalho de qualidade.</td>"; //3
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";			

			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TRABALHA HÁ</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";

			if(1==2){
				if($empresa == 11){ // fabrica parana
					
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; utiliza o vale alimenta&ccedil;&atilde;o oferecido pela empresa?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
					
				} else if($empresa == 6) { //PREMIER - ESCRITÓRIO SP

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal seca &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal congelada &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos at&eacute; 10 anos e recebe os brinquedos no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos de 3 a 10 anos e recebe o aux&iacute;lio material escolar no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Utiliza o Aux&iacute;lio Estacionamento como benef&iacute;cio?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; possui o plano de previd&ecirc;ncia privada da empresa?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";


				} else if($empresa == 7 || $empresa == 9 || $empresa == 10) { //CD'S OU Esc. Rondon&oacute;polis OU EXTERNOS

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O cart&atilde;o de Natal &eacute; &oacute;timo, e atende minhas necessidades.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos at&eacute; 10 anos e recebe os brinquedos no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos de 3 a 10 anos e recebe o aux&iacute;lio material escolar no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; possui o plano de previd&ecirc;ncia privada da empresa?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

				} else if($empresa == 8) { //PREMIER - FABRICA DOURADO

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A cesta b&aacute;sica da PremieRpet&reg;atende as minhas necessidades</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Utilizo o conv&ecirc;nio com as farm&aacute;cias da cidade?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal seca &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal congelada &eacute; &oacute;tima, e atende toda minha fam&iacute;lia.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos at&eacute; 10 anos e recebe os brinquedos no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos de 3 a 10 anos e recebe o aux&iacute;lio material escolar no final do ano?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; possui o plano de previd&ecirc;ncia privada da empresa?</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</td>";


					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A aferi&ccedil;&atilde;o de temperatura corporal dos colaboradores nas entradas.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Medi&ccedil;&atilde;o de oxigena&ccedil;&atilde;o do sangue dos colaboradores nas entradas.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Atendimento ambulatorial: medica&ccedil;&atilde;o, aferi&ccedil;&atilde;o de press&atilde;o e socorro m&eacute;dico.</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Atendimento a acidentes: primeiros socorros, curativos e imobiliza&ccedil;&atilde;o quando necess&aacute;rio.</td>";


					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
				}
			}

			if($empresa != 7 && $empresa != 9 && $empresa != 10 && $empresa != 11 && 1==2) { //CD'S OU Esc. Rondon&oacute;polis OU EXTERNOS OU FABRICA PARANA
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A minha experi&ecirc;ncia com o Home Office superou minhas expectativas.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa me proporcionou toda infraestrutura necess&aacute;ria para o trabalho Home Office.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser parcial (50% empresa e 50% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser permanente (100% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Quais os principais benef&iacute;cios do trabalho Home Office para voc&ecirc;? (Escolha at&eacute; 2 op&ccedil;&otilde;es)</td>";			
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";		
				//FINAL HOME OFFICE
			}

			$excel .= "     </tr>";



			$excel .= "     <tr>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			//if($empresa != 11){
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			if($empresa == 11){ // FABRICA DE PARANÁ SÓ TEM BENEFÍCIOS ATÉ O 3 E MAIS A JUSTIFICATIVA
				$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			}
			if($empresa != 11){ // FABRICA DE PARANÁ SÓ TEM BENEFÍCIOS ATÉ O 3 E MAIS A JUSTIFICATIVA
				$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			}
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			//}

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			//if($empresa != 11){
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			//}

			//if($empresa != 9 && $empresa != 6){ //Esc. Rondonopolis ou Escritorio SP
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			//}

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";

			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";

			if(1==2){
				if($empresa == 11){ // fabrica parana
					
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					
				} else if($empresa == 6) { // PREMIER - ESCRITÓRIO SP

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";				

				} else if($empresa == 7 || $empresa == 9 || $empresa == 10) { //CD'S E EXTERNOS OU Esc. Rondon&oacute;polis OU EXTERNOS

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";				

				} else if($empresa == 8) { //PREMIER - FABRICA DOURADO

					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
					$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";

				}
			}

			if($empresa != 7 && $empresa != 9 && $empresa != 10 && $empresa != 11 && 1==2) { //CD'S OU Esc. Rondon&oacute;polis OU EXTERNOS OU FABRICA PARANA
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				//FINAL HOME OFFICE
			}

			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {

				$excel .= "     <tr>";
				$excel .= "     <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['localidade'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['setor'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao_justificativa'] . "</td>";

				//if($empresa != 11){
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio5'] . "</td>";

				if($empresa == 11){ // FABRICA DE PARANÁ SÓ TEM BENEFÍCIOS ATÉ O 3 E MAIS A JUSTIFICATIVA
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio6'] . "</td>";
				}
				if($empresa != 11){ // FABRICA DE PARANÁ SÓ TEM BENEFÍCIOS ATÉ O 3 E MAIS A JUSTIFICATIVA
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio6'] . "</td>";
					//$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio7'] . "</td>";
				}
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio7'] . "</td>";


				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio_justificativa'] . "</td>";
				//}

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores11'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores12'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores13'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores14'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores15'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores16'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores17'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores18'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos_justificativa'] . "</td>";

				//if($empresa != 11){
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna_justificativa'] . "</td>";
				//}

				//if($empresa != 9 && $empresa != 6){ //Esc. Rondonopolis ou Escritorio SP
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho_justificativa'] . "</td>";
				//}

				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['trabalho'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_fazenda'] . "</td>";

				if(1==2){

					if($empresa == 11){ // fabrica parana
	
						//OUTROS
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";
						//FINAL OUTROS
						
						
					} else if($empresa == 6) { // PREMIER - ESCRITÓRIO SP
	
						//OUTROS
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros3'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros4'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros5'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros6'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros7'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";
						//FINAL OUTROS
	
					} else if($empresa == 7 || $empresa == 9 || $empresa == 10) { //CD'S OU Esc. Rondon&oacute;polis OU EXTERNOS
	
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros3'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros4'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros5'] . "</td>";	
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";				
	
					} else if($empresa == 8) { //PREMIER - FABRICA DOURADO
	
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros3'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros4'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros5'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros6'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros7'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros8'] . "</td>";
	
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros9a'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros9b'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros9c'] . "</td>";
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros9d'] . "</td>";
	
						$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";
	
					}
				}

				if($empresa != 7 && $empresa != 9 && $empresa != 10 && $empresa != 11 && 1==2) { //CD'S OU Esc. Rondon&oacute;polis OU EXTERNOS OU FABRICA PARANA
					//HOME OFFICE
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office2'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office3'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office4'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_multipla1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_justificativa'] . "</td>";
					//FINAL HOME OFFICE
				}

				$excel .= "     </tr>";

				$contador++;
			}

			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;
		}

		private function renderizaexcelgranfood($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";
			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>SETOR</h2></td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Eu recomendaria aos meus parentes e amigos a empresa como um excelente lugar para trabalhar.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> O ambiente de trabalho da empresa facilita o relacionamento entre os colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Os processos, procedimentos e rotinas de trabalho da empresa são organizados e eficientes.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Tenho confiança no Futuro da empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar na empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os objetivos da empresa são claros e divulgados a todos os colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa ouve e coloca em prática as sugestões de seus colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Do ano passado para cá a empresa melhorou.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O convênio médico é bom para mim e para minha família.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O transporte atende as necessidades dos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O convênio odontológico é bom para mim e para minha família.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com as campanhas como: Dia das Mães, Dia dos Pais, Final de Ano e outras.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O meu superior imediato é um líder de respeito e credibilidade.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Recebo claramente de meu superior imediato todas as orientações que preciso para fazer bem o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho um bom relacionamento com meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato conhece profundamente sua área de atuação.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou sempre bem atendido quando peço orientações ao meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injustiçado.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ouve e respeita a opinião da sua equipe.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho todo equipamento e material necessários para realizar bem o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sinto-me livre para contribuir com críticas e sugestões ao meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sou estimulado a sempre melhorar a forma como é feito o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os gestores sabem demonstrar como podemos contribuir com os objetivos da Grandfood.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Na empresa todos os gestores agem de acordo com o que dizem.</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As ações do RH são compatíveis à realidade dos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho na velocidade necessária ao colaborador.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH presta um bom atendimento e atenção aos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna é clara e objetiva.</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Existe uma orientação da equipe de segurança do trabalho sobre a utilização de EPI\'s.</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A segurança do trabalho realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os sistemas utilizados na empresa atendem as necessidades gerais.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TRABALHA HÁ</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";
			$excel .= "     </tr>";
			$excel .= "     <tr>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {

				$excel .= "     <tr>";
				$excel .= "     <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['setor'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores11'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores12'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores13'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores14'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores15'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['trabalho'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_fazenda'] . "</td>";
				$excel .= "     </tr>";

				$contador++;
			}

			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;
		}

		private function renderizaexcelpremierdourado($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";
			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>SETOR</h2></td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Eu recomendaria aos meus parentes e amigos a empresa como um excelente lugar para trabalhar.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O ambiente de trabalho da empresa facilita o relacionamento entre os colaboradores.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>"; //3

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os processos, procedimentos e rotinas de trabalho da empresa são organizados e eficientes.</td>"; //4

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança no Futuro da empresa.</td>"; //5

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar na empresa.</td>"; //6

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>"; //7

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os objetivos da empresa são claros e divulgados a todos os colaboradores.</td>"; //8

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa ouve e coloca em prática as sugestões de seus colaboradores.</td>"; //9

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Do ano passado para cá a empresa melhorou.</td>"; //10

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano de saúde atende as minhas necessiadades e da minha família.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano odontológico atende as minhas necessidades e da minha família.</td>";//2

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O transporte atende as necessidades dos colaboradores.</td>"; //3

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com as campanhas como: Dia das Mães, Dia dos Pais, Final de Ano e outras.</td>"; //4

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Estou satisfeito com o resultado do PPR - Programa de Participação nos Resultados.</td>"; //5
			
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O benefício da Golden Farma, atende as minhas necessidades.</td>";//6


			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O meu superior imediato é um líder de respeito e credibilidade.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Recebo claramente de meu superior imediato todas as orientações que preciso para fazer bem o meu trabalho.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho um bom relacionamento com meu superior imediato.</td>"; //3

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato conhece profundamente sua área de atuação.</td>"; //4

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>"; //5

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>"; //6

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou sempre bem atendido quando peço orientações ao meu superior imediato.</td>"; //7

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injustiçado.</td>"; //8

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ouve e respeita a opinião da sua equipe.</td>"; //9

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>"; //10

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho todo equipamento e material necessários para realizar bem o meu trabalho.</td>"; //11

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Meu superior imediato é coerente, usa \"o mesmo peso e a mesma medida\" nas suas decisões.</td>"; //12

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>"; //13

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me livre para contribuir com críticas e sugestões ao meu superior imediato.</td>"; //14

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou estimulado a sempre melhorar a forma como é feito o meu trabalho.</td>"; //15

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho confiança naquilo que meu superior imediato diz.</td>"; //16

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Na empresa todos os gestores agem de acordo com o que dizem.</td>"; //17

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os gestores sabem demonstrar como podemos contribuir com os objetivos da Empresa.</td>"; //18

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";


			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As ações do RH são compatíveis à realidade dos colaboradores.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho de qualidade.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho na velocidade necessária ao colaborador.</td>"; //3

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH presta um bom atendimento e atenção aos colaboradores.</td>"; //4

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna é clara e objetiva.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna realiza um trabalho de qualidade.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Existe uma orientação da equipe de segurança do trabalho sobre a utilização de EPI's.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A segurança do trabalho realiza um trabalho de qualidade.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>"; //1

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os sistemas utilizados na empresa atendem as necessidades gerais.</td>"; //2

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI realiza um trabalho de qualidade.</td>"; //3

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";

			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TRABALHA HÁ</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";


			if(1==2) {
				//OUTROS
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A cesta b&aacute;scia da PremieRpet atende as minhas necessidades?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Utilizo o conv&ecirc;nio com as farmacias da cidade?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal seca &eacute; &oacute;tima, e atende toda minha fam&iacute;lia?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A Cesta de Natal congelada &eacute; &oacute;tima, e atende toda minha fam&iacute;lia?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos at&eacute; 10 anos e recebe os brinquedos no final do ano?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tem filhos de 3 a 10 anos e recebe o aux&iacute;lio material escolar no final do ano?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; possui o plano de previd&ecirc;ncia privada da empresa?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Voc&ecirc; se sentiu amparado pela empresa at&eacute; este momento da pandemia da COVID-19?</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
				//FINAL OUTROS
			}

			if(1==2) {
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A minha experi&ecirc;ncia com o Home Office superou minhas expectativas.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa me proporcionou toda infraestrutura necess&aacute;ria para o trabalho Home Office.</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser parcial (50% empresa e 50% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Levando em considera&ccedil;&atilde;o minhas atividades do dia-a-dia, acredito que o Home Office poderia ser permanente (100% casa).</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Quais os principais benef&iacute;cios do trabalho Home Office para voc&ecirc;? (Escolha at&eacute; 2 op&ccedil;&otilde;es)</td>";			
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";		
				//FINAL HOME OFFICE
			}


			$excel .= "     </tr>";
			$excel .= "     <tr>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";

			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";

			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";

			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";

			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";

			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TEMPO</td>";			

			if(1==2){
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
				$excel .= "       <td align='center' bgcolor='#0086b3' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			}

			if(1==2){
				//HOME OFFICE
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>HOME OFFICE</td>";
				//FINAL HOME OFFICE
			}

			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {

				$excel .= "     <tr>";
				$excel .= "     <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['setor'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores11'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores12'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores13'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores14'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores15'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores16'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores17'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores18'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['trabalho'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_fazenda'] . "</td>";

				if(1==2){
					//OUTROS
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros2'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros3'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros4'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros5'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros6'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros7'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros8'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['outros_justificativa'] . "</td>";
					//FINAL OUTROS
				}

				if(1==2){
					//HOME OFFICE
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office2'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office3'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office4'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_multipla1'] . "</td>";
					$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['home_office_justificativa'] . "</td>";
					//FINAL HOME OFFICE
				}

				$excel .= "     </tr>";

				$contador++;
			}

			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;

		}
		
		
		private function renderizaexcelprogato($r) {

			$excel  = " <table width='100%' border='1' cellpadding='6' cellspacing='0' style='font-family:Calibri; font-size:11px;'>";
			$excel .= "   <tbody>";
			$excel .= "     <tr>";
			$excel .= "       <td width='10' rowspan='2' align='center' bgcolor='#ED7D31' style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:50px;'><h2>Nº</h2></td>";
			$excel .= "       <td rowspan='2' align='center' bgcolor='#ED7D31'  style='font-weight: bold; color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto;'><h2>SETOR</h2></td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Eu recomendaria aos meus parentes e amigos a empresa como um excelente lugar para trabalhar.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> O ambiente de trabalho da empresa facilita o relacionamento entre os colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa faz você se sentir importante no que faz.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Os processos, procedimentos e rotinas de trabalho da empresa são organizados e eficientes.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Tenho confiança no Futuro da empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho orgulho e gosto de trabalhar na empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os objetivos da empresa são claros e divulgados a todos os colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A empresa ouve e coloca em prática as sugestões de seus colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Do ano passado para cá a empresa melhorou.</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano de saúde atende as minhas necessidades e da minha família.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O plano odontológico atende as minhas necessidades e da minha família.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O Vale combustível atende as necessidades dos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O serviço do restaurante atende as necessidades dos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O benefício da Golden Farma, atende as minhas necessidades.</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O meu superior imediato é um líder de respeito e credibilidade.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Recebo claramente de meu superior imediato todas as orientações que preciso para fazer bem o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho um bom relacionamento com meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato conhece profundamente sua área de atuação.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Sou sempre bem atendido quando peço orientações ao meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injustiçado.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ouve e respeita a opinião da sua equipe.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Tenho todo equipamento e material necessários para realizar bem o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sinto-me livre para contribuir com críticas e sugestões ao meu superior imediato.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Sou estimulado a sempre melhorar a forma como é feito o meu trabalho.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os gestores sabem demonstrar como podemos contribuir com os objetivos da Grandfood.</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'> Na empresa todos os gestores agem de acordo com o que dizem.</td>";

			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFICATIVA</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>As ações do RH são compatíveis à realidade dos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH tem um trabalho na velocidade necessária ao colaborador.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O RH presta um bom atendimento e atenção aos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna é clara e objetiva.</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A comunicação interna realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Existe uma orientação da equipe de segurança do trabalho sobre a utilização de EPI\'s.</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>A segurança do trabalho realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI cumpre os prazos de atendimento aos colaboradores.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>Os sistemas utilizados na empresa atendem as necessidades gerais.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>O departamento de TI realiza um trabalho de qualidade.</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>JUSTIFIQUE</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TRABALHA HÁ</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>COMENTÁRIOS</td>";
			$excel .= "     </tr>";
			$excel .= "     <tr>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#7B7B7B' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>DIREÇÃO</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#548235' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>BENEFÍCIOS</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#333F4F' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>GESTORES</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#C00000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>RH</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#1DAFC7' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>CI</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#7C21D5' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>ST</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#969000' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>TI</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			$excel .= "       <td align='center' bgcolor='#666666' style='color:#FFFFFF; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;'>OUTROS</td>";
			$excel .= "     </tr>";

			$contador = 1;
			foreach($r as $key => $value) {

				$excel .= "     <tr>";
				$excel .= "     <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $contador . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['setor'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['direcao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['beneficio_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores5'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores6'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores7'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores8'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores9'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores10'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores11'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores12'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores13'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores14'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores15'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['gestores_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos4'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['recursos_humanos_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comunicacao_interna_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['seguranca_trabalho_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao1'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao2'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao3'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['tecnologia_informacao_justificativa'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['trabalho'] . "</td>";
				$excel .= "       <td style='color:#333333; border:.5px solid #333333; min-width:120px; width:auto; font-size:10px;' align='center'>" . $value['comentario_fazenda'] . "</td>";
				$excel .= "     </tr>";

				$contador++;
			}

			$excel .= "   </tbody>";
			$excel .= " </table>";

			return $excel;
		}

		private function renderizapesquisapremier($data, $setor) {
			$string  = '';

			if($setor != 0) {
				$r = $this->model->condicao_premier;
			}

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Dire&ccedil;&atilde;o</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Eu recomendaria aos meus parentes e amigos a PremieR pet como um excelente lugar para trabalhar.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O ambiente de trabalho da PremieR pet facilita o relacionamento entre os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Do ano passado para c&aacute; a empresa melhorou.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Os processos, procedimentos e rotinas de trabalho da PremieR pet s&atilde;o organizados e eficientes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Tenho confian&ccedil;a no Futuro da  PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Tenho orgulho e gosto de trabalhar na PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - A PremieR pet ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Benef&iacute;cios</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O conv&ecirc;nio m&eacute;dico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O transporte atende as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Servi&ccedil;os do restaurante atendem as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Servi&ccedil;os de VR atendem as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - O conv&ecirc;nio odontol&oacute;gico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Estou satisfeito com as campanhas como: Dia das M&atilde;es, Dia dos Pais, Final de Ano, entre outras.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Estou satisfeito com o  resultado do PPR - Programa de Participa&ccedil;&atilde;o nos Resultados.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - O benefício da Golden Farma, atende as minhas necessidades.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Gestores</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O meu superior imediato &eacute; um l&iacute;der de respeito e credibilidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Tenho um bom relacionamento com meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">11 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores11'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">12 - Meu superior imediato &eacute; coerente, usa "o mesmo peso e a mesma medida" nas suas decis&otilde;es.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores12'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">13 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores13'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">14 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores14'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">15 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores15'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">16 - Tenho confian&ccedil;a naquilo que meu superior imediato diz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores16'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">17 - Na PremieR pet todos os gestores agem de acordo com o que dizem.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores17'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">18 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores18'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores18'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores18'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores18'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores18'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Recursos Humanos</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O RH tem um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Comunica&ccedil;&atilde;o Interna</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			if((int)$r[0]['seguranca_trabalho'] != 0 || $setor == 0) {

				$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
				$string .= ' <h3>Seguran&ccedil;a do Trabalho</h3>';
				$string .= ' <p class="text-danger" style="display:none;">Somente colaboradores da f&aacute;brica preenchem</p>';
				$string .= ' <div class="panel panel-default">';
				$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
				$string .= ' 	<thead>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td>&nbsp;</td>';
				$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
				//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</thead>';
				$string .= ' 	<tbody>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI\'s.</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade .</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</tbody>';
				$string .= '   </table>';
				$string .= ' </div>';
				$string .= ' </div>';

			}

			if((int)$r[0]['ti'] != 0 || $setor == 0) {
				$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
				$string .= ' <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>';
				$string .= ' <p class="text-danger" style="display:none;">Somente colaboradores do escrit&oacute;rio e &aacute;reas administrativas preenchem</p>';
				$string .= ' <div class="panel panel-default">';
				$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
				$string .= ' 	<thead>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td>&nbsp;</td>';
				$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
				//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</thead>';
				$string .= ' 	<tbody>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores. </td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Os sistemas utilizandos na empresa atendem as necessidades gerais.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O departamento de TI realiza um trabalho de qualidade.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</tbody>';
				$string .= '   </table>';
				$string .= ' </div>';
				$string .= ' </div>';

			}

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Outros</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][1];
			$string .= ' 		Pessoa (Menos de um ano)</td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][2];
			$string .= ' 		Pessoa (Mais de um ano)</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			return $string;
		}

		private function renderizapesquisadistribuidora($data) {			
			$string  = '';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Vis&atilde;o da Empresa</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - A PremieR pet &eacute; uma marca premium, que se diferencia dos concorrentes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A marca PremieR pet tem uma imagem positiva perando os clientes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Confio na qualidade dos produtos Premier Pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Voc&ecirc; tem abertura para dar ideias e sugest&otilde;es.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Tenho confian&ccedil;a no Futuro da  PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Tenho orgulho e gosto de trabalhar para a PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['visao8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['visao8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';


			return $string;
		}

		private function renderizapesquisabrascorp($data) {

			$string  = '';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Dire&ccedil;&atilde;o</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Eu recomendaria aos meus parentes e amigos a Brascorp como um excelente lugar para trabalhar.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O ambiente de trabalho da Brascorp facilita o relacionamento entre os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Do ano passado para c&aacute; a empresa melhorou.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Os processos, procedimentos e rotinas de trabalho da Brascorp s&atilde;o organizados e eficientes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Tenho confian&ccedil;a no Futuro da  Brascorp.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Tenho orgulho e gosto de trabalhar na Brascorp.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - A Brascorp ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Benef&iacute;cios</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O conv&ecirc;nio m&eacute;dico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O transporte atende as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Os servi&ccedil;os do restaurante/VR atendem as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O conv&ecirc;nio odontol&oacute;gico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Estou satiseito com as campanhas como: Dia das M&atilde;es, Dia dos Pais, Final de Ano e outras.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Estou satisfeito com o  resultado do PPR - Programa de Participa&ccedil;&atilde;o nos Resultados.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= '	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - O benefício da Golden Farma, atende as minhas necessidades.	</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Gestores</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O meu superior imediato &eacute; um l&iacute;der de respeito e credibilidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Tenho um bom relacionamento com meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Sempre que preciso, posso contar com meu superior imediato para assuntos pessoais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">11 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores11'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">12 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores12'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">13 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores13'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">14 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores14'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">15 - Tenho confian&ccedil;a naquilo que meu superior imediato diz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores15'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">16 - Na PremieR pet todos os gestores agem de acordo com o que dizem.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores16'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores16'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">17 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da PremieR pet.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores17'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores17'][5] . '</td>';
			$string .= ' 	  </tr>';

			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Recursos Humanos</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O RH tem um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][5] . '</td>';
			$string .= ' 	  </tr>';

			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Comunica&ccedil;&atilde;o Interna</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][5] . '</td>';
			$string .= ' 	  </tr>';

			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Seguran&ccedil;a do Trabalho</h3>';
			$string .= ' <p class="text-danger" style="display:none;">Somente colaboradores da f&aacute;brica preenchem</p>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI\'s.</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade .</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>';
			$string .= ' <p class="text-danger" style="display:none;">Somente colaboradores do escrit&oacute;rio e &aacute;reas administrativas preenchem</p>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores. </td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Os sistemas utilizandos na empresa atendem as necessidades gerais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O departamento de TI realiza um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Outros</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][1];
			$string .= ' 		  Pessoa (Menos de um ano)</td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][2];
			$string .= ' 		  Pessoa (Mais de um ano)</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			return $string;


		}

		private function renderizapesquisafazenda($data, $setor) {

			$string  = '';
			$string .= '<div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= '        <h3>Dire&ccedil;&atilde;o</h3>';
			$string .= '        <div class="panel panel-default">';
			$string .= ' <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Eu recomendaria aos meus parentes e amigos a empresa como um excelente lugar para trabalhar.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O ambiente de trabalho da empresa facilita o relacionamento entre os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Os processos, procedimentos e rotinas de trabalho da empresa s&atilde;o organizados e eficientes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Tenho confian&ccedil;a no Futuro da  empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Tenho orgulho e gosto de trabalhar na empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - A empresa ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Do ano passado para c&aacute; a empresa melhorou.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Benef&iacute;cios</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O conv&ecirc;nio m&eacute;dico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O transporte atende as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O conv&ecirc;nio odontol&oacute;gico &eacute; bom para mim e para minha fam&iacute;lia.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Estou satiseito com as campanhas como: Dia das M&atilde;es, Dia dos Pais, Final de Ano e outras.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Gestores</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O meu superior imediato &eacute; um l&iacute;der de respeito e credibilidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Tenho um bom relacionamento com meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">11 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores11'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">12 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores12'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">13 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores13'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">14 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da Grandfood.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores14'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">15 - Na empresa todos os gestores agem de acordo com o que dizem.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores15'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Recursos Humanos</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O RH tem um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Comunica&ccedil;&atilde;o Interna</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Seguran&ccedil;a do Trabalho</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI\'s.</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade .</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			if($setor == 2 || $setor == 0) {

				$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
				$string .= ' <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>';
				$string .= ' <div class="panel panel-default">';
				$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
				$string .= ' 	<thead>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td>&nbsp;</td>';
				$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
				//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</thead>';
				$string .= ' 	<tbody>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores. </td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Os sistemas utilizados na empresa atendem as necessidades gerais.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O departamento de TI realiza um trabalho de qualidade.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</tbody>';
				$string .= '   </table>';
				$string .= ' </div>';
				$string .= ' </div>';

			}

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Outros</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][1];
			$string .= ' 		  Pessoas (Menos de um ano)</td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][2];
			$string .= ' 		  Pessoas (Mais de um ano)</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= '   </table>';

			return $string;

		}

		private function renderizapesquisaprogato($data) {

			$string  = '';
			$string .= '<div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= '        <h3>Dire&ccedil;&atilde;o</h3>';
			$string .= '        <div class="panel panel-default">';
			$string .= ' <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Eu recomendaria aos meus parentes e amigos a empresa como um excelente lugar para trabalhar.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O ambiente de trabalho da empresa facilita o relacionamento entre os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - A empresa faz voc&ecirc; se sentir importante no que faz.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Os processos, procedimentos e rotinas de trabalho da empresa s&atilde;o organizados e eficientes.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Tenho confian&ccedil;a no Futuro da  empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Tenho orgulho e gosto de trabalhar na empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Seus colegas de trabalho se sentem compromissados em, juntos desempenharem um trabalho com qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Os objetivos da empresa s&atilde;o claros e divulgados a todos os colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - A empresa ouve e coloca em pr&aacute;tica as sugest&otilde;es de seus colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Do ano passado para c&aacute; a empresa melhorou.</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['direcao10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['direcao10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Benef&iacute;cios</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O plano de saúde atende as minhas necessidades e da minha família.	</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O plano odontológico atende as minhas necessidades e da minha família.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O Vale combustível atende as necessidades dos colaboradores.	</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O serviço do restaurante atende as necessidades dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - O benefício da Golden Farma, atende as minhas necessidades.	</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['beneficio5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['beneficio4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Gestores</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O meu superior imediato &eacute; um l&iacute;der de respeito e credibilidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Recebo claramente de meu superior imediato todas as orienta&ccedil;&otilde;es que preciso para fazer bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - Tenho um bom relacionamento com meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - Meu superior imediato conhece profundamente sua &aacute;rea de atua&ccedil;&atilde;o.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">5 - Sou reconhecido pelo meu superior imediato quando realizo um bom trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores5'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores5'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">6 - Sinto-me estimulado pelo gestor a buscar novos conhecimentos fora da empresa.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores6'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores6'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">7 - Sou sempre bem atendido quando pe&ccedil;o orienta&ccedil;&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores7'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores7'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">8 - Tenho a liberdade em recorrer ao meu superior imediato quando me sentir injusti&ccedil;ado.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores8'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores8'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">9 - Meu superior imediato ouve e respeita a opini&atilde;o da sua equipe.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores9'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores9'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">10 - Tenho todo equipamento e material necess&aacute;rios para realizar bem o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores10'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores10'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">11 - Meu superior imediato ajuda a decidir o que devo fazer para aprender mais.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores11'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores11'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">12 - Sinto-me livre para contribuir com cr&iacute;ticas e sugest&otilde;es ao meu superior imediato.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores12'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores12'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">13 - Sou estimulado a sempre melhorar a forma como &eacute; feito o meu trabalho.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores13'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores13'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">14 - Os gestores sabem demonstrar como podemos contribuir com os objetivos da Grandfood.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores14'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores14'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">15 - Na empresa todos os gestores agem de acordo com o que dizem.</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['gestores15'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['gestores15'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Recursos Humanos</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - As a&ccedil;&otilde;es do RH s&atilde;o compat&iacute;veis &agrave; realidade dos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - O RH tem um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O RH tem um trabalho na velocidade necess&aacute;ria ao colaborador.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos3'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">4 - O RH presta um bom atendimento e aten&ccedil;&atilde;o aos colaboradores.</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['recursos_humanos4'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';
			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Comunica&ccedil;&atilde;o Interna</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - A comunica&ccedil;&atilde;o interna &eacute; clara e objetiva.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A comunica&ccedil;&atilde;o interna realiza um trabalho de qualidade.</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['comunicacao_interna2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Seguran&ccedil;a do Trabalho</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td>&nbsp;</td>';
			$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
			$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
			//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= ' 	<tbody>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - Existe uma orienta&ccedil;&atilde;o da equipe de seguran&ccedil;a do trabalho sobre a utiliza&ccedil;&atilde;o de EPI\'s.</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho1'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - A seguran&ccedil;a do trabalho realiza um trabalho de qualidade .</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][1] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][2] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][3] . '</td>';
			$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][4] . '</td>';
			//$string .= ' 		<td align="center">' . (int)$data['seguranca_trabalho2'][5] . '</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</tbody>';
			$string .= '   </table>';
			$string .= ' </div>';
			$string .= ' </div>';

			if($setor == 2 || $setor == 0) {

				$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
				$string .= ' <h3>Tecnologia da Informa&ccedil;&atilde;o TI</h3>';
				$string .= ' <div class="panel panel-default">';
				$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
				$string .= ' 	<thead>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td>&nbsp;</td>';
				$string .= ' 		<td align="center"><strong>Discordo Totalmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Discordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Parcialmente</strong></td>';
				$string .= ' 		<td align="center"><strong>Concordo Totalmente</strong></td>';
				//$string .= ' 		<td align="center"><strong>N&atilde;o Aplic&aacute;vel</strong></td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</thead>';
				$string .= ' 	<tbody>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">1 - O departamento de TI cumpre os prazos de atendimento aos colaboradores. </td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao1'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">2 - Os sistemas utilizados na empresa atendem as necessidades gerais.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao2'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	  <tr>';
				$string .= ' 		<td align="left" bgcolor="#FFF7F0">3 - O departamento de TI realiza um trabalho de qualidade.</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][1] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][2] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][3] . '</td>';
				$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][4] . '</td>';
				//$string .= ' 		<td align="center">' . (int)$data['tecnologia_informacao3'][5] . '</td>';
				$string .= ' 	  </tr>';
				$string .= ' 	</tbody>';
				$string .= '   </table>';
				$string .= ' </div>';
				$string .= ' </div>';

			}

			$string .= ' <div class="col-xs-12 col-md-12 col-lg-12">';
			$string .= ' <h3>Outros</h3>';
			$string .= ' <div class="panel panel-default">';
			$string .= '   <table class="table table-hover table-condensed table-responsive table-bordered table-striped">';
			$string .= ' 	<thead>';
			$string .= ' 	  <tr>';
			$string .= ' 		<td align="left" bgcolor="#FFF7F0"><strong>1 - H&aacute; quanto tempo trabalha na empresa?</strong></td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][1];
			$string .= ' 		  Pessoas (Menos de um ano)</td>';
			$string .= ' 		<td align="center">' . (int)$data['trabalho'][2];
			$string .= ' 		  Pessoas (Mais de um ano)</td>';
			$string .= ' 	  </tr>';
			$string .= ' 	</thead>';
			$string .= '   </table>';

			return $string;

		}


		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->profissaoList = $this->model->profissaoList();
			$this->view->render('chave/index');
		}

		public function create() {

			Session::init();
			Session::set("EMPRESA_CRIACAO_CHAVE", (int)$_POST['empresa']);
			
		

			$data = array();
			$data['empresa'] = (int)$_POST['empresa'];
			$data['qtd_chaves'] = (int)$_POST['qtd_chaves'];
			$data['enviar_email'] = (int)$_POST['enviar_email'];
			$data['email'] = $_POST['email'];
			$data['reenviar'] = (int)$_POST['reenviar'];
			

			$result = $this->model->create($data);
			
			
			

			if($result['erro'] > -1){
				echo json_encode($result);
			} else {
				header('location: ' .URL . 'chave/listar');	
			}			
		}

		public function update($id) {

			$data = array();
			$data['empresa'] = (int)$_POST['empresa'];
			$data['qtd_chaves'] = (int)$_POST['qtd_chaves'];
			$data['id'] = $id;

			$this->model->update($data);
			header('location: ' .URL . 'chave');
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