<?
require "phpmailer/class.phpmailer.php";

class Conexao extends Banco {
	
	private $banco;
	private $conn;
		
	function __construct($banco) {
		$this->banco = $banco;
		
	}
	
	
	function open() {	
	    
      $conn = mysqli_connect('127.0.0.1',$this->banco->getUser(),$this->banco->getSenha(),$this->banco->getBase());
     
        
        // Check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }
        
        mysqli_set_charset( $conn, 'utf8'); 
		
		
	   $this->conn = $conn;
	
	
	}
	
	function close() {
		mysqli_close($this->conn);
	}
	
	function query($sql) {
	  
		$this->open();
		  
		$query = mysqli_query($this->conn, $sql);
		
		$this->close();
		
		if($query) {
			return true;	
		}else {			
			$erro = mysqli_connect_error();
			
			if($erro != "") {
				enviaEmailErro($sql, $erro);					
			}
			return false;		
		}		
		
	}
	
	
	function linhas($sql) {
		$this->open();
		$query = mysqli_query($this->conn, $sql);		
		$l     = pg_num_rows($query);
		
		$this->close();		
		return $l;
	}
	
	function sel($sql) {
	    	  
		$this->open();
	
		$val = array();
		$query = mysqli_query($this->conn, $sql);
	
	
		if(!$query) {
			$erro = mysqli_connect_error();
			if($erro != "") {
				enviaEmailErro($sql, $erro);	
			}
		}
		
		$i = 0;
		while($r 	   = mysqli_fetch_array($query)) {
			$val[$i] = $r;	
			$i++;
		}
		
		$this->close();		
		return $val;
	}
	
}

function montaDelete($tabela, $condicao) {
		
	if($condicao == '') {
		$condicao = '';
	} else {
		$condicao = ' WHERE ' . $condicao; 
	}
			
	return 'DELETE FROM ' . (string) $tabela . ' ' . $condicao;			
}

function montaQuery($array, $condicao, $insert = true) {
	
	$campo   = "";
	$valor   = "";	
	$retorno = "";
	
	for ($i = 0; $i < count($array[0]); $i++) {
		if($insert) {
			$campo .= $array[0][$i] . ",";
			
			$v = gettype($array[1][$i]);
			if($v == "string"){
				$v = "'" . $array[1][$i] . "'";
			} else {
				$v = $array[1][$i];	
			}
			
			$valor .=  $v. ",";	
		} else {
			
			$v = gettype($array[1][$i]);
			if($v == "string"){
				$v = "'" . $array[1][$i] . "'";
			} else {
				$v = $array[1][$i];	
			}
			
			
			$campo .= $array[0][$i] . " = " . $v .  ",";
		}
	}	
	
	$campo = substr($campo, 0, -1);
	$valor = substr($valor, 0, -1);
	
	
	if($insert) {
		$retorno = 'INSERT INTO ' . (string) $array[2] . ' (' . $campo . ') VALUES (' . $valor . ');';	
	} else {
	
		if($condicao == '') {
			$condicao = '';
		} else {
			$condicao = ' WHERE ' . $condicao; 
		}
				
		$retorno = 'UPDATE ' . (string) $array[2] . ' SET ' . $campo . ' ' . $condicao;					
	}
	
	return $retorno;
	
}	


function enviaEmailErro($sql, $erro) {
	$mail = new PHPMailer;
	$mail->IsSMTP();        		// Ativar SMTP
	$mail->SMTPDebug = true;       // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;     	// Autenticação ativada
	$mail->SMTPSecure = 'tls'; 		// SSL REQUERIDO pelo GMail
	$mail->Host = 'sharedrelay-cluster.mandic.net.br'; // SMTP utilizado
	$mail->Port = 587;
	$mail->FromName = 'SAC';
	$mail->From     = 'grandfood@shared.mandic.net.br'; //email
	$mail->Username = 'grandfood@shared.mandic.net.br'; // usuario
	$mail->Password = 'Grand@2019#'; 			// SENHA DO USUÁRIO

	$nomedestinatario  = "Thais";
	$emaildestinatario = "tcampos@premierpet.com.br";
	
	$html  = "<b>NOME EMPRESA:</b> PremieR Pet<br /> <b>SERVIDOR: </b>" . strtoupper($_SERVER['SERVER_NAME']);
	//$html .= "<hr color='#ebebeb'><b>EMAIL-LOGIN:</b> ".$_SESSION[email]." <br /><b>SENHA:</b> ".$_SESSION[senha];
	$html .= "<hr color='#ebebeb'><b>SQL</b><br />" . $sql . "<hr color='#ebebeb'><b>DESCRIÇÃO DO ERRO:</b><br />" . $erro;
	
	$mail->CharSet = "UTF-8";
	$mail->addAddress($emaildestinatario, $nomedestinatario);
	$mail->Subject = "Erro SQL Sistema PremieR Pet Pesquisa de Clima";
	$mail->msgHTML($html);
	if ($mail->send()) {
		return true;
	} else {
		return false;
	}
}
