<?php
  include("inc/config.php");

  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
  
  $id_area = $_GET['idarea'];

  //if(isset($_SESSION['inst'])){
?>
<!DOCTYPE html>
<html>
  <?php include("inc/head.php"); ?>
  <body class="skin-blue contatos">
    <div class="wrapper">
      
      <?php include("inc/header.php"); ?>
      
      <?php include("inc/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Trabalhe Conosco
            <small>Presence Design</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Trabalhe Conosco</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    <b class="lead text-todas-areas">Trabalhe Conosco</b>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nome">Nome</th>
                        <th class="col-email">Arquivo</th>
                        <th class="col-data">Data</th>
                        <th class="col-status">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlConsultaProgramas     = "SELECT * FROM trabalhe ORDER BY id ASC";
                        $resultConsultaProgramas  = consulta_db($sqlConsultaProgramas);
                        while($consultaProgramas  = mysql_fetch_object($resultConsultaProgramas)){
                      ?>
                          <tr>
                            <td><?php echo $consultaProgramas->id; ?></td>
                            <td><?php echo utf8_encode($consultaProgramas->nome); ?></td>
                            <td>
                              <a target="_blank" href="../uploads/<?php echo $consultaProgramas->arquivo; ?>" class="btn btn-warning btn-sm btn-baixa" rel="<?php echo $consultaProgramas->id; ?>"><i class="fa fa-download"></i> Baixar</a>
                            </td>
                            <td>
                              <?php echo formata_data($consultaProgramas->data); ?>
                            </td>
                            <td>
                              <?php
                                if($consultaProgramas->status == 1){
                              ?>
                                  <a class="btn btn-block btn-success btn-xs btn-status">LIDO</a>
                              <?php
                                } else {
                              ?>
                                  <a class="btn btn-block btn-danger btn-xs btn-status">NÃO LIDO</a>
                              <?php
                                }
                              ?>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nome">Nome</th>
                        <th class="col-email">Arquivo</th>
                        <th class="col-data">Data</th>
                        <th class="col-status">Status</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include("inc/footer.php"); ?>

    </div><!-- ./wrapper -->

    <?php include("inc/footer-scripts.php"); ?>

    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $(".btn-baixa").on("click", function(){
          var $this = $(this);
          var thisId = $this.attr("rel");
          $.ajax({
            type: "POST",
            url: "trabalhe-acoes.php?id="+thisId,
            success: function(data){
              
              if(data == "sucesso"){
                window.location=window.location.href;
              } else {
                
              }
            },
            error: function(data){
              alert(data);
            }
          });
        });

        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

  </body>
</html>
