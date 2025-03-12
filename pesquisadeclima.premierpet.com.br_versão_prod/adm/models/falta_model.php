<?php

class Falta_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function userList() {
		$sth = $this->db->prepare('SELECT * FROM clientes');
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
	
	function create($data) {
		
		$sth = $this->db->prepare('INSERT INTO clientes(
										id, nome, cgc, endereco, idprofisssao, idfrequencia, idtipo_pessoa, 
										idturma, telefone2, telefone, email, curso, trabalho_rua, cesta_basica, 
										dia_trabalho, data_inicio, observacao, motivos, liberados, inativo,
										idtipo_assistencial1,idtipo_assistencial2,idtipo_assistencial3,idtipo_assistencial4,idtipo_assistencial5,idtipo_assistencial6, cidade, estado)
								VALUES ((SELECT COALESCE(MAX(id),0)+1 FROM clientes),:nome, :cgc, :endereco, :idprofisssao, :idfrequencia, :idtipo_pessoa, 
										:idturma, :telefone2, :telefone, :email, :curso, :trabalho_rua, :cesta_basica, 
										:dia_trabalho, :data_inicio, :observacao, :motivos, :liberados, :inativo,
										:idtipo_assistencial1,:idtipo_assistencial2,:idtipo_assistencial3,:idtipo_assistencial4,:idtipo_assistencial5,:idtipo_assistencial6, :cidade, :estado);');
		$sth->execute(array(
				':nome' => $data['nome'],			
				':cgc' => $data['cgc'], 			
				':endereco' => $data['endereco'],
				':idprofisssao' => $data['idprofissao'], 	
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
				':inativo' => 0,
				':idtipo_assistencial1' => $data['idtipo_assistencial1'], 
				':idtipo_assistencial2' => $data['idtipo_assistencial2'], 
				':idtipo_assistencial3' => $data['idtipo_assistencial3'], 
				':idtipo_assistencial4' => $data['idtipo_assistencial4'], 
				':idtipo_assistencial5' => $data['idtipo_assistencial5'], 
				':idtipo_assistencial6' => $data['idtipo_assistencial6'],
				':cidade' => $data['cidade'], 
				':estado' => $data['estado']  
				));	
						
				//print_r($sth->errorInfo());
				//exit;
	}
	
	function update($data) {
		$sth = $this->db->prepare('UPDATE clientes
											   SET nome=:nome, cgc=:cgc, endereco=:endereco, idprofisssao=:idprofisssao, idfrequencia=:idfrequencia, 
												   idtipo_pessoa=:idtipo_pessoa, idturma=:idturma, telefone2=:telefone2, telefone=:telefone, email=:email, curso=:curso, 
												   trabalho_rua=:trabalho_rua, cesta_basica=:cesta_basica, dia_trabalho=:dia_trabalho, data_inicio=:data_inicio, 
												   observacao=:observacao, motivos=:motivos, liberados=:liberados,
												   idtipo_assistencial1=:idtipo_assistencial1, idtipo_assistencial2=:idtipo_assistencial2, idtipo_assistencial3=:idtipo_assistencial3,
												   idtipo_assistencial4=:idtipo_assistencial4, idtipo_assistencial5=:idtipo_assistencial5, idtipo_assistencial6=:idtipo_assistencial6,
												   cidade=:cidade, estado=:estado
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
						':idtipo_assistencial6' => $data['idtipo_assistencial6'],
						':cidade' => $data['cidade'], 
						':estado' => $data['estado']
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
		header('location: ' .URL . 'falta/listar');	
	}
	
	function impressao() {
		
		Session::init();
		if(Session::get('falta_impressao') != "") {
			$sth = $this->db->prepare(Session::get('falta_impressao'));		
		}
										
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
		
	}
	
	function xhrGetListings ($pagina) {		
		$inicio   = ($pagina - 1) * LIMITE;		
		$condicao = "";
		
		
		if($_POST['turma']) {
			$condicao .= " AND idturma = " . (int)$_POST['turma'];
		}
		
		if($_POST['tipo_pessoa']) {
			$condicao .= " AND idtipo_pessoa = " . (int)$_POST['tipo_pessoa'];
		}
		
		if(strlen($_POST['data_de']) == 10 && strlen($_POST['data_ate']) == 10) {
			$condicao .= " AND (data_lancamento >= '" . date("Y-m-d", strtotime(str_replace("/", "-", $_POST['data_de']))) . "' AND data_lancamento <= '" . date("Y-m-d", strtotime(str_replace("/", "-", $_POST['data_ate']))) . "') ";
		}
		
		
		$sql = "SELECT 	
						nome, tipo_pessoa, observacao, turma, count(1) as faltas, 
						replace(replace(ltrim(rtrim(array_agg(to_char(data_lancamento, 'DD/MM') || ' - ' || justificativa || '<br />')::text, '\"}'), '{\"'), '\"', ''), ',', '') justificativa,
						count(*) OVER() total
						FROM view_faltas
						WHERE 1=1
						" . $condicao;
				
		$sth = $this->db->prepare($sql . " GROUP BY nome, tipo_pessoa, observacao, turma 
										   ORDER BY nome ASC
										   LIMIT ". LIMITE . ' OFFSET ' . $inicio);
		
		Session::init();
		Session::set('falta_impressao', $sql . " GROUP BY nome, tipo_pessoa, observacao, turma ORDER BY nome ASC ");
		Session::set('impressao_de', $_POST['data_de']);
		Session::set('impressao_ate', $_POST['data_ate']);		
										
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	
}


?>