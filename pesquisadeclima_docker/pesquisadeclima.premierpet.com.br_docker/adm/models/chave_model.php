<?php

class Chave_Model extends Model
{

	public $condicao_premier;

	function __construct()
	{
		parent::__construct();
		$this->condicao_premier = NULL;
	}

	function profissaoList()
	{
		/*	$sql = "SELECT
					e.nome as empresa, c.chave, to_char(c.data_geracao, 'DD/MM/YYYY HH24:MI')::varchar(16) as data
					FROM chaves c
					INNER JOIN empresa as e ON e.id=c.idempresa
					WHERE c.valida=1
					ORDER BY e.nome, c.data_geracao ASC;";*/

		$sql = "SELECT
    				e.nome as empresa, c.chave, date_format(c.data_geracao, 'DD/MM/YYYY HH24:MI') as data
    				FROM chaves c
    				INNER JOIN empresa as e ON e.id=c.idempresa
    				WHERE c.valida=1
    				ORDER BY e.nome, c.data_geracao ASC;";

		$sth = $this->db->prepare($sql);
		$sth->execute();

		Session::init();
		Session::set('chave_impressao', $sql);


		return $sth->fetchAll();
	}

	function instanceDB()
	{
		return $this->db;
	}

	function singleProf($id)
	{
		$sth = $this->db->prepare('SELECT id, descricao, ativo FROM profissao WHERE id= :id');
		$sth->execute(array(
			':id' => $id
		));
		return $sth->fetch();
	}

	function getMaxID()
	{
		$sth = $this->db->prepare('SELECT (COALESCE(MAX(id), 0) + 1) id FROM chaves');
		$sth->execute();
		return $sth->fetch();
	}

	function getListMail($idempresa)
	{

		$sth = $this->db->prepare('SELECT
										e.id, e.email
										FROM emails e
										LEFT JOIN ref_email_chave rec ON rec.idemails=e.id
										WHERE idemails is null
										AND idempresa = :idempresa
										LIMIT 1');
		$sth->execute(array(
			':idempresa' => $idempresa
		));

		return $sth->fetch();
	}

	function marcaEmailReenvio($idemails)
	{
		$sth = $this->db->prepare('UPDATE emails SET reenviou = 1 WHERE id = :idemails');
		$sth->execute(array(
			':idemails' => intval($idemails)
		));
	}

	function getMail($idempresa, $email)
	{
		$sth = $this->db->prepare('SELECT
										e.id, e.email
										FROM emails e
										WHERE e.email = :email AND e.idempresa = :idempresa
										LIMIT 1');
		$sth->execute(array(
			':idempresa' => $idempresa,
			':email' => $email,
		));
		return $sth->fetch();
	}



	function getSituacao($idemail)
	{
		$sth = $this->db->prepare("SELECT					
									(CASE WHEN cha.id is null THEN
										'" . CHAVE_NAO_ENVIADA . "'
									ELSE
										CASE WHEN ref.idemails is null THEN
											'" . CHAVE_NAO_ATRELADA_AO_EMAIL . "'
										ELSE
											CASE WHEN e.reenviou = 1 THEN
												CASE WHEN cha.valida = 0 THEN
													'" . CHAVE_REENVIADA_E_JA_UTILIZADA . "'
												ELSE
													'" . CHAVE_REENVIADA_E_NAO_UTILIZADA . "'
												END
											ELSE
												CASE WHEN cha.valida = 0 THEN
													'" . CHAVE_JA_UTILIZADA . "'
												ELSE
													'" . CHAVE_ENVIADA_E_NAO_UTILIZADA . "'
												END
											END
										END
									END) as situacao
									FROM emails e
									INNER JOIN empresa as emp ON emp.id=e.idempresa
									LEFT JOIN ref_email_chave as ref ON ref.idemails=e.id
									LEFT JOIN chaves cha ON cha.id=ref.idchaves
									WHERE e.id = :idemails LIMIT 1 ");
		$sth->execute(array(
			':idemails' => $idemail
		));
		return $sth->fetch();
	}

	function create($data)
	{


		$erro = 0;
		$mensagem = "";

		if ((int)$data['empresa'] != 0) {
			$data_criacao = date('Y-m-d H:i:s');
			$letra = "";
			$tamanho = 7;
			$query = "";
			$qtd = (int) $data['qtd_chaves'];
			$idempresa = (int)$data['empresa'];

			if ($data['empresa'] == '1') {
				$letra = "f";
				$tamanho = 7;
			} else if ($data['empresa'] == '2') {
				$letra = "d";
				$tamanho = 9;
			} else if ($data['empresa'] == '3') {
				$letra = "p";
				$tamanho = 11;
			} else if ($data['empresa'] == '4') {
				$letra = "b";
				$tamanho = 13;
			} else if ($data['empresa'] == '5') {
				$letra = "g";
				$tamanho = 5;
			} else if ($data['empresa'] == '12') {
				$letra = "r";
				$tamanho = 12;
			}


			$r = $this->getMaxID();
			$incremento = $r['id'];




			for ($i = 1; $i <= $qtd; $i++) {

				if ($data['reenviar'] == 1) {

					$email = $this->getMail($data['empresa'], $data['email']);
					$r = $this->getSituacao($email['id']);

					if ($r['situacao'] == CHAVE_REENVIADA_E_JA_UTILIZADA) {
						return array("erro" => 1, "mensagem" => "Essa chave já foi reenviada e já foi utilizada.");
					} elseif ($r['situacao'] == CHAVE_REENVIADA_E_NAO_UTILIZADA) {
						$rEnvioEmail = Func::enviaEmail((int)$email['id'], 'PremierPet', $email['email'], (int)$data['empresa']);

						if ($rEnvioEmail["erro"] == 1) {
							Func::CreateLog($this->db, $data['empresa'],  "ERRO AO REENVIAR EMAIL PARA " . $email['email'] . " - " . $rEnvioEmail["mensagem"]);
							return array("erro" => 1, "mensagem" => "Ocorreu um erro ao reenviar essa chave.");
						} else {
							Func::CreateLog($this->db, $data['empresa'], 'CHAVE REENVIADA PARA ' . $email['email']);
							return array("erro" => 0, "mensagem" => "Chave reenviada com sucesso.");
						}
					} elseif ($r['situacao'] == CHAVE_JA_UTILIZADA) {
						return array("erro" => 1, "mensagem" => "Essa chave já foi utilizada.");
					} elseif ($r['situacao'] == CHAVE_ENVIADA_E_NAO_UTILIZADA) {
						$rEnvioEmail = Func::enviaEmail((int)$email['id'], 'PremierPet', $email['email'], (int)$data['empresa']);

						if ($rEnvioEmail["erro"] == 1) {
							Func::CreateLog($this->db, $data['empresa'],  "ERRO AO REENVIAR EMAIL PARA " . $email['email'] . " - " . $rEnvioEmail["mensagem"]);
							return array("erro" => 1, "mensagem" => "Ocorreu um erro ao reenviar essa chave.");
						} else {
							$this->marcaEmailReenvio((int)$email['id']);
							Func::CreateLog($this->db, $data['empresa'], 'CHAVE REENVIADA PARA ' . $email['email']);
							return array("erro" => 0, "mensagem" => "Chave reenviada com sucesso.");
						}
					}
				} else {

					$email = $this->getListMail($idempresa);
				}



				//	if(count($email) > 0) {

				$hash = Func::geraSenha(($tamanho - strlen($incremento)));
				$chave = $letra . $hash  . $incremento;

				$query  = " INSERT INTO chaves(idempresa, chave, data_geracao) VALUES (" . (int)$data['empresa'] . ", '" . $chave . "', '" . $data_criacao . "'); ";

				if ($data['enviar_email'] == 1) {
					$query .= " INSERT INTO ref_email_chave(idchaves, idemails)VALUES ((SELECT COALESCE(MAX(id), 1) FROM chaves), " . $email['id'] . "); ";
				}

				$executou = $this->db->exec($query);

				if ($executou && $data['enviar_email'] == 1) {

					$rEnvioEmail = Func::enviaEmail((int)$email['id'], 'PremierPet', $email['email'], (int)$data['empresa']);

					if ($rEnvioEmail['erro'] == 1) {

						$erro = 1;
						$mensagem = "ERRO AO ENVIAR CHAVE PARA " . $email['email'];


						Func::CreateLog($this->db, $data['empresa'],  "ERRO AO ENVIAR CHAVE PARA " . $email['email'] . " - " . $rEnvioEmail["mensagem"]);
						$this->db->exec("DELETE FROM ref_email_chave WHERE idemails = " . intval($email['id']) . ";
											 DELETE FROM chaves WHERE chave = '" . $chave . "'; ");
					} else {

						$erro = 0;
						$mensagem = 'CHAVE ' . $chave . ' ENVIADA PARA ' . $email['email'];

						Func::CreateLog($this->db, $data['empresa'], 'CHAVE <b>' . $chave . '</b> ENVIADA PARA ' . $email['email']);
					}
				} else {
					Func::CreateLog($this->db, $data['empresa'], 'CHAVE <b>' . $chave . '</b> GERADA');
				}

				$incremento = $incremento + $i;

				/*	} else {
					$i = $qtd;
				}*/
			}
		}

		if ($data['reenviar'] == 1) {
			return array("erro" => $erro, "mensagem" => $mensagem);
		} else {
			return array("erro" => -1, "mensagem" => "Chaves enviadas com sucesso.");
		}
	}


	function update($data)
	{
		$sth = $this->db->prepare('UPDATE profissao
										  SET descricao=:descricao, ativo=:ativo
										  WHERE id=:id;');
		$sth->execute(array(
			':descricao' => $data['descricao'],
			':ativo' => $data['ativo'],
			':id' => $data['id']
		));
	}

	function impressao()
	{

		Session::init();
		if (Session::get('chave_impressao') != "") {
			$sth = $this->db->prepare(Session::get('chave_impressao'));
		}

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		return $data;
	}

	function emailExists($email, $empresa)
	{

		$sth = $this->db->prepare("SELECT email FROM emails WHERE email ='" . $email . "' AND idempresa=" . intval($empresa) . "; ");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		if (count($data) > 0) {
			return true;
		} else {
			return false;
		}
	}

	function importaemailsgrava()
	{

		Session::init();
		if (Session::get("EMAILS_CSV_QUERY") == "") {
			return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao coletar os e-mails."));
		}

		$executou = $this->db->exec(Session::get("EMAILS_CSV_QUERY"));
		if ($executou) {
			Session::set("EMAILS_CSV_QUERY", "");
			return json_encode(array("erro" => 0, "mensagem" => "Sucesso ao gravar esse e-mails."));
		} else {
			return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro a salvar esses e-mails."));
		}
	}

	function gravamail()
	{

		$mensagem = "";

		$_POST['email'] = strtolower(strtoupper(trim($_POST['email'])));
		$idemail = intval($_POST['idemail']);

		if (intval($_POST['empresa']) == 0 && $idemail == 0) {
			$mensagem .= "Informe a empresa; \n";
		}

		if (!Func::validaEmail($_POST['email'])) {
			$mensagem .= "Informe um e-mail válido. \n";
		}

		if ($mensagem != "") {
			return json_encode(array("erro" => 1, "mensagem" => $mensagem));
		}

		$sth = $this->db->prepare("SELECT email FROM emails WHERE email ='" . $_POST['email'] . "' AND idempresa=" . intval($_POST['empresa']) . " AND id <> " . $idemail . "; ");
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		if (count($data) > 0) {
			return json_encode(array("erro" => 1, "mensagem" => "E-mail já cadastrado."));
		}

		if ($idemail > 0) {
			$query  = " UPDATE emails SET email='" . $_POST['email'] . "' WHERE id=" . $idemail . "; ";
		} else {
			$query  = " INSERT INTO emails(idempresa, email) VALUES (" . intval($_POST['empresa']) . ", '" . $_POST['email'] . "'); ";
		}

		$executou = $this->db->exec($query);

		if ($executou) {
			return json_encode(array("erro" => 0, "mensagem" => "Sucesso ao gravar esse e-mail."));
		} else {
			return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro a salvar esse e-mail."));
		}
	}


	function xhrGetListingsEmails($pagina)
	{
		$inicio   = ($pagina - 1) * LIMITE;
		$condicao = "";

		if ($_POST['empresa'] != "") {
			$condicao .= " AND e.idempresa=" . (int)$_POST['empresa'];
		}

		if (isset($_POST['email_filtro']) && $_POST['email_filtro'] !== "") {
			$condicao .= " AND UPPER(TRIM(e.email)) LIKE '%" . strtoupper(strtolower(trim($_POST['email_filtro']))) . "%' ";
		}

		if (isset($_POST['situacao_filtro']) && intval($_POST['situacao_filtro']) > 1) {
			$situacaoFiltro = intval($_POST['situacao_filtro']);

			if ($situacaoFiltro == 2) { // CHAVE NÃO ENVIADA
				$condicao .= " AND cha.id is null ";
			}

			if ($situacaoFiltro == 3) { // CHAVE NÃO ATRELADA AO E-MAIL
				$condicao .= " AND cha.id is not null AND ref.idemails is null ";
			}

			if ($situacaoFiltro == 4) { // CHAVE REENVIADA E JÁ UTILIZADA
				$condicao .= " AND e.reenviou = 1 AND cha.valida = 0 ";
			}

			if ($situacaoFiltro == 5) { // CHAVE REENVIADA E NÃO UTILIZADA
				$condicao .= " AND e.reenviou = 1 AND cha.valida <> 0 ";
			}

			if ($situacaoFiltro == 6) { // CHAVE JÁ UTILIZADA
				$condicao .= " AND e.reenviou <> 1 AND cha.valida = 0 ";
			}

			if ($situacaoFiltro == 7) { // CHAVE ENVIADA E NÃO UTILIZADA
				$condicao .= " AND e.reenviou <> 1 AND cha.valida <> 0 ";
			}
		}


		$sql = "SELECT
					emp.nome,e.id, e.email, count(1) over() total,
					(CASE WHEN cha.id is null THEN
						'<span class=" . chr(34) . "text-danger" . chr(34) . ">" . CHAVE_NAO_ENVIADA . "</span>'
					ELSE
						CASE WHEN ref.idemails is null THEN
							'<span class=" . chr(34) . "text-warning" . chr(34) . ">" . CHAVE_NAO_ATRELADA_AO_EMAIL . "</span>'
						ELSE
							CASE WHEN e.reenviou = 1 THEN
								CASE WHEN cha.valida = 0 THEN
									'<span class=" . chr(34) . "text-success" . chr(34) . ">" . CHAVE_REENVIADA_E_JA_UTILIZADA . "</span>'
								ELSE
									'<span class=" . chr(34) . "text-warning" . chr(34) . ">" . CHAVE_REENVIADA_E_NAO_UTILIZADA . "</span>'
								END
							ELSE
								CASE WHEN cha.valida = 0 THEN
									'<span class=" . chr(34) . "text-success" . chr(34) . ">" . CHAVE_JA_UTILIZADA . "</span>'
								ELSE
									'<span class=" . chr(34) . "text-warning" . chr(34) . ">" . CHAVE_ENVIADA_E_NAO_UTILIZADA . "</span>'
								END
							END
						END
					END) as status,
					(CASE WHEN cha.id is null THEN
						1
					ELSE
						CASE WHEN ref.idemails is null THEN
							1
						ELSE
							CASE WHEN e.reenviou = 1 THEN
								CASE WHEN cha.valida = 0 THEN
									2
								ELSE
									1
								END
							ELSE
								CASE WHEN cha.valida = 0 THEN
									2
								ELSE
									1
								END
							END
						END
					END) as reenviar
					FROM emails e
					INNER JOIN empresa as emp ON emp.id=e.idempresa
					LEFT JOIN ref_email_chave as ref ON ref.idemails=e.id
					LEFT JOIN chaves cha ON cha.id=ref.idchaves
					WHERE 1=1 " . $condicao . "
					ORDER BY e.idempresa ASC, e.email ASC ";

		$sth = $this->db->prepare($sql . " LIMIT " . LIMITE . " OFFSET " . $inicio);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

	function xhrGetListings($pagina)
	{
		$inicio   = ($pagina - 1) * LIMITE;
		$condicao = "";

		if ($_POST['empresa'] != "") {
			$condicao .= " AND c.idempresa=" . (int)$_POST['empresa'];
		}

		if (isset($_POST['lote']) && $_POST['lote'] !== '0') {
			$condicao .= " AND c.data_geracao = '" . $_POST['lote'] . "'";
		}

		//ATUALIZADO 
		$sql = "SELECT
            e.nome as empresa, 
            c.chave, 
            DATE_FORMAT(c.data_geracao, '%d/%m/%Y %H:%i') as data, 
            count(*) OVER() total
        FROM chaves c
        INNER JOIN empresa as e ON e.id=c.idempresa
        LEFT JOIN ref_email_chave rec ON rec.idchaves=c.id
        WHERE c.valida=1
        AND rec.idchaves is null
        " . $condicao . "
        ORDER BY e.nome, c.data_geracao ASC";


		//COMO ESTAVA COM BUG
		// $sql = "SELECT
		// 				e.nome as empresa, c.chave, date_format(c.data_geracao, 'DD/MM/YYYY HH24:MI') as data, count(*) OVER() total
		// 				FROM chaves c
		// 				INNER JOIN empresa as e ON e.id=c.idempresa
		// 				LEFT JOIN ref_email_chave rec ON rec.idchaves=c.id
		// 				WHERE c.valida=1
		// 				AND rec.idchaves is null
		// 				" . $condicao . "
		// 				ORDER BY e.nome, c.data_geracao ASC ";


		/* PRIMEIRA VERSÃO
		$sql = "SELECT
										e.nome as empresa, c.chave, to_char(c.data_geracao, 'DD/MM/YYYY HH24:MI')::varchar(16) as data,
										count(*) OVER() total
										FROM chaves c
										INNER JOIN empresa as e ON e.id=c.idempresa
										INNER JOIN ref_email_chave rec ON rec.idchaves=c.id
										INNER JOIN emails em ON em.id=rec.idemails
										WHERE c.valida=1
										" . $condicao . "
										ORDER BY e.nome, c.data_geracao ASC";
		*/

		//echo $sql; exit;

		Session::init();
		Session::set('chave_impressao', $sql);

		$sth = $this->db->prepare($sql . " LIMIT " . LIMITE . " OFFSET " . $inicio);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

	function xhrGetList()
	{
		$condicao = '';

		if ($_GET['local'] != "") {
			$condicao = "AND dourado=" . (int)$_GET['local'];
		}

		$sth = $this->db->prepare('SELECT id as codigo, nome FROM premier_setor  WHERE 1=1 ' . $condicao . ' ORDER BY nome;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		return $data;
	}

	function xhrGetLotes()
	{
		$condicao = '';

		if (intval($_GET['idempresa']) != 0) {
			$condicao = "AND idempresa=" . (int)$_GET['idempresa'];
		}

		$sth = $this->db->prepare('SELECT data_geracao as codigo, data_geracao as nome FROM chaves WHERE valida = 1 ' . $condicao . ' GROUP BY data_geracao;');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		return $data;
	}

	function excluirEmail()
	{
		$mensagem = "";

		$_POST['email'] = strtolower(strtoupper(trim($_POST['email'])));
		if (intval($_POST['idempresa']) == 0) {
			$mensagem .= "Informe a empresa; <br />";
		}

		if (!Func::validaEmail($_POST['email'])) {
			$mensagem .= "Informe um e-mail válido; <br />";
		}

		if ($mensagem != "") {
			return json_encode(array("erro" => 1, "mensagem" => $mensagem));
		}

		$sel = " SELECT id FROM emails WHERE idempresa=" . intval($_POST['idempresa']) . " AND email='" . $_POST['email'] . "'; ";

		$sth = $this->db->prepare($sel);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();

		$query  = " DELETE FROM ref_email_chave WHERE idemails=" . intval($data[0]['id']) . "; 
					DELETE FROM emails WHERE id=" . intval($data[0]['id']) . "; ";


		$executou = $this->db->exec($query);

		if ($executou) {
			return json_encode(array("erro" => 0, "mensagem" => "E-mail deletado com sucesso."));
		} else {
			return json_encode(array("erro" => 1, "mensagem" => "Erro ao deletar esse e-mail."));
		}
	}

	function xhrGetListingsRelatorios($empresa)
	{

		$condicao = "";

		if ($_POST['setor'] != "0") {
			$condicao .= " AND fazenda_setor=" . (int)$_POST['setor'];
		}

		if ($_POST['distribuidor_setor'] != "0") {
			$condicao .= " AND distribuidor_setor=" . (int)$_POST['distribuidor_setor'];
		}

		if ($_POST['progato_setor'] != "0") {
			$condicao .= " AND progato_setor=" . (int)$_POST['progato_setor'];
		}

		if ((int)$_POST['setor_premier'] != 0) {
			$condicao .= " AND premier_setor=" . (int)$_POST['setor_premier'];

			$sth = $this->db->prepare('SELECT seguranca_trabalho, ti FROM premier_setor WHERE id = ' . (int)$_POST['setor_premier']);
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();

			$this->condicao_premier = $sth->fetchAll();
		}



		$sql = "SELECT
						campo,
						COALESCE(SUM(CASE WHEN voto = '1' THEN
							1
						END), 0) voto1,
						COALESCE(SUM(CASE WHEN voto = '2' THEN
							1
						END), 0) voto2,
						COALESCE(SUM(CASE WHEN voto = '3' THEN
							1
						END), 0) voto3,
						COALESCE(SUM(CASE WHEN voto = '4' THEN
							1
						END), 0) voto4,
						COALESCE(SUM(CASE WHEN voto = '5' THEN
							1
						END), 0) voto5
						FROM votos
						WHERE (campo NOT LIKE '%justificativa%' AND campo NOT LIKE '%comentario%') AND voto <> ''
						AND idempresa = " . $empresa . "
						" . $condicao . "
						GROUP BY idempresa, campo
						ORDER BY idempresa , campo ASC;";


		//echo $sql; exit;

		//Session::init();
		//Session::set('chave_impressao', $sql);

		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		return $sth->fetchAll();
	}

	function xhrGetListingsExcel($empresa)
	{

		$retorno = array();

		if ($empresa == -1) { //PADRÃO CENSO 2021

			$sth = $this->db->prepare("SELECT
											t.chave,
											CASE WHEN t.local = 'b' then
												'BRASCORP'
											WHEN t.local = 'f' then
												'FAZENDA'
											WHEN t.local = 'p' then
												'PREMIER'
											-- WHEN t.local = 'r' then
											-- 	'PROGATO'
											ELSE
												''
											END as local
										FROM (
										SELECT
											v.chave, SUBSTRING(chave, 2, 1) as local
											FROM votos v	
											WHERE v.idempresa = -1
											GROUP BY v.chave
											) AS t; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
											v.voto,
											v.campo	
											FROM votos v
											WHERE v.chave = '" . $chave . "'
											ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['local'] = utf8_encode($key['local']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				$i++;
			}
		} else if ($empresa == 1) { //PREMIER DOURADO

			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN granfood_setor as fs ON fs.id=v.fazenda_setor
											WHERE v.idempresa = 1
											GROUP BY v.chave, fs.nome
											ORDER BY fs.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
												v.campo,
												(fs.nome) as setor
												FROM votos v
												LEFT JOIN granfood_setor as fs ON fs.id=v.fazenda_setor
												WHERE chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				$i++;
			}
		} else if ($empresa == 2) { //DISTRIBUIDOR

			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											INNER JOIN distribuidor_setor as ds ON ds.id=v.distribuidor_setor
											WHERE left(v.chave, 1) = 'd'
											GROUP BY v.chave, ds.nome
											ORDER BY ds.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
												v.campo,
												(ds.nome) as setor
												FROM votos v
												INNER JOIN distribuidor_setor as ds ON ds.id=v.distribuidor_setor
												WHERE chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				$i++;
			}
		} else if ($empresa == 3) {	 // PREMIER
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa in(3)
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Demais Localidades'
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 4) {	 //BRASCORP
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											WHERE left(v.chave, 1) = 'b'
											GROUP BY v.chave; ");

			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];

				$sth1 = $this->db->prepare("SELECT 
                                            CASE 
                                                WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN v.voto
                                                WHEN v.campo = 'trabalho' AND v.voto = '1' THEN 'Menos de um ano'
                                                WHEN v.campo = 'trabalho' AND v.voto = '2' THEN 'Mais de um ano'
                                                WHEN v.voto = '1' THEN 'Discordo Totalmente'
                                                WHEN v.voto = '2' THEN 'Discordo Parcialmente'
                                                WHEN v.voto = '3' THEN 'Concordo Parcialmente'
                                                WHEN v.voto = '4' THEN 'Concordo Totalmente'
                                                ELSE 'Não Aplicável'
                                            END AS voto,
                                            v.campo
                                        FROM votos v
                                        WHERE chave = :chave
                                        ORDER BY v.id;
                                                ");
				$sth1->bindValue(':chave', $chave, PDO::PARAM_STR);
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				$i++;
			}
		} else if ($empresa == 5) {	 // GRANFOOD
			$sth = $this->db->prepare("SELECT
										v.chave
										FROM votos v
										INNER JOIN granfood_setor as gs ON gs.id=v.granfood_setor
										WHERE left(v.chave, 1) = 'g'
										GROUP BY v.chave, gs.nome
										ORDER BY gs.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												chave,
												campo,
												CASE WHEN voto = '2' THEN
													'NÃO'
												WHEN voto = '1' THEN
													'SIM'
												ELSE
													'NÃO UTILIZO'
												END as voto,
												justificativa
												FROM votos
												WHERE chave = '" . $chave . "'
												ORDER BY chave, campo ASC; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if ($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}

				$i++;
			}
		} else if ($empresa == 6) {	 // PREMIER - ESCRITÓRIO SP
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 6
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Demais Localidades'
												ELSE
													''
												END localidade
												FROM votos v
												INNER JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 7) {	 // PREMIER - CD'S 
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 7
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Demais Localidades'
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 8) { // PREMIER - FABRICA DOURADO
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 8
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Demais Localidades'
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 9) {	 // Esc Rondonopolis
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 9
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Demais Localidades'
												WHEN ps.dourado = 4 THEN
													'Esc. Rondon&oacute;polis'
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 10) {	 // EXTERNOS
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 10
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Externos'
												WHEN ps.dourado = 4 THEN
													'Esc. Rondon&oacute;polis'												
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 11) {	 // fabrica parana
			$sth = $this->db->prepare("SELECT
											v.chave
											FROM votos v
											LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
											WHERE v.idempresa = 11
											GROUP BY v.chave, ps.nome,v.premier_setor
											ORDER BY v.premier_setor, ps.nome; ");
			$sth->setFetchMode(PDO::FETCH_ASSOC);
			$sth->execute();
			$r = $sth->fetchAll();

			$i = 0;
			foreach ($r as $value => $key) {

				$chave = $key['chave'];
				$sth1 = $this->db->prepare("SELECT
												CASE WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN
													v.voto
												WHEN v.campo = 'trabalho' AND v.voto = '1' THEN
													'Menos de um ano'
												WHEN v.campo = 'trabalho' AND v.voto = '2' THEN
													'Mais de um ano'
												WHEN v.voto = '1' THEN
													'Discordo Totalmente'
												WHEN v.voto = '2' THEN
													'Discordo Parcialmente'
												WHEN v.voto = '3' THEN
													'Concordo Parcialmente'
												WHEN v.voto = '4' THEN
													'Concordo Totalmente'
												ELSE
													'Não Aplicável'
												END as voto,
													v.campo,
												(ps.nome) as setor,
												CASE WHEN ps.dourado = 0 THEN
													'Escritório SP'
												WHEN ps.dourado = 1 THEN
													'Fabrica Dourado'
												WHEN ps.dourado = 2 THEN
													'Cd''s Centros de Distribuição'
												WHEN ps.dourado = 3 THEN
													'Externos'
												WHEN ps.dourado = 4 THEN
													'Esc. Rondon&oacute;polis'
												WHEN ps.dourado = 5 THEN
													'F&aacute;brica Paran&aacute;'												
												ELSE
													''
												END localidade
												FROM votos v
												LEFT JOIN premier_setor as ps ON ps.id=v.premier_setor
												WHERE v.chave = '" . $chave . "'
												ORDER BY v.id; ");
				$sth1->setFetchMode(PDO::FETCH_ASSOC);
				$sth1->execute();
				$r1 = $sth1->fetchAll();

				foreach ($r1 as $value1 => $key1) {
					$retorno[$i]['setor'] = utf8_encode($key1['setor']);
					$retorno[$i]['localidade'] = $key1['localidade'];
					$retorno[$i][$key1['campo']] = $key1['voto'];
				}

				/*
				foreach($r1 as $value1 => $key1) {

					$val = str_replace("dourado", "justificativa", $key1['campo']);

					$retorno[$i]['chave'] = utf8_encode($key1['chave']);
					$retorno[$i][$key1['campo']] = $key1['voto'];
					$retorno[$i][$val] = $key1['justificativa'];
					if($key1['campo'] == 'dourado_sugestao') {
						$retorno[$i]['sugestao'] = utf8_encode($key1['justificativa']);
					}
				}
				*/

				$i++;
			}
		} else if ($empresa == 12) {	 //PROGATO
			$sth = $this->db->prepare("SELECT
										v.chave
									FROM votos v
									WHERE left(v.chave, 1) = 'r'
									GROUP BY v.chave;");

		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$r = $sth->fetchAll();

		$i = 0;
		foreach ($r as $key) {
			$chave = $key['chave'];

			// Adicionando o JOIN com a tabela progato_setor para obter setor e localidade
			$sth1 = $this->db->prepare("SELECT 
                                CASE 
                                    WHEN v.campo LIKE '%justificativa%' OR v.campo LIKE '%comentario%' OR v.campo LIKE '%multipla%' THEN v.voto
                                    WHEN v.campo = 'trabalho' AND v.voto = '1' THEN 'Menos de um ano'
                                    WHEN v.campo = 'trabalho' AND v.voto = '2' THEN 'Mais de um ano'
                                    WHEN v.voto = '1' THEN 'Discordo Totalmente'
                                    WHEN v.voto = '2' THEN 'Discordo Parcialmente'
                                    WHEN v.voto = '3' THEN 'Concordo Parcialmente'
                                    WHEN v.voto = '4' THEN 'Concordo Totalmente'
                                    ELSE 'Não Aplicável'
                                END AS voto,
                                v.campo,
                                ps.nome as setor
                            FROM votos v
                            LEFT JOIN progato_setor ps ON v.progato_setor = ps.id
                            WHERE v.chave = :chave
                            ORDER BY v.id;");


			// Atribua o valor da chave corretamente
			$sth1->bindValue(':chave', $chave, PDO::PARAM_STR);
			$sth1->setFetchMode(PDO::FETCH_ASSOC);
			$sth1->execute();
			$r1 = $sth1->fetchAll();

			foreach ($r1 as $key1) {
				$retorno[$i]['setor'] = utf8_encode($key1['setor']);  // Pega o valor do setor da tabela progato_setor
				$retorno[$i]['localidade'] = $key1['localidade'];  // Pega o valor da localidade da tabela progato_setor
				$retorno[$i][$key1['campo']] = $key1['voto'];  // Armazena o campo e o voto
			}

			$i++;
		}

		}
		
		return $retorno;
	}

	function edit($id) {}

	function delete($id)
	{
		$sth = $this->db->prepare('DELETE FROM profissao WHERE id= ' . $id);
		$sth->execute();
		header('location: ' . URL . 'chave');
	}
}
