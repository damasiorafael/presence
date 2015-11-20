<?php

header("Content-Type: text/html; charset=utf8",true);
include_once("inc/config.php");
error_reporting(E_WARNING);

date_default_timezone_set("Brazil/East");

/*$destinatarios	= "presence@presencedesign.com.br";
$destinatario 	= "";
$usuario 		= "contato@presencedesign.com.br";
$senha 			= "85602434.dam";*/

/*abaixo as veriaveis principais, que devem conter em seu formulario*/
$nome 			= utf8_decode($_REQUEST['nome']);
$email 			= utf8_decode($_REQUEST['email']);
$telefone		= utf8_decode($_REQUEST['telefone']);
$empresa		= utf8_decode($_REQUEST['empresa']);
$cidade_estado	= utf8_decode($_REQUEST['cidade_estado']);
$mensagem		= utf8_decode($_REQUEST['mensagem']);

$arquivo   		= $_FILES["arquivo"];

$today 			= date("Y-m-d H:i:s");

$tipo			= utf8_decode($_REQUEST['tipo']);

/*if($tipo == "representantes"){
	$destinatario 	= utf8_decode("Representantes - Contato através do site - Presence Design");
} else if($tipo == "contato"){
	$destinatario 	= utf8_decode("Contato - Contato através do site - Presence Design");
} else {
	$destinatario 	= utf8_decode("Trabalhe Conosco - Contato através do site - Presence Design");
}*/

function insereContato($nome, $email, $telefone, $empresa, $cidade_estado, $mensagem, $today){
	$sqlInsereContato = "INSERT INTO contato (nome, email, telefone, empresa, cidade_estado, mensagem, data) VALUES ('$nome', '$email', '$telefone', '$empresa', '$cidade_estado', '$mensagem', '$today');";
	//exit();
	return insert_db($sqlInsereContato);
}

function insereRepresentantes($nome, $email, $telefone, $empresa, $cidade_estado, $mensagem, $today){
	$sqlInsereContato = "INSERT INTO representantes (nome, email, telefone, empresa, cidade_estado, mensagem, data) VALUES ('$nome', '$email', '$telefone', '$empresa', '$cidade_estado', '$mensagem', '$today');";
	//exit();
	return insert_db($sqlInsereContato);
}

function insereTrabalhe($nome, $nome_atual, $today){
	$sqlInsereContato = "INSERT INTO trabalhe (nome, arquivo, data) VALUES ('$nome', '$nome_atual', '$today');";
	//exit();
	return insert_db($sqlInsereContato);
}

function upload($nome, $arquivo, $today){
	$pasta = "uploads/";

    /* formatos de imagem permitidos */
    $permitidos = array(".pdf", ".doc", ".docx");
    
    //FAZ O UPLOAD DAS IMAGENS ENQUANTO EXISTIREM
    $nome_arquivo    = $arquivo['name'];
    $tamanho_arquivo = $arquivo['size'];
        
    /* pega a extensão do arquivo */
    $ext = strtolower(strrchr($nome_arquivo,"."));

    /* converte o tamanho para KB */
    $tamanho = round($tamanho_arquivo / 1024);
        
    /*  verifica se a extensão está entre as extensões permitidas */
    if(in_array($ext,$permitidos)){
        //testa o tamanho em pixels da imagem
        if($tamanho < 4096){ //se imagem for até 4MB envia
            $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
            $tmp = $arquivo['tmp_name']; //caminho temporário da imagem

            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
            //if($s3->putObjectFile($tmp, $bucket , $nome_atual, S3::ACL_PUBLIC_READ)){
                //ACAO PARA SALVAR NO BANCO
                if(insereTrabalhe($nome, $nome_atual, $today)){
                    echo "<script type='text/javascript'>alert('Mensagem enviada com sucesso!'); window.location = 'contato.php';</script>";
                    exit();
                } else {
                	echo "<script type='text/javascript'>alert('Erro ao enviar a mensagem, por favor tente novamente!'); history.back();</script>";
                    exit();
                }
            } else {
            	echo "<script type='text/javascript'>alert('Erro ao enviar a mensagem, por favor tente novamente!'); history.back();</script>";
                exit();
            }
        }
    }
}

//exit();

/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
/*include_once("inc/phpmailer/class.phpmailer.php");

$To = $destinatarios;
if($tipo == "representantes"){
	$Subject = utf8_decode("Representantes - Contato através do site - Presence Design");
} else if($tipo == "contato"){
	$Subject = utf8_decode("Contato - Contato através do site - Presence Design");
} else {
	$Subject = utf8_decode("Trabalhe Conosco - Contato através do site - Presence Design");
}

$bodyMensagem = "";
$bodyMensagem .= "<strong>Nome:</strong> ".$nome." <br />";

if($tipo == "representantes" || $tipo == "contato"){
	$bodyMensagem .= "<strong>E-mail:</strong> $email <br />";
	$bodyMensagem .= "<strong>Telefone:</strong> $telefone <br />";
	$bodyMensagem .= "<strong>Empresa:</strong> $empresa <br />";
	$bodyMensagem .= "<strong>Cidade/Estado:</strong> $cidade_estado <br />";
	$bodyMensagem .= "<strong>Mensagem:</strong> ".$mensagem." <br />";
}

$Message = $bodyMensagem;

$Host = "smtp.presencedesign.com.br";
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
//$mail->SMTPAuth = true; // enable SMTP authentication
//$mail->SMTPSecure = "tls";	// SSL REQUERIDO pelo GMail
$mail->Port = $Port; // set the SMTP port for the service server
$mail->Username = $Username; // account username
$mail->Password = $Password; // account password

$mail->SetFrom("presencedesign@presencedesign.br", $destinatario);
$mail->Subject = $Subject;
$mail->MsgHTML($body);

if($tipo != "representantes" && $tipo != "contato"){
	$mail->AddAttachment($arquivo['tmp_name'], $arquivo['name'] );
}

$mail->AddAddress($To, 'Contato - Presence Design');
$mail->AddBcc('damasio.rafael@gmail.com', 'Rafael Damasio'); // Cópia Oculta
$mail->AddBcc('damasio_damasio@hotmail.com', 'Rafael Damasio'); // Cópia Oculta

//echo $body;*/

//if(insereContato($nome, $email, $mensagem)){
if($tipo == "contato"){
	if(insereContato($nome, $email, $telefone, $empresa, $cidade_estado, $mensagem, $today)){
		//if(!$mail->Send()) {
			//echo 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
		//} else {
			echo "sucesso";
		//}
	}
} else if($tipo == "representantes"){
	if(insereRepresentantes($nome, $email, $telefone, $empresa, $cidade_estado, $mensagem, $today)){
		//if(!$mail->Send()) {
			//echo 'Erro ao enviar e-mail: '. print($mail->ErrorInfo);
		//} else {
			echo "sucesso";
		//}
	}
} else {
	upload($nome, $arquivo, $today);
}
?>