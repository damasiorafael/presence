<?php
    include("inc/config.php");

    header('Content-Type: text/html; charset=utf-8');

    $nome         = protecao($_REQUEST['nome']);
    $username     = protecao($_REQUEST['username']);
    $imagem       = $_FILES['imagem'];
    $senha        = SHA1("Mudar.123");
    $hash         = SHA1($nome.$username.$datetime);
    $datetime     = date('Y-m-d H:i:s');

    //print_r($imagem);

    $_SESSION['nome']       = $nome;
    $_SESSION['username_cadastra']   = $username;

    function chechaUser($username){
        $sqlChecaUser       = "SELECT id FROM users WHERE username = '$username'";
        $resultChecaUser    = consulta_db($sqlChecaUser);
        $numRowsChecaUser   = mysql_num_rows($resultChecaUser);
        if($numRowsChecaUser > 0){
            return false;
        } else {
            return true;
        }
    }
    
    function chamaLog(){

        $user  = $_SESSION['username'];
        $item  = "Usuários";
        $acao  = "Adicionar";
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

    //exit();
    
    function insere($nome, $username, $senha, $hash, $datetime, $nome_atual){
        //echo "entrei na funcao de salvar";
        $sqlInsere = "INSERT INTO users
        (nome, username, imagem, senha, hash, data, status)
        VALUES
        ('$nome', '$username', '$nome_atual', '$senha', '$hash', '$datetime', 0);";
        $_SESSION['query'] = $sqlInsere;
        //exit();
        return insert_db($sqlInsere);
    }

    function insereSemImagem($nome, $username, $senha, $hash, $datetime){
        //echo "entrei na funcao de salvar";
        $sqlInsere = "INSERT INTO users
        (nome, username, data, senha, hash, status)
        VALUES
        ('$nome', '$username', '$datetime', '$senha', '$hash', 0);";
        $_SESSION['query'] = $sqlInsere;
        //exit();
        return insert_db($sqlInsere);
    }

    function limpaSessionsFormulario(){
        if(isset($_SESSION['nome'])) unset($_SESSION['nome']);
        if(isset($_SESSION['username_cadastra'])) unset($_SESSION['username_cadastra']);
        return true;
    }
    
    function uploadImg($nome, $username, $senha, $hash, $datetime, $imagem){

        $bucket="pgsskroton-uploads";

        include("inc/aws/s3_config.php");

        $pasta = "../uploads/";
    
        /* formatos de imagem permitidos */
        $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
        
        //FAZ O UPLOAD DAS IMAGENS ENQUANTO EXISTIREM
        $nome_imagem    = $imagem['name'];
        $tamanho_imagem = $imagem['size'];
            
        /* pega a extensão do arquivo */
        $ext = strtolower(strrchr($nome_imagem,"."));

        /* chega dimensoes da imagem */
        list($largura, $altura) = getimagesize($imagem['tmp_name']);

        /* converte o tamanho para KB */
        $tamanho = round($tamanho_imagem / 1024);
            
        /*  verifica se a extensão está entre as extensões permitidas */
        if(in_array($ext,$permitidos)){
            if($largura <= 248){
                //testa o tamanho em pixels da imagem
                if($tamanho < 512){ //se imagem for até 500KB envia
                    $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                    $tmp = $imagem['tmp_name']; //caminho temporário da imagem

                    //if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                    if($s3->putObjectFile($tmp, $bucket , $nome_atual, S3::ACL_PUBLIC_READ)){
                        //ACAO PARA SALVAR NO BANCO
                        if(insere($nome, $username, $senha, $hash, $datetime, $nome_atual)){
                            if(limpaSessionsFormulario()){
                                chamaLog();
                                echo "<script type='text/javascript'>alert('Operação realizada com sucesso! Você deve associar um nível para o usuário cadastrado!'); window.location = 'usuarios.php';</script>";
                                exit();
                            }
                        }
                    } else {
                        //Falha no UPLOAD;
                        echo "<script type='text/javascript'>alert('Falha ao salvar!'); history.back();</script>";
                        exit();
                    }
                } else {
                    //Falha no tamanho da imagem em pixels
                    echo "<script type='text/javascript'>alert('A imagem deve ser de no máximo 500KB!'); history.back();</script>";
                    exit();
                }
            } else {
                echo "<script type='text/javascript'>alert('A deve ter no máximo 248 pixels de largura!'); history.back();</script>";
                exit();
            }
        } /*else {
            //echo "Somente são aceitos arquivos do tipo Imagem";
            echo "<script type='text/javascript'>alert('Somente são aceitos arquivos do tipo Imagem!'); //history.back();</script>";
            */
        //echo "<script type='text/javascript'>alert('Operação realizada com sucesso!'); window.location = 'programas-add.php';</script>";
        exit();
    }
    
    if(isset($imagem) && $imagem["name"] != ""){
        if(chechaUser($username)){
            uploadImg($nome, $username, $senha, $hash, $datetime, $imagem);
        } else {
            echo "<script type='text/javascript'>alert('Já existe um usuário com esse e-mail cadastrado! Por favor, verifique.'); history.back();</script>";
            exit();
        }
    } else {
        if(chechaUser($username)){
            if(insereSemImagem($nome, $username, $senha, $hash, $datetime)){
                if(limpaSessionsFormulario()){
                    chamaLog();
                    echo "<script type='text/javascript'>alert('Operação realizada com sucesso! Você deve associar um nível para o usuário cadastrado!'); window.location = 'usuarios.php';</script>";
                    exit();
                }
            }
        } else {
            echo "<script type='text/javascript'>alert('Já existe um usuário com esse e-mail cadastrado! Por favor, verifique.'); history.back();</script>";
            exit();
        }
    }
?>