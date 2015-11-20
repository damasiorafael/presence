<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)){
    header('Location: login.php');
  } else {
    header('Location: contatos.php');
  }

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
            Kroton
            <small>Portal Stricto Sensu</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="lista-instituicoes col-md-4">
              <!-- Info boxes -->
              <div class="row">

                <div class="col-md-12 <?php if(isset($_SESSION['inst']) && $_SESSION[inst] != "" && $_SESSION[inst] != "unopar") echo "display-none" ?>">
                  <div class="info-box">
                    <span class="info-box-icon bg-blue-unopar">
                      <img src="img/lg_unopar_adm.png" class="logo-inst">
                    </span>
                    <div class="info-box-content">
                      <a href="index.php?inst=unopar" title="Unopar"><span class="info-box-text tx-blue-unopar">Unopar</span></a>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->

                <div class="col-md-12 <?php if(isset($_SESSION['inst']) && $_SESSION[inst] != "" && $_SESSION[inst] != "unic") echo "display-none" ?>">
                  <div class="info-box">
                    <span class="info-box-icon bg-blue-unic">
                      <img src="img/lg_unic_adm.png" class="logo-inst">
                    </span>
                    <div class="info-box-content">
                      <a href="index.php?inst=unic" title="Unic"><span class="info-box-text tx-blue-unic">Unic</span></a>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-12 <?php if(isset($_SESSION['inst']) && $_SESSION[inst] != "" && $_SESSION[inst] != "uniderp") echo "display-none" ?>">
                  <div class="info-box">
                    <span class="info-box-icon bg-blue-uniderp">
                      <img src="img/lg_uniderp_adm.png" class="logo-inst">
                    </span>
                    <div class="info-box-content">
                      <a href="index.php?inst=uniderp" title="Uniderp"><span class="info-box-text tx-blue-uniderp">Uniderp</span></a>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->

                <div class="col-md-12 <?php if(isset($_SESSION['inst']) && $_SESSION[inst] != "" && $_SESSION[inst] != "anhanguera") echo "display-none" ?>">
                  <div class="info-box">
                    <span class="info-box-icon bg-yellow-anhanguera">
                      <img src="img/lg_anhanguera_adm.png" class="logo-inst">
                    </span>
                    <div class="info-box-content">
                      <a href="index.php?inst=anhanguera" title="Anhanguera"><span class="info-box-text tx-yellow-anhanguera">Anhanguera</span></a>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
                </div><!-- /.col -->

              </div><!-- /.row -->
            </div>

            <div class="col-md-8">
              <!-- LISTA DE PROGRAMAS RECENTES -->
              <div class="box box-primary box-programas-recentes">
                <div class="box-header with-border">
                  <h3 class="box-title">Programas adicionados recentemente</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php
                      $idInst = "";
                      if(isset($_SESSION['inst']) && $_SESSION['inst'] != ""){
                        $sqlConsultaInst     = "SELECT * FROM instituicoes WHERE status = 1 AND nome LIKE '%".$_SESSION['inst']."%' LIMIT 1";
                        $resultConsultaInst  = consulta_db($sqlConsultaInst);
                        while($consultaInst  = mysql_fetch_object($resultConsultaInst)){
                          $idInst = $consultaInst->id;
                        }
                        //echo "<script type='text/javascript'>alert('".$idInst."');</script>";
                      }
                      $sqlConsultaProgramas = "";
                      if($idInst != ""){
                        $sqlConsultaProgramas   = "SELECT id, nome, apresentacao, imagem, fl_mestrado, fl_doutorado FROM programas WHERE status = 1 AND id_instituicao = $idInst ORDER BY data DESC LIMIT 5";
                      } else {
                        $sqlConsultaProgramas   = "SELECT id, nome, apresentacao, imagem, fl_mestrado, fl_doutorado FROM programas WHERE status = 1 ORDER BY data DESC LIMIT 8";
                      }
                      $resultConsultaProgramas  = consulta_db($sqlConsultaProgramas);
                      $numRowProgramas = mysql_num_rows($resultConsultaProgramas);
                      if($numRowProgramas > 0){
                        while($consultaProgramas  = mysql_fetch_object($resultConsultaProgramas)){
                    ?>
                          <li class="item">
                            <div class="product-img">
                              <img src="https://s3.amazonaws.com/pgsskroton-uploads/<?php echo $consultaProgramas->imagem; ?>" />
                            </div>
                            <div class="product-info">
                              <a class="product-title" href="programa.php?id=<?php echo $consultaProgramas->id; ?>"><?php echo $consultaProgramas->nome; ?> <?php if($consultaProgramas->fl_mestrado == 1){ ?><span class="label label-warning pull-right">mestrado</span><?php } ?> <?php if($consultaProgramas->fl_doutorado == 1){ ?><span class="label label-warning pull-right">doutorado</span><?php } ?></a>
                              <span class="product-description">
                                <?php echo substr(strip_tags($consultaProgramas->apresentacao),0,300); ?>
                              </span>
                            </div>
                          </li><!-- /.item -->
                    <?php
                        }
                      } else {
                    ?>
                          <li class="item">
                            <div class="product-img">
                              <img src="http://placehold.it/50x50/d2d6de/ffffff" />
                            </div>
                            <div class="product-info">
                              <a class="product-title" href="#">Nenhum registro encontrado</a>
                              <span class="product-description">
                                Nenhum registro encontrado
                              </span>
                            </div>
                          </li><!-- /.item --> 
                    <?php
                      }
                    ?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  <a class="uppercase" href="programas.php">Ver todos os programas</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include("inc/footer.php"); ?>
    </div><!-- ./wrapper -->

    <?php include("inc/footer-scripts.php"); ?>
  </body>
</html>