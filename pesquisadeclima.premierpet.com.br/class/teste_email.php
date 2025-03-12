<?
session_start();
require "phpmailer/class.phpmailer.php";

enviaEmail("Você recebeu uma nova interação no chamado", "Mensagem de teste <hr />",  'Elton', 'elton@tnsistemas.com.br');

function enviaEmail($assunto, $mensagem, $nomedestinatario, $emaildestinatario) {
	$mail = new PHPMailer;
	$mail->IsSMTP();        							// Ativar SMTP
	$mail->SMTPDebug = 1;       						// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = $_SESSION[smtp_autenticacao];     // Autenticação ativada
	$mail->SMTPSecure = $_SESSION[smtp_secure]; 		// SSL REQUERIDO pelo GMail
	$mail->Host = $_SESSION[smtp_host]; 				// SMTP utilizado
	$mail->Port = $_SESSION[smtp_porta];
	$mail->FromName = $_SESSION[smtp_fromname];
	$mail->From     = $_SESSION[smtp_fromemail]; 		// Email
	$mail->Username = $_SESSION[smtp_username]; 		// Usuario
	$mail->Password = $_SESSION[smtp_password]; 		// SENHA DO USUÁRIO
	
	$mail->addAddress($emaildestinatario, $nomedestinatario);
	$mail->Subject = ($assunto);
	$mail->msgHTML($mensagem);
	$mail->CharSet = "UTF-8";
	if ($mail->send()) {
		return true;
	} else {
		return false;
	}
}