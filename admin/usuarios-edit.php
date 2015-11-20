<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
  $id = $_GET['id'];
  $cor = "";
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
            Usuários
            <small>Kroton Portal Stricto Sensu</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Usuários</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Editar Usuário</h3>
                </div><!-- /.box-header -->
                <?php
                  $sqlConsultaUser      = "SELECT * FROM users WHERE status = 1 AND id = $id LIMIT 1";
                  $resultConsultaUser  = consulta_db($sqlConsultaUser);
                  while($consultaUser  = mysql_fetch_object($resultConsultaUser)){
                ?>
                    <div class="box-body">
                      <div class="row">
                        <form action="usuarios-acoes-edit.php" enctype="multipart/form-data" id="programas-add" class="programas-add col-xs-6" method="post" validate>
                          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" class="display-none">
                          <div class="form-group col-xs-12">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Nome" class="form-control" value="<?php echo $consultaUser->nome; ?>" required>
                          </div>

                          <div class="form-group col-xs-12">
                            <label for="username">Username</label>
                            <input type="email" id="username" name="username" placeholder="Username" class="form-control" value="<?php echo $consultaUser->username; ?>" required disabled>
                            <p class="help-block">O username deve ser um endereço e-mail válido!</p>
                          </div>

                          <div class="form-group form-group-textarea col-xs-12">
                            <label for="imagem">Imagem</label>
                            <input type="file" id="imagem" name="imagem">
                            <img src="https://s3.amazonaws.com/pgsskroton-uploads/<?php echo $consultaUser->imagem; ?>" width="100" class="img-pag-edit-prog pull-left">
                            <p class="help-block">A imagem deve ter no máximo 248 pixels de largura e no máximo 500kb</p>
                          </div>

                          <div class="form-group form-group-textarea col-xs-12">
                            <button type="submit" class="btn btn-lg btn-success pull-right">
                              <i class="fa fa-check"></i>Salvar
                            </button>
                          </div>
                        </form>
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

    <!-- Bootstrap Color Picker -->
    <link href="plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>

    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $(function () {
        //Colorpicker
        $(".colorpicker-banner").colorpicker({
          format: 'hex',
          color: '<?php echo $cor; ?>'
        });
      });
    </script>

  </body>
</html>
