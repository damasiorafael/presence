<?php
$nome = strip_tags(trim($_POST['first-name']));
$telefone = strip_tags(trim($_POST['phone-contact']));
$emaill = strip_tags(trim($_POST['email-contact']));
$mensagem = strip_tags(trim($_POST['text-contact']));

$conteudo = "$emaill<br><hr><br> $mensagem <br><br>";
$seuemail = "email que os campos serão enviados";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8";
$headers .= "From: $email \r\n";
$assunto = "$nome";

$enviar = mail($seuemail,$assunto, $conteudo, $headers);

if($enviar) {
echo "<script type='text/javascript'> alert('Contato Enviado com Sucesso!'); window.location.href='** LINK PRA REDIRECIONAMENTO**'; </script>";

echo "<script type='text/javascript'> alert('Ocorreu algum erro ao enviar o formul&aacute;rio'); </script>";
}
?>