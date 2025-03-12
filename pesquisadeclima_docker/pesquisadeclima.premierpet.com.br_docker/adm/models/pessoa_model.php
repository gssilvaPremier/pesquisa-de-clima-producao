<?php

class Pessoa_Model extends Model {
	
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
										idtipo_assistencial1,idtipo_assistencial2,idtipo_assistencial3,idtipo_assistencial4,idtipo_assistencial5,
										idtipo_assistencial6,idtipo_assistencial7,idtipo_assistencial8,idtipo_assistencial9, cidade, estado)
								VALUES ((SELECT COALESCE(MAX(id),0)+1 FROM clientes),:nome, :cgc, :endereco, :idprofisssao, :idfrequencia, :idtipo_pessoa, 
										:idturma, :telefone2, :telefone, :email, :curso, :trabalho_rua, :cesta_basica, 
										:dia_trabalho, :data_inicio, :observacao, :motivos, :liberados, :inativo,
										:idtipo_assistencial1,:idtipo_assistencial2,:idtipo_assistencial3,:idtipo_assistencial4,:idtipo_assistencial5,:idtipo_assistencial6,
										:idtipo_assistencial7,:idtipo_assistencial8,:idtipo_assistencial9, :cidade, :estado);');
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
				':idtipo_assistencial7' => $data['idtipo_assistencial7'], 
				':idtipo_assistencial8' => $data['idtipo_assistencial8'], 
				':idtipo_assistencial9' => $data['idtipo_assistencial9'],
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
												   idtipo_assistencial7=:idtipo_assistencial7, idtipo_assistencial8=:idtipo_assistencial8, idtipo_assistencial9=:idtipo_assistencial9,
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
						':idtipo_assistencial7' => $data['idtipo_assistencial7'], 
						':idtipo_assistencial8' => $data['idtipo_assistencial8'], 
						':idtipo_assistencial9' => $data['idtipo_assistencial9'],
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
		header('location: ' .URL . 'pessoa/listar');	
	}
	
	function xhrGetListings ($pagina) {		
		$inicio   = ($pagina - 1) * LIMITE;		
		$condicao = "";
		
		if(strlen($_POST['nome']) > 1) {
			$condicao .= " AND UPPER(c.nome) LIKE '%".strtoupper($_POST['nome']) ."%'";
		}
		
		if($_POST['ativo'] != 2) {
			$condicao .= " AND c.inativo = " . (int)$_POST['ativo'];
		}
		
		if($_POST['turma']) {
			$condicao .= " AND t.id = " . (int)$_POST['turma'];
		}
		
		if($_POST['frequencia']) {
			$condicao .= " AND t.idfrequencia = " . (int)$_POST['frequencia'];
		}
		
		if($_POST['tipo']) {
			$condicao .= " AND c.idtipo_pessoa = " . (int)$_POST['tipo'];
		}
		
		if($_POST['profissao']) {
			$condicao .= " AND c.idprofisssao = " . (int)$_POST['profissao'];
		}
		
		
		$sth = $this->db->prepare('SELECT 
										c.id,
										c.nome,
										c.inativo,
										p.descricao profissao,
										count(*) OVER() total
										FROM clientes c
										LEFT JOIN tipo_assistencial tp ON (tp.id = c.idtipo_assistencial1 OR 
																		   tp.id = c.idtipo_assistencial2 OR 
																		   tp.id = c.idtipo_assistencial3 OR 
																		   tp.id = c.idtipo_assistencial4 OR 
																		   tp.id = c.idtipo_assistencial5 OR 
																		   tp.id = c.idtipo_assistencial6)
										LEFT JOIN turma t ON t.idtipo_assistencial=tp.id
										LEFT JOIN profissao p ON p.id=c.idprofisssao
										WHERE 1=1
										' . $condicao . '
										GROUP BY c.id, c.nome, c.inativo, p.descricao
										ORDER BY c.nome
										LIMIT '. LIMITE . ' OFFSET ' . $inicio);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();		
		return $data;	
	}
	
	
}


?>