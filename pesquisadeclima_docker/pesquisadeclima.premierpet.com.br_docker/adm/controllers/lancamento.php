<?php

class Lancamento extends Controller {

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
			
			$this->view->js = array('lancamento/js/funcoes');			
			$this->view->singleUser = NULL;
			$this->view->instanceDB = NULL;
			
		}
				
		public function Index() {
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('lancamento/index');	
		}
		
		public function listar(){
			$this->view->instanceDB = $this->model->instanceDB();
			$this->view->render('lancamento/listar');
		}
				
		public function create() {
			
			$data = array();
			$data2 = array();
			
			$data['idfrequencia']			=	$_POST['frequencia'];		
			$data['idtipo_assistencial']    =   $_POST['tipo_assistencial'];
			$data['idturma']                =   $_POST['turma'];
			$data['idlancamento']           =   (int)$_POST['idlancamento'];             
			$data['descricao']			    =   Func::removeCaracters($_POST['descricao']);
			$data['reposicao_nome_1']       =   Func::removeCaracters($_POST['nome_reposicao_1']); 
			$data['reposicao_nome_2']       =   Func::removeCaracters($_POST['nome_reposicao_2']);    
			$data['reposicao_nome_3']       =   Func::removeCaracters($_POST['nome_reposicao_3']);    
			$data['reposicao_nome_4']       =   Func::removeCaracters($_POST['nome_reposicao_4']);    
			$data['reposicao_nome_5']       =   Func::removeCaracters($_POST['nome_reposicao_5']);    
			$data['dia_trabalho_1']         =   Func::removeCaracters($_POST['dia_trabalho_1']);     
			$data['dia_trabalho_2']         =   Func::removeCaracters($_POST['dia_trabalho_2']);      
			$data['dia_trabalho_3']         =   Func::removeCaracters($_POST['dia_trabalho_3']);      
			$data['dia_trabalho_4']         =   Func::removeCaracters($_POST['dia_trabalho_4']);      
			$data['dia_trabalho_5']         =   Func::removeCaracters($_POST['dia_trabalho_5']);      
			$data['grupo_nome_1']           =   Func::removeCaracters($_POST['nome_grupo_1']);        
			$data['grupo_nome_2']           =   Func::removeCaracters($_POST['nome_grupo_2']);        
			$data['grupo_nome_3']           =   Func::removeCaracters($_POST['nome_grupo_3']);        
			$data['grupo_nome_4']           =   Func::removeCaracters($_POST['nome_grupo_4']);        
			$data['grupo_nome_5']           =   Func::removeCaracters($_POST['nome_grupo_5']);        
			$data['observacao']             =   Func::removeCaracters($_POST['observacao']);         
			
						
			$data2['justificativa'] = $_POST['justificativa'];
			$data2['data_lancamento'] = $_POST['data'];
			$data2['idpessoa'] = $_POST['pessoa'];
			
			//print_r($data2);
			
			$this->model->create($data, $data2);
			header('location: ' .URL . 'lancamento');
		}
		
		public function update($id) {
			
			$data = array();
			$data['nome'] = Func::removeCaracters($_POST['nome']);			
			$data['cgc'] = $_POST['cgc'];
			$data['endereco'] = Func::removeCaracters($_POST['endereco']);
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
			header('location: ' .URL . 'lancamento/edit/' . $id);
		}
		
		public function edit($id) {				
			$this->view->singleUser = $this->model->singleUser($id);
			$this->Index();					
		}
		
		public function delete($id) {
			$this->model->delete($id);			
		}			
		
		public function xhrGetListings() {
			
			if((int)$_POST['turma'] == 0) {
				exit;
			}
			
			$e = $this->model->existe();
			
			Session::init();
			
			if($e['data_lancamento'] != "" && Session::get('nivel') == 0) {			
				$string = '<button type="button" onClick="checaCampos()" class="btn btn-md btn-primary pull-right">Alterar</button><br /><br />';
				$string .= '<h5 class="text-danger pull-right"><span class="glyphicon glyphicon-info-sign"></span> Já existe um lancamento para esta data em questão</h5>';	
				$string .= '<input type="hidden" name="idlancamento" id="idlancamento" value="'.(int) $e['idlancamento'].'" />';
			} else if($e['data_lancamento'] == "") {			
				$string = '<button type="button" onClick="checaCampos()" class="btn btn-md btn-primary pull-right">Salvar</button>';
				$string .= '<input type="hidden" name="idlancamento" id="idlancamento" value="0" />';
			} else {
				$string = '<h5 class="text-danger pull-right"><span class="glyphicon glyphicon-info-sign"></span> Já existe um lancamento para esta data em questão</h5>';	
				$string .= '<input type="hidden" name="idlancamento" id="idlancamento" value="0" />';
			}
			
			$post['data_lancamento'] =  date("Y-m-d", strtotime(str_replace("/", "-",$_POST['data_lancamento'])));
			
			$data_lancamento = date("d/m/Y", strtotime($post['data_lancamento']));
			$data_lancamento2 = date("d/m/Y", strtotime($post['data_lancamento']));
			$r 	 = $this->model->xhrGetListings();	
			$ano = explode("/", $data_lancamento);
			$restam = 1;
			
			if(isset($_POST['turma'])) {
				$responsavel = $this->model->getResponsavel((int) $_POST['turma']);	
			}
			
			$y = 0;
			$z = 0;
			$frequencia = (int) $_POST['frequencia'];
			
			if($frequencia == 1) {
				$dias = 7;
				$titulo = 'Semanal';
			} else if($frequencia == 2) {
				$dias = 15;
				$titulo = 'Quinzenal';
			} else if($frequencia == 4) {
				$dias = 31;
				$titulo = 'Mensal';
			} 
			
			
			//ESSA VARIAVEL SETE COMO UM, POIS INDEPENDENTE DA DATA DE LANCAMENTO ELE TEM QUE MOSTRAR APENAS O DIA
			$dias = 1;
			$restam = 0;
			
			
			if($responsavel[0]['nome'] != "") {
				$string .= '<h1>Relatório ' . $titulo . '</h1><h4><i><strong>Responsável:</strong> ' .  $responsavel[0]['nome'] . '</i></h4><hr />';
			}
			
			$string .= '<table border="0" cellpadding="15" cellspacing="0"  class="table  table-striped table-hover">';
			$string .= '<thead>';
			$string .= '    <tr>';
			$string .= '      <td><b>Nome</b></td>';
				for($i = 0; $i < $dias; $i++) {
					$y += 1; 
					$string .= '      <td align="center"><b>' . $data_lancamento . '</b></td>';		
					$data_lancamento = date("d/m/Y", strtotime("+".$dias." days",strtotime(str_replace("/", "-",$data_lancamento))));
					
					$ano2 = explode("/", $data_lancamento);
					
					if($ano[1] <> $ano2[1]) {
						$i = $dias;
					}
					
					$restam++;	
					
				}
			$string .= '    </tr>';
			$string .= '  </thead>';
			$string .= '  <tbody>';
				foreach($r as $type) {
					$string .=  '<tr>';					
					$string .=  '<td>' . utf8_encode($type['nome'])  . '</td>';
					$data_lancamento2 = date("d/m/Y", strtotime($post['data_lancamento']));
					for($i = 0; $i < $restam; $i++) {						
						$z += 1;	
						
						if($e['data_lancamento'] != "") {
							
							$re = $this->model->getList((int)$type['id'], (int)$_POST['frequencia'], (int)$_POST['tipo_assistencial'], (int)$_POST['turma'], $e['data_lancamento']);
														
							if($re['presente'] == 1) {
								$botao = 'btn-success';
								$span = 'glyphicon-ok';
								$just = '';
								$readonly = 'readonly';	
							} else {
								$botao = 'btn-danger';
								$span = 'glyphicon-remove';
								$just = strtoupper($re['justificativa']);
								$readonly = '';	
							}
							
						} else {
							$botao = 'btn-success';
							$span = 'glyphicon-ok';
							$just = '';
							$readonly = 'readonly';	
						}
						
						$string .= '      <td align="center"><input type="hidden" name="pessoa[]" value="'.$type['id'].'" />  <input type="hidden" name="data[]" value="'.$data_lancamento2.'" /> <button type="button" id="yz_'.$y.'_'.$z.'" onclick="trocastatus('.$y.','.$z.')" class="btn btn-xs '.$botao.'"><span class="glyphicon '.$span.'"></span></button><input type="text" name="justificativa[]" id="justificativa_'.$y.'_'.$z.'" class="form-control" '.$readonly.' value="'.$just.'" /></td>';		
				
						$data_lancamento2 = date("d/m/Y", strtotime("+".$dias." days",strtotime(str_replace("/", "-",$data_lancamento2))));
					}
					$string .=  '</tr>';
				}				
			$string .= '</tbody>';
			$string .= '</table>';
			
			echo $string;
		
		}
	
}

?>