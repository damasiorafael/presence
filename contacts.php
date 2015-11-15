<?php

header("Content-Type: text/html; charset=utf8",true);
include_once("inc/config.php");
error_reporting(E_ALL);

$destinatarios	= "regina.aranda@unopar.br";

$destinatario 	= utf8_decode("Seminário de Iniciação Científica - Kroton");
$usuario 		= "dev@intrepido53.com.br";
$senha 			= "rafael@2015";

/*abaixo as veriaveis principais, que devem conter em seu formulario*/
$nome 			= protecao(utf8_decode($_REQUEST['nome']));
$email 			= protecao(utf8_decode($_REQUEST['email']));
$mensagem		= protecao(utf8_decode($_REQUEST['mensagem']));

function insereContato($nome, $email, $mensagem){
	$sqlInsereContato = "INSERT INTO contato (nome, email, mensagem, data) VALUES ('$nome', '$email', '$mensagem', NOW());";
	//exit();
	return insert_db($sqlInsereContato);
}

//exit();

/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
include_once("inc/phpmailer/class.phpmailer.php");

$To = $destinatarios;
$Subject = utf8_decode("Contato - Seminário de Iniciação Científica - Kroton");
$bodyMensagem = "";
$bodyMensagem .= "<strong>Nome:</strong> ".$nome." <br />";
$bodyMensagem .= "<strong>E-mail:</strong> $email <br />";
$bodyMensagem .= "<strong>Mensagem:</strong> ".$mensagem." <br />";
$Message = $bodyMensagem;

$Host = "smtp.gmail.com";
$Username = $usuario;
$Password = $senha;
$Port = "587";

$mail = new PHPMailer();
$body = $Message;
//$mail->IsHtml(); // telling the class to use HTML
//$mail->IsSMTP();
$mail->Host = $Host; // SMTP server
$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "tls";	// SSL REQUERIDO pelo GMail
$mail->Port = $Port; // set the SMTP port for the service server
$mail->Username = $Username; // account username
$mail->Password = $Password; // account password

//$mail->Sender='cristina1@unopar.br';
$mail->SetFrom("eac@unopar.br", $destinatario);
$mail->Subject = $Subject;
$mail->MsgHTML($body);
$mail->AddAddress($To, 'Cristina');
$mail->AddBcc('cristina1@unopar.br', 'Cristina'); // Cópia Oculta
$mail->AddBcc('dev@intrepido53.com.br', 'Rafael Damasio'); // Cópia Oculta
$mail->AddBcc('damasio.rafael@gmail.com', 'Rafael Damasio'); // Cópia Oculta
$mail->AddBcc('damasio_damasio@hotmail.com', 'Rafael Damasio'); // Cópia Oculta

//echo $body;

if(insereContato($nome, $email, $mensagem)){
	if(!$mail->Send()) {
		echo 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
	} else {
		echo "sucesso";
	}
}
?>