<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
  $id = $_GET["id"];
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
            Usuário
            <small>Kroton Portal Stricto Sensu</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Usuário</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <?php
                  $sqlConsultaUser     = "SELECT * FROM users WHERE status = 1 AND id = $id LIMIT 1";
                  $resultConsultaUser  = consulta_db($sqlConsultaUser);
                  while($consultaUser  = mysql_fetch_object($resultConsultaUser)){
                ?>
                    <div class="box-header">
                      <h3 class="box-title"><?php echo $consultaBanner->titulo; ?></h3>
                      <a class="btn-add btn btn-app btn-success pull-right" href="usuarios-add.php"><i class="fa fa-plus"></i> Adicionar Novo</a>
                      <a class="btn-add btn btn-app btn-warning pull-right" href="usuarios-edit.php?id=<?php echo $consultaUser->id; ?>"><i class="fa fa-pencil"></i> Editar</a>
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
                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" class="">
                                      Usuário
                                    </a>
                                  </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
                                  <div class="box-body">
                                    <dl class="dl-horizontal">
                                      <dt>Nome</dt>
                                      <dd><?php echo $consultaUser->nome; ?></dd>
                                      <dt>Username</dt>
                                      <dd><?php echo $consultaUser->username; ?></dd>
                                      <dt>Último Login</dt>
                                      <dd><?php echo $consultaUser->data_ultimo_login; ?></dd>
                                      <dt>Última Atualização</dt>
                                      <dd><?php echo $consultaUser->data_atualiza; ?></dd>
                                      <dt>Imagem</dt>
                                      <dd>
                                        <img src="https://s3.amazonaws.com/pgsskroton-uploads/<?php echo $consultaUser->imagem; ?>" >
                                      </dd>
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
