<?php
    include("inc/config.php");

    header('Content-Type: text/html; charset=utf-8');

    $id           = $_REQUEST['id'];
    $nome           = $_REQUEST['nome'];
    $username       = $_REQUEST['username'];
    $imagem         = $_FILES['imagem'];

    function chamaLog(){

        $user  = $_SESSION['username'];
        $item  = "Usuários";
        $acao  = "Editar";
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
    
    function update($id, $nome, $username, $nome_atual){
        //echo "entrei na funcao de salvar";
        $sqlInsere = "UPDATE users SET 
        nome = '$nome', username = '$username', imagem = '$nome_atual', data_atualiza = NOW()
        WHERE
        id = $id";
        $_SESSION['query'] = $sqlInsere;
        //exit();
        return update_db($sqlInsere);
    }

    function updateSemImagem($id, $nome, $username){
        //echo "entrei na funcao de salvar";
        $sqlInsere = "UPDATE users SET 
        nome = '$nome', username = '$username', data_atualiza = NOW()
        WHERE
        id = $id;";
        $_SESSION['query'] = $sqlInsere;
        //exit();
        return update_db($sqlInsere);
    }

    function deletaArquivo($id){
        $sqlConsulta    = "SELECT imagem FROM banners WHERE id = $id";
        $resultConsulta = consulta_db($sqlConsulta);
        while($consulta = mysql_fetch_object($resultConsulta)){
            $arquivo = "../uploads/".$consulta->imagem;
            if (unlink($arquivo)){
                return true;
            } else {
                return false;
            }
        }
    }
    
    function uploadImg($id, $nome, $username, $imagem){

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
            if($altura <= 248){
                //testa o tamanho em pixels da imagem
                if($tamanho < 512){ //se imagem for até 500KB envia
                    $nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                    $tmp = $imagem['tmp_name']; //caminho temporário da imagem

                    //if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                    if($s3->putObjectFile($tmp, $bucket , $nome_atual, S3::ACL_PUBLIC_READ)){
                        //if(deletaArquivo($id)){
                            //ACAO PARA SALVAR NO BANCO
                            if(update($id, $nome, $username, $nome_atual)){
                                chamaLog();
                                echo "<script type='text/javascript'>alert('Operação realizada com sucesso!'); window.location = 'usuarios.php';</script>";
                                exit();
                            }
                        //}
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
                echo "<script type='text/javascript'>alert('A deve ter no máximo 248 pixels de altura!'); history.back();</script>";
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
        //echo "ALTEREI a imagem";
        //exit();
        uploadImg($id, $nome, $username, $imagem);
    } else {
        //echo "NAO alterei a imagem";
        //exit();
        if(updateSemImagem($id, $nome, $username)){
            //echo "ALTEREI os dados";
            chamaLog();
            echo "<script type='text/javascript'>alert('Operação realizada com sucesso!'); window.location = 'usuarios.php';</script>";
            exit();
        }
    }
    
?>