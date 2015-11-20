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
            Logs
            <small>Kroton Portal Stricto Sensu</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Logs</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Logs</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-id_programa">Usuário</th>
                        <th class="col-nome">Item</th>
                        <th class="col-arquivo">Ação</th>
                        <th class="col-query">Query</th>
                        <th class="col-data">Data</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlConsultaLogs     = "SELECT * FROM logs ORDER BY id ASC";
                        $resultConsultaLogs  = consulta_db($sqlConsultaLogs);
                        while($consultaLogs  = mysql_fetch_object($resultConsultaLogs)){
                      ?>
                          <tr>
                            <td><?php echo $consultaLogs->id; ?></td>
                            <td>
                              <?php
                                $sqlConsultaUsers     = "SELECT username FROM users WHERE status = 1 AND id = $consultaLogs->id_usuario";
                                $resultConsultaUsers  = consulta_db($sqlConsultaUsers);
                                while($consultaUsers  = mysql_fetch_object($resultConsultaUsers)){
                                  if($consultaUsers->username != ""){
                                    echo $consultaUsers->username;
                                  } else {
                                    echo "-";
                                  }
                                }
                              ?>
                            </td>

                            <td><?php echo $consultaLogs->item; ?></td>

                            <td><?php echo $consultaLogs->acao; ?></td>

                            <td><?php echo limitaStr($consultaLogs->query); ?></td>
                            
                            <td>
                              <?php echo formata_data($consultaLogs->data); ?>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-id_programa">Usuário</th>
                        <th class="col-nome">Item</th>
                        <th class="col-arquivo">Ação</th>
                        <th class="col-query">Query</th>
                        <th class="col-data">Data</th>
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
      $(function(){
        $(".btn-delete").on("click", function(){
            var conf = confirm("Tem certeza que deseja excluir este registro?");
            if(conf){
                return true;
            } else {
                return false;
            }
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
