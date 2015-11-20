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
                  $sqlConsultaUser     = "SELECT * FROM users WHERE id = $id LIMIT 1";
                  $resultConsultaUser  = consulta_db($sqlConsultaUser);
                  while($consultaUser  = mysql_fetch_object($resultConsultaUser)){
                ?>
                    <div class="box-header">
                      <h3 class="box-title"><?php echo $consultaUser->nome; ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="box-body">
                            <div id="accordion" class="box-group">
                              <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                              <div class="panel box box-primary">
                                <div class="box-header with-border">
                                  <h4 class="box-title">
                                    <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" class="">
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
                                      <dt>Imagem</dt>
                                      <dd>
                                        <img src="https://s3.amazonaws.com/pgsskroton-uploads/<?php echo $consultaUser->imagem; ?>" width="100">
                                      </dd>
                                    </dl>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- /.box-body -->
                        </div>
                        <div class="col-md-6">
                          <div class="box-body">
                            <div id="accordion" class="box-group">
                              <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                              <div class="panel box box-primary">
                                <div class="box-header with-border">
                                  <h4 class="box-title">
                                    <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" class="">
                                      Nível de acesso
                                    </a>
                                  </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label>Níveis</label>
                                      <select class="form-control selectNivel">
                                        <option>-- Selecione --</option>
                                        <?php
                                          $sqlConsultaNiveis     = "SELECT * FROM niveis ORDER BY id";
                                          $resultConsultaNiveis  = consulta_db($sqlConsultaNiveis);
                                          while($consultaNiveis  = mysql_fetch_object($resultConsultaNiveis)){
                                        ?>
                                            <option value="<?php echo $consultaNiveis->id; ?>"><?php echo $consultaNiveis->nome; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div><!-- /.box-body -->
                        </div>

                        <div class="box-body">
                          <div class="row">
                            <form action="usuarios-niveis-acoes.php" enctype="multipart/form-data" id="programas-add" class="programas-add col-xs-12" method="post">
                              <input type="hidden" id="id_user" name="id_user" value="<?php echo $id; ?>" class="display-none">
                              <input type="hidden" id="id_nivel" name="id_nivel" class="display-none" value="">
                              <div class="form-group form-group-textarea col-xs-12">
                                <button type="submit" class="btn btn-lg btn-success pull-right">
                                  <i class="fa fa-check"></i>Salvar
                                </button>
                              </div>
                            </form>
                          </div>
                        </div><!-- /.box-body -->
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
    <script type="text/javascript">
      $(document).ready(function(){
        $(".selectNivel").on("change", function(e){
          e.preventDefault();
          e.stopPropagation();
          var $this = $(this);
          var id_nivel = $this.val();
          $("#id_nivel").val(id_nivel);
        });
      });
    </script>
    </script>
  </body>
</html>
