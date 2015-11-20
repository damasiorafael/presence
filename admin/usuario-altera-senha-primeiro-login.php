<?php
  include_once("inc/config.php");
  if((isset($_SESSION['username']) == true)){
    header('Content-Type: text/html; charset=utf-8');

    $senha    = $_REQUEST['nova_senha'];
    $username = $_SESSION['username'];

    if($senha != ""){
      function chamaLog(){
        $user  = $_SESSION['username'];
        $item  = "Usuários";
        $acao  = "Primeiro Login";
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

      function update($id, $senha){
          //echo "entrei na funcao de salvar";
          $sqlInsere = "UPDATE users SET senha='".SHA1($senha)."', data_ultimo_login = NOW() WHERE id = $id";
          //exit();
          $_SESSION['query'] = $sqlInsere;
          //exit();
          return update_db($sqlInsere);
      }

      function selecionaIdUser($username, $senha){
        $sqlUser      = "SELECT id FROM users WHERE username = '$username' AND status = '1'";
        $resultConsultaUser = consulta_db($sqlUser);
        $consultaUser   = mysql_fetch_object($resultConsultaUser);
        $id = $consultaUser->id;
        if(update($id, $senha)){
          return true;
        } else {
          return false;
        }
      }

      if(selecionaIdUser($username, $senha)){

        $sqlNivel      = "SELECT id FROM users WHERE username = '$username' AND status = '1'";
        $resultNivel   = consulta_db($sqlNivel);
        $consultaNivel = mysql_fetch_object($resultNivel);
        $id = $consultaNivel->id;

        $sqlChamaNivel = "SELECT nome FROM niveis LEFT JOIN `users_niveis` ON `users_niveis`.id_nivel = `niveis`.id WHERE `users_niveis`.id_user = $id";
        $resultChamaNivel   = consulta_db($sqlChamaNivel);
        $consultaChamaNivel = mysql_fetch_object($resultChamaNivel);

        $_SESSION['nivel_acesso'] = $consultaChamaNivel->nome;
        //exit();

        chamaLog();
        echo "<script type='text/javascript'>alert('Operação realizada com sucesso!'); window.location = 'index.php'</script>";
        //header('Location: index.php');
        exit();
      }
    }

  } else {
    header('Location: login.php');
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Kroton - Portal Stricto Sensu - Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Icones mobiles -->
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
      /* LOGIN */
      .div-author {
        width: 100%;
        padding-top: 10px;
      }

      .div-author p {
        text-align: center;
      }
      /* LOGIN */
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index2.html">
          <img src="img/logo_topo.png" />
        </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Altere sua senha</p>
        <form action="usuario-altera-senha-primeiro-login.php" method="post" validate>
          <div class="form-group has-feedback">
            <input type="password" id="nova_senha" name="nova_senha" class="form-control" placeholder="Nova senha" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" placeholder="Confirmar Senha" required oninput="validaSenha(this)" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Alterar</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
      <div class="div-author">
        <p>
          Desenvolvido por 
          <a href="http://intrepido53.com.br/" target="_blank">
            <img src="img/logo_intrepido_login.png" alt="Intrépido 53">
          </a>
        </p>
      </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      function validaSenha(input){ 
          if(input.value != document.getElementById('nova_senha').value) {
          input.setCustomValidity('Repita a senha corretamente');
        } else {
          input.setCustomValidity('');
        }
      } 
    </script>
  </body>
</html>