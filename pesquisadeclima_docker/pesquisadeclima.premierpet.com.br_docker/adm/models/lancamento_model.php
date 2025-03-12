<?php

class Lancamento_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function userList() {
		$sth = $this->db->prepare('SELECT * FROM clientes');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function getResponsavel($idturma) {
		$sth = $this->db->prepare('SELECT 
										c.nome
										FROM turma t
										LEFT JOIN clientes c ON c.id=t.idpessoa_responsavel
										WHERE t.id='. $idturma);
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function instanceDB() {
		return $this->db;	
	}
	
	function singleUser($id) {
		$sth = $this->db->prepare('SELECT * FROM clientes WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function getList($idpessoa, $idfrequencia, $tipo_assistencial, $turma, $data_lancamento) {
		$sth = $this->db->prepare("SELECT 
										lv.presente,
										lv.justificativa
										FROM lancamento l
										INNER JOIN lancamento_voluntarios lv ON lv.idlancamento=l.id
										WHERE lv.idpessoa=:idpessoa AND l.idfrequencia=:idfrequencia AND l.idtipo_assistencial=:idtipo_assistencial AND l.idturma=:idturma AND lv.data_lancamento=:data_lancamento;");
										
		$param = array(
				':idpessoa' => $idpessoa,
				':idfrequencia' => $idfrequencia,
				':idtipo_assistencial' => $tipo_assistencial,
				':idturma' => $turma,
				':data_lancamento' => $data_lancamento
				);								
		$sth->execute($param);
		return $sth->fetch();
	}
	
	function existe(){
		$sth = $this->db->prepare("SELECT 
										lv.idlancamento, lv.data_lancamento 
										FROM lancamento l
										INNER JOIN lancamento_voluntarios lv ON lv.idlancamento=l.id
										WHERE l.idfrequencia=:idfrequencia AND l.idtipo_assistencial=:idtipo_assistencial AND l.idturma=:idturma AND lv.data_lancamento=:data_lancamento
										GROUP BY lv.idlancamento, lv.data_lancamento;");
										
		$param = array(
				':idfrequencia' => (int)$_POST['frequencia'],
				':idtipo_assistencial' => (int)$_POST['tipo_assistencial'],
				':idturma' => (int)$_POST['turma'],
				':data_lancamento' => date("Y-m-d", strtotime(str_replace("/", "-", $_POST['data_lancamento'])))
				);								
				
		$sth->execute($param);
		return $sth->fetch();		
	}
	
	function create($data, $data2) {		
		
		$query = "";
		$data['idfrequencia']			=	($data['idfrequencia']		  != "") ? (int)$data['idfrequencia']		  			   				   : "0";
		$data['idtipo_assistencial']    =   ($data['idtipo_assistencial'] != "") ? (int)$data['idtipo_assistencial']   							   : "0";
		$data['idturma']                =   ($data['idturma']             != "") ? (int)$data['idturma']               							   : "0";
		$data['descricao']			    =   ($data['descricao']			  != "") ? "'" . Func::removeCaracters($data['descricao'])		   . "'"   : "NULL";
		$data['reposicao_nome_1']       =   ($data['reposicao_nome_1']    != "") ? "'" . Func::removeCaracters($data['reposicao_nome_1'])  .  "'"  : "NULL";
		$data['reposicao_nome_2']       =   ($data['reposicao_nome_2']    != "") ? "'" . Func::removeCaracters($data['reposicao_nome_2'])  .  "'"  : "NULL";
		$data['reposicao_nome_3']       =   ($data['reposicao_nome_3']    != "") ? "'" . Func::removeCaracters($data['reposicao_nome_3'])  .  "'"  : "NULL";
		$data['reposicao_nome_4']       =   ($data['reposicao_nome_4']    != "") ? "'" . Func::removeCaracters($data['reposicao_nome_4'])  .  "'"  : "NULL";
		$data['reposicao_nome_5']       =   ($data['reposicao_nome_5']    != "") ? "'" . Func::removeCaracters($data['reposicao_nome_5'])  .  "'"  : "NULL";
		$data['dia_trabalho_1']         =   ($data['dia_trabalho_1']      != "") ? "'" . Func::removeCaracters($data['dia_trabalho_1'])    .  "'"  : "NULL";
		$data['dia_trabalho_2']         =   ($data['dia_trabalho_2']      != "") ? "'" . Func::removeCaracters($data['dia_trabalho_2'])    .  "'"  : "NULL";
		$data['dia_trabalho_3']         =   ($data['dia_trabalho_3']      != "") ? "'" . Func::removeCaracters($data['dia_trabalho_3'])    .  "'"  : "NULL";
		$data['dia_trabalho_4']         =   ($data['dia_trabalho_4']      != "") ? "'" . Func::removeCaracters($data['dia_trabalho_4'])    .  "'"  : "NULL";
		$data['dia_trabalho_5']         =   ($data['dia_trabalho_5']      != "") ? "'" . Func::removeCaracters($data['dia_trabalho_5'])    .  "'"  : "NULL";
		$data['grupo_nome_1']           =   ($data['grupo_nome_1']        != "") ? "'" . Func::removeCaracters($data['grupo_nome_1'])      .  "'"  : "NULL";
		$data['grupo_nome_2']           =   ($data['grupo_nome_2']        != "") ? "'" . Func::removeCaracters($data['grupo_nome_2'])      .  "'"  : "NULL";
		$data['grupo_nome_3']           =   ($data['grupo_nome_3']        != "") ? "'" . Func::removeCaracters($data['grupo_nome_3'])      .  "'"  : "NULL";
		$data['grupo_nome_4']           =   ($data['grupo_nome_4']        != "") ? "'" . Func::removeCaracters($data['grupo_nome_4'])      .  "'"  : "NULL";
		$data['grupo_nome_5']           =   ($data['grupo_nome_5']        != "") ? "'" . Func::removeCaracters($data['grupo_nome_5'])      .  "'"  : "NULL";
		$data['observacao']             =   ($data['observacao']          != "") ? "'" . Func::removeCaracters($data['observacao'])        .  "'"  : "NULL";
		

		
		if($data['idlancamento'] == 0) {		
		$query = 'INSERT INTO lancamento(idfrequencia, idtipo_assistencial, idturma, descricao, reposicao_nome_1, 
															reposicao_nome_2, reposicao_nome_3, reposicao_nome_4, reposicao_nome_5, 
															dia_trabalho_1, dia_trabalho_2, dia_trabalho_3, dia_trabalho_4, 
															dia_trabalho_5, grupo_nome_1, grupo_nome_2, grupo_nome_3, grupo_nome_4, 
															grupo_nome_5, observacao)
													VALUES (' . $data['idfrequencia']		.',' . $data['idtipo_assistencial'].',' . $data['idturma']            .',' . $data['descricao']			.',' . $data['reposicao_nome_1']   .',' . $data['reposicao_nome_2']   .',' . $data['reposicao_nome_3']   .',' . $data['reposicao_nome_4']   .',' . $data['reposicao_nome_5']   .',' . $data['dia_trabalho_1']     .',' . $data['dia_trabalho_2']     .',' . $data['dia_trabalho_3']     .',' . $data['dia_trabalho_4']     .',' . $data['dia_trabalho_5']     .',' . $data['grupo_nome_1']       .',' . $data['grupo_nome_2']       .',' . $data['grupo_nome_3']       .',' . $data['grupo_nome_4']       .',' . $data['grupo_nome_5']       .',' . $data['observacao']         .'); ';
		
		$valor_lancamento = "(SELECT COALESCE(MAX(id),1) FROM lancamento)";													
		
		} else {
			$query = "DELETE FROM lancamento_voluntarios WHERE idlancamento = " . (int) $data['idlancamento'] . "; ";
			$valor_lancamento = (int) $data['idlancamento'];
		}
			
						
		if(count($data2['justificativa']) > 0) {
			$query .= "INSERT INTO lancamento_voluntarios(idlancamento, idpessoa, data_lancamento, presente, justificativa) VALUES ";
		}
					
		for($i = 0; $i < count($data2['justificativa']); $i++){		
			
			$idpessoa      = $data2['idpessoa'][$i];
			$data_lanca    = "'" . date("Y-m-d", strtotime(str_replace("/", "-", $data2['data_lancamento'][$i]))) . "'";
							
			if($data2['justificativa'][$i] != "") {				
				$justificativa = "'" . $data2['justificativa'][$i] . "'";					
				$presente 	   = 0;			 
			} else {
				$justificativa = "NULL";					
				$presente 	   = 1;	
			}
			
			$query .= " (".$valor_lancamento.", ".$idpessoa.", ".$data_lanca.", ".$presente.", ".$justificativa."),";
		}
		
		$query = substr($query, 0, -1) . ';';			
		
		//echo $query; exit;
		$this->db->exec($query);	
		
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE clientes
											   SET nome=:nome, cgc=:cgc, endereco=:endereco, idprofisssao=:idprofisssao, idfrequencia=:idfrequencia, 
												   idtipo_pessoa=:idtipo_pessoa, idturma=:idturma, telefone2=:telefone2, telefone=:telefone, email=:email, curso=:curso, 
												   trabalho_rua=:trabalho_rua, cesta_basica=:cesta_basica, dia_trabalho=:dia_trabalho, data_inicio=:data_inicio, 
												   observacao=:observacao, motivos=:motivos, liberados=:liberados,
												   idtipo_assistencial1=:idtipo_assistencial1, idtipo_assistencial2=:idtipo_assistencial2, idtipo_assistencial3=:idtipo_assistencial3,
												   idtipo_assistencial4=:idtipo_assistencial4, idtipo_assistencial5=:idtipo_assistencial5, idtipo_assistencial6=:idtipo_assistencial6
											 WHERE id=:id;');			
			$sth->execute(array(
						':nome' => $data['nome'],		
						':cgc' => $data['cgc'],			
						':endereco' => $data['endereco'],
						':idprofisssao' => $data['idprofisssao'],
						':idfrequencia' => $data['idfrequencia'],	
						':idtipo_pessoa' => $data['idtipo_pessoa'],
						':idturma' => $data['idturma'],
						':telefone2' => $data['telefone2'], 		
						':telefone' => $data['telefone'],
						':email' => $data['email'],		
						':curso' => $data['curso'], 			
						':trabalho_rua' => $data['trabalho_rua'],
						':cesta_basica' => $data['cesta_basica'], 	
						':dia_trabalho' => $data['dia_trabalho'], 	
						':data_inicio' => $data['data_inicio'],
						':observacao' => $data['observacao'],
						':motivos' => $data['motivos'],	
						':liberados' => $data['liberados'],
						':id' => $data['id'],
						':idtipo_assistencial1' => $data['idtipo_assistencial1'], 
						':idtipo_assistencial2' => $data['idtipo_assistencial2'], 
						':idtipo_assistencial3' => $data['idtipo_assistencial3'], 
						':idtipo_assistencial4' => $data['idtipo_assistencial4'], 
						':idtipo_assistencial5' => $data['idtipo_assistencial5'], 
						':idtipo_assistencial6' => $data['idtipo_assistencial6']
						));			
	}
	
	function edit($id) {
		$sth = $this->db->prepare('SELECT * FROM clientes WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();
	}
	
	function delete($id) {
		$sth = $this->db->prepare('DELETE FROM clientes WHERE id= ' . $id);
		$sth->execute();
		header('location: ' .URL . 'lancamento/listar');	
	}
	
	function xhrGetListings () {			
		$sth = $this->db->prepare('SELECT id, nome FROM clientes WHERE idtipo_assistencial'.(int)$_POST['tipo_assistencial'].' = '.(int)$_POST['turma'].' ORDER BY nome ASC;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	
}


?>