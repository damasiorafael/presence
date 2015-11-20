<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
  $id = $_GET["id"];
  $sqlStatus = "UPDATE contato SET status = 1 WHERE id = $id";
  $resultStatus = update_db($sqlStatus);
?>

<!DOCTYPE html>
<html>
  <?php include("inc/head.php"); ?>
  <body class="skin-blue">
    <div class="wrapper">
      
      <?php include("inc/header.php"); ?>
      
      <?php include("inc/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Contato
            <small>Presence Design</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Contato</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <?php
                  $sqlConsultaUser     = "SELECT * FROM contato WHERE id = $id LIMIT 1";
                  $resultConsultaUser  = consulta_db($sqlConsultaUser);
                  while($consultaUser  = mysql_fetch_object($resultConsultaUser)){
                ?>
                    <div class="box-header">
                      <h3 class="box-title"><?php echo $consultaBanner->titulo; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="box-body">
                            <div id="accordion" class="box-group">
                              <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                              <div class="panel box box-primary">
                                <div class="box-header with-border">
                                  <h4 class="box-title">
                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" class=""></a>
                                  </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
                                  <div class="box-body">
                                    <dl class="dl-horizontal">
                                      <dt>Nome</dt>
                                      <dd><?php echo utf8_encode($consultaUser->nome); ?></dd>
                                      <dt>E-mail</dt>
                                      <dd><?php echo $consultaUser->email; ?></dd>
                                      <dt>Telefone</dt>
                                      <dd><?php echo $consultaUser->telefone; ?></dd>
                                      <dt>Empresa</dt>
                                      <dd><?php echo utf8_encode($consultaUser->empresa); ?></dd>
                                      <dt>Cidade / Estado</dt>
                                      <dd><?php echo utf8_encode($consultaUser->cidade_estado); ?></dd>
                                      <dt>Mensagem</dt>
                                      <dd><?php echo utf8_encode($consultaUser->mensagem); ?></dd>
                                    </dl>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- /.box-body -->

                        </div>
                      </div>
                    </div><!-- /.box-body -->
                <?php
                  }
                ?>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include("inc/footer.php"); ?>

    </div><!-- ./wrapper -->

    <?php include("inc/footer-scripts.php"); ?>
    </script>
  </body>
</html>
