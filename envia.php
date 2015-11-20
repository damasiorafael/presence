<?php

// Passando os dados obtidos pelo formulário para as variáveis abaixo
/*abaixo as veriaveis principais, que devem conter em seu formulario*/
$destinatario = "";

$nome 			= utf8_decode($_REQUEST['nome']);
$email 			= trim($_REQUEST['email']);
$telefone		= utf8_decode($_REQUEST['telefone']);
$empresa		= utf8_decode($_REQUEST['empresa']);
$cidade_estado	= utf8_decode($_REQUEST['cidade_estado']);
$mensagem		= utf8_decode($_REQUEST['mensagem']);

$arquivo   		= $_FILES["arquivo"];

$arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE; 

if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){

	$fp = fopen($_FILES["arquivo"]["tmp_name"],"rb"); 
	$anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); 
	$anexo = base64_encode($anexo); 

	fclose($fp);

	$anexo = chunk_split($anexo); 

}

$tipo			= utf8_decode($_REQUEST['tipo']);

$emaildestinatario = 'presence@presencedesign.com.br'; // Digite seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web 
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
if($tipo == "representantes"){
	$destinatario 	= utf8_decode("Representantes - Contato através do site - Presence Design");
} else if($tipo == "contato"){
	$destinatario 	= utf8_decode("Contato - Contato através do site - Presence Design");
} else {
	$destinatario 	= utf8_decode("Trabalhe Conosco - Contato através do site - Presence Design");
}

$mensagemHTML = '<p>'.$destinatario.'</p>
<p><b>Nome:</b> '.$nome;

if($tipo == "representantes" || $tipo == "contato"){
	$mensagemHTML .= '<p><b>E-mail:</b> '.$email.'
	<p><b>Telefone:</b> '.$telefone.'
	<p><b>Empresa:</b> '.$empresa.'
	<p><b>Cidade / Estado:</b> '.$cidade_estado.'
	<p><b>Mensagem:</b> '.$mensagem.'</p>
	<hr>';
}


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$boundary = strtotime('NOW');

$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\n";
$headers .= "From: $email\r\n"; // remetente
$headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
	$header .= $anexo."\r\n\r\n";
}
$envio = mail($emaildestinatario, $destinatario, $mensagemHTML, $headers); 
 
if($envio){
	if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
		echo "<script type='text/javascript'>alert('Mensagem enviada com sucesso!'); window.location = 'contato.php';</script>";
        exit();
	} else {
		echo "sucesso";// Página que será redirecionada
	}
} else {
	if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){
		echo "<script type='text/javascript'>alert('Erro ao enviar e-mail'); history.back();</script>";
        exit();
	} else {
		echo "Erro";
	}
}

?>
