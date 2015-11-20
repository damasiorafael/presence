<?php
include("inc/config.php");

header('Content-Type: text/html; charset=utf-8');

$id_user      = $_REQUEST['id_user'];
$id_nivel     = $_REQUEST['id_nivel'];

//exit();

if($id_nivel == ""){
    echo "<script type='text/javascript'>alert('Você deve definir um nível de acesso!'); history.back();</script>";
    exit();
}

function chechaUserNivel($id_user){
    $sqlChecaUserNivel       = "SELECT id_user FROM users_niveis WHERE id_user = '$id_user'";
    $resultChecaUserNivel    = consulta_db($sqlChecaUserNivel);
    $numRowsChecaUserNivel   = mysql_num_rows($resultChecaUserNivel);
    if($numRowsChecaUserNivel > 0){
        return false;
    } else {
        return true;
    }
}

function chamaLog(){

    $user  = $_SESSION['username'];
    $item  = "Usuários";
    $acao  = "Altera Nível de Acesso";
    $query = $_SESSION['query'];

    $sqlUser      = "SELECT id FROM users WHERE username = '$user' AND status = '1'";
    $resultConsultaUser = consulta_db($sqlUser);
    $numRowsUser    = mysql_num_rows($resultConsultaUser);
    $consultaUser   = mysql_fetch_object($resultConsultaUser);
    if($numRowsUser > 0){
      $id_usuario = $consultaUser->id;
      geraLogs($id_usuario, $item, $acao, $query);
      unset($_SESSION['query']);
    }
}

function alteraStatus($id_user){
    $sqlUpdate = "UPDATE users SET status=1, data_atualiza=NOW() WHERE id = $id_user";
    if(update_db($sqlUpdate)){
        return true;
    } else {
        return false;
    }
}

function insere($id_user, $id_nivel){
    //echo "entrei na funcao de salvar";
    $sqlInsere = "INSERT INTO users_niveis
    (id_user, id_nivel)
    VALUES
    ('$id_user', '$id_nivel');";
    $_SESSION['query'] = $sqlInsere;
    //exit();
    return insert_db($sqlInsere);
}

function update($id_user, $id_nivel){
    //echo "entrei na funcao de salvar";
    $sqlInsere = "UPDATE users_niveis SET
    id_user = '$id_user', id_nivel = '$id_nivel'
    WHERE id_user = '$id_user'";
    $_SESSION['query'] = $sqlInsere;
    //exit();
    return insert_db($sqlInsere);
}

function enviaEmailUser($id_user){

    $bodyMensagem    = "";
    $sqlChecaUser    = "SELECT * FROM users WHERE id = $id_user";
    $resultChecaUser = consulta_db($sqlChecaUser);
    $consultaChecaUser = mysql_fetch_object($resultChecaUser);

    $bodyMensagem .= "<p>Caro ".$consultaChecaUser->nome.", esta mensagem foi encaminhada automaticamente, por isso não a responda.</p>";
    $bodyMensagem .= "<p>Você foi cadastrado no sistema administrativo do Portal Kroton Stricto Sensu.</p>";
    $bodyMensagem .= "<p>Acesse o endereço <a href='http://www.pgsskroton.com.br/admin' target='_blank'>www.pgsskroton.com.br/admin</a> para ter acesso ao sistema.</p>";
    $bodyMensagem .= "<p>Seu nome de usuário (username) é o seu email: <b>".$consultaChecaUser->username."</b></p>";
    $bodyMensagem .= "<p>Sua senha provisória é <b>Mudar.123</b></p>";
    $bodyMensagem .= "<p>Para sua segurança, logo no primeiro acesso você será solicitado a alterar esta senha, basta preencher os campos escolhendo uma nova senha de sua preferência para poder visualizar o sistema por completo.</p>";

    $destinatarios  = $consultaChecaUser->username;

    $destinatario   = utf8_decode("KROTON - Portal Stricto Sensu");
    $usuario        = "dev@intrepido53.com.br";
    $senha          = "rafael@2015";

    /*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/
    include_once("inc/phpmailer/class.phpmailer.php");

    $To = $destinatarios;
    $Subject = utf8_decode("KROTON - Portal Stricto Sensu - Cadastro de Usuários");
    $Message = $bodyMensagem;

    $Host = "smtp.gmail.com";
    $Username = $usuario;
    $Password = $senha;
    $Port = "587";

    $mail = new PHPMailer();
    $body = $Message;
    //$mail->IsHtml(); // telling the class to use HTML
    $mail->Host = $Host; // SMTP server
    //$mail->SMTPDebug = 1; // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls";  // SSL REQUERIDO pelo GMail
    $mail->Port = $Port; // set the SMTP port for the service server
    $mail->Username = $Username; // account username
    $mail->Password = $Password; // account password

    $mail->SetFrom("noreply@pgsskroton.com.br", $destinatario);
    $mail->Subject = $Subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($To);
    $mail->AddBcc('dev@intrepido53.com.br', 'Rafael Damasio'); // Cópia Oculta

    if(!$mail->Send()){
        return false;
    } else {
        return true;
    }
}
    
    
if(chechaUserNivel($id_user)){
    if(insere($id_user, $id_nivel)){
        alteraStatus($id_user);
        if(enviaEmailUser($id_user)){
            chamaLog();
            echo "<script type='text/javascript'>alert('Operação realizada com sucesso! O usuário receberá um e-mail para efetuar o login pela primeira vez!'); window.location='usuarios.php';</script>";
            exit();
        } else {
            chamaLog();
            echo "<script type='text/javascript'>alert('Operação realizada com sucesso! Envie um e-mail ao destinatário com a senha provisória, Mudar.123 para que ele efetue seu primeiro login!'); window.location='usuarios.php';</script>";
            exit();
        }
    }
} else {
    if(update($id_user, $id_nivel)){
        chamaLog();
        echo "<script type='text/javascript'>alert('Operação realizada com sucesso!'); window.location='usuarios.php';</script>";
        exit();
    }
}

?>