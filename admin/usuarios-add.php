<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
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
                  <h3 class="box-title">Adicionar Usuário</h3>
                </div><!-- /.box-header -->
                <?php
                  /*
                  if(isset($_SESSION['titulo'])) echo $_SESSION['titulo'];
                  if(isset($_SESSION['subtitulo'])) echo $_SESSION['subtitulo'];
                  if(isset($_SESSION['texto_link'])) echo $_SESSION['texto_link'];
                  if(isset($_SESSION['link'])) echo $_SESSION['link'];
                  if(isset($_SESSION['cor'])) echo $_SESSION['cor'];
                  if(isset($_SESSION['id_programa'])) echo $_SESSION['id_programa'];
                  if(isset($_SESSION['id_instituicao'])) echo $_SESSION['id_instituicao'];
                  */
                ?>
                <div class="box-body">
                  <div class="row">
                    <form action="usuarios-acoes.php" enctype="multipart/form-data" id="programas-add" class="programas-add col-xs-6" method="post" validate>
                      <div class="form-group col-xs-12">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Nome" class="form-control" value="<?php if(isset($_SESSION['nome'])) echo $_SESSION['nome']; ?>" required>
                      </div>

                      <div class="form-group col-xs-12">
                        <label for="username">Username (E-mail)</label>
                        <input type="email" id="username" name="username" placeholder="Username" class="form-control" value="<?php if(isset($_SESSION['username_cadastra'])) echo $_SESSION['username_cadastra']; ?>" required>
                        <p class="help-block">O username deve ser um endereço e-mail válido!</p>
                      </div>

                      <div class="form-group col-xs-12">
                        <label for="imagem">Imagem</label>
                        <input type="file" id="imagem" name="imagem" value="<?php if(isset($_SESSION['imagem'])) echo $_SESSION['imagem']; ?>">
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
          format: 'hex'
        });
      });
    </script>

  </body>
</html>
