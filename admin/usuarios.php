<?php
  include("inc/config.php");
  if((!isset($_SESSION['username']) == true) and (!isset($_SESSION['senha']) == true)) header('Location: login.php');
  $filtro = $_REQUEST['filtro'];
  if(isset($filtro) && $filtro != ""){
    $_SESSION['filtro_banner'] = $filtro;
  }
?>
<!DOCTYPE html>
<html>
  <?php include("inc/head.php"); ?>
  <body class="skin-blue">
    <?php //echo "<script type='text/javascript'>alert('".$_SESSION['filtro_banner']."');</script>"; ?>
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
                  <h3 class="box-title">Usuários</h3>
                  <a href="usuarios-add.php" class="btn-add btn btn-app btn-success pull-right"><i class="fa fa-plus"></i> Adicionar</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-id">Imagem</th>
                        <th class="col-titulo">Nome</th>
                        <th class="col-subtitulo">Username</th>
                        <th class="col-data">Último Login</th>
                        <th class="col-data">Status</th>
                        <th class="col-data">Nível de Acesso</th>
                        <th class="col-data">&nbsp;</th>
                        <th class="col-acoes">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sqlConsultaUsers     = "SELECT id, nome, username, data_ultimo_login, status, imagem FROM users ORDER BY id ASC";
                        $resultConsultaUsers  = consulta_db($sqlConsultaUsers);
                        while($consultaUsers  = mysql_fetch_object($resultConsultaUsers)){
                      ?>
                          <tr>
                            <td><?php echo $consultaUsers->id; ?></td>
                            <td>
                              <img src="https://s3.amazonaws.com/pgsskroton-uploads/<?php echo $consultaUsers->imagem; ?>" width="35" />
                            </td>
                            <td><?php echo $consultaUsers->nome; ?></td>
                            <td><?php echo $consultaUsers->username; ?></td>
                            <td>
                              <?php echo formata_data($consultaUsers->data_ultimo_login); ?>
                            </td>
                            <td>
                              <?php
                                if($consultaUsers->status == 1){
                              ?>
                                  <a href="usuarios-acoes-status.php?id=<?php echo $consultaUsers->id; ?>&status=<?php echo $consultaUsers->status; ?>" class="btn btn-block btn-success btn-xs btn-status">ATIVO</a>
                              <?php
                                } else {
                              ?>
                                  <a href="usuarios-acoes-status.php?id=<?php echo $consultaUsers->id; ?>&status=<?php echo $consultaUsers->status; ?>" class="btn btn-block btn-danger btn-xs btn-status">INATIVO</a>
                              <?php
                                }
                              ?>
                            </td>
                            <td>
                              <?php
                                $sqlConsultaNivelUsers  = "SELECT
                                                          `niveis`.nome
                                                        FROM
                                                          `niveis`
                                                        LEFT JOIN
                                                          `users_niveis`
                                                        ON
                                                          `users_niveis`.id_nivel = `niveis`.id
                                                        WHERE 
                                                          `users_niveis`.id_user = $consultaUsers->id";
                                $resultConsultaNivelUsers  = consulta_db($sqlConsultaNivelUsers);
                                //$numRowConsultaUsers  = mysql_num_rows($resultConsultaNivelUsers);
                                while($consultaNivelUser = mysql_fetch_object($resultConsultaNivelUsers)){
                                  //echo $consultaNivelUser->nome;*/
                              ?>
                                    <?php echo $consultaNivelUser->nome; ?>
                              <?php } ?>
                            </td>
                            <td>
                              <a href="usuario-nivel.php?id=<?php echo $consultaUsers->id; ?>" class="btn btn-block btn-primary btn-xs btn-nivel"><i class="fa fa-edit"></i> Nível de Acesso</a>
                            </td>
                            <td>
                              <a href="usuario.php?id=<?php echo $consultaUsers->id; ?>" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Ver mais</a>
                              <a href="usuarios-edit.php?id=<?php echo $consultaUsers->id; ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Editar</a>
                              <a href="usuarios-acoes-delete.php?id=<?php echo $consultaUsers->id; ?>" class="btn-delete btn btn-danger btn-xs"><i class="fa fa-times"></i> Excluir</a>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="col-id">ID</th>
                        <th class="col-id">Imagem</th>
                        <th class="col-titulo">Nome</th>
                        <th class="col-subtitulo">Username</th>
                        <th class="col-data">Último Login</th>
                        <th class="col-data">Status</th>
                        <th class="col-data">Nível de Acesso</th>
                        <th class="col-data">&nbsp;</th>
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

        $(".btn-status").on("click", function(){
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
