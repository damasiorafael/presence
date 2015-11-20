<?php
  include("inc/config.php");

  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');

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
            Representantes
            <small>Presence Design</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Representantes</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    <b class="lead text-todas-areas">Representantes</b>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nome">Nome</th>
                        <th class="col-email">E-mail</th>
                        <th class="col-telefone">Telefone</th>
                        <th class="col-empresa">Empresa</th>
                        <th class="col-cidade_estado">Cidade / Estado</th>
                        <th class="col-data">Data</th>
                        <th class="col-status">Status</th>
                        <th class="col-acoes">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlConsultaProgramas     = "SELECT * FROM representantes ORDER BY id ASC";
                        $resultConsultaProgramas  = consulta_db($sqlConsultaProgramas);
                        while($consultaProgramas  = mysql_fetch_object($resultConsultaProgramas)){
                      ?>
                          <tr>
                            <td><?php echo $consultaProgramas->id; ?></td>
                            <td><?php echo utf8_encode($consultaProgramas->nome); ?></td>
                            <td><?php echo $consultaProgramas->email; ?></td>
                            <td><?php echo $consultaProgramas->telefone; ?></td>
                            <td><?php echo utf8_encode($consultaProgramas->empresa); ?></td>
                            <td><?php echo utf8_encode($consultaProgramas->cidade_estado); ?></td>
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
                            <td>
                              <a href="representante.php?id=<?php echo $consultaProgramas->id; ?>" class="btn btn-info btn-xs btn-center col-lg-12"><i class="fa fa-plus"></i> Visualizar</a>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-nome">Nome</th>
                        <th class="col-email">E-mail</th>
                        <th class="col-telefone">Telefone</th>
                        <th class="col-empresa">Empresa</th>
                        <th class="col-cidade_estado">Cidade / Estado</th>
                        <th class="col-data">Data</th>
                        <th class="col-status">Status</th>
                        <th class="col-acoes">&nbsp;</th>
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
        
        $(".btn-delete").on("click", function(){
            var conf = confirm("Tem certeza que deseja excluir este registro?");
            if(conf){
                return true;
            } else {
                return false;
            }
        });

        $(".btn-status").on("click", function(e){
            <?php 
              if($_SESSION['nivel_acesso'] == "VIEWER"){
            ?>
                e.stopPropagation();
                e.preventDefault();
                return false;
            <?php } ?>
            var conf = confirm("Tem certeza que deseja alterar este registro?");
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
