<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <?php
          /*
          ESCONDENDO FORMULARIO DE BUSCA DO LADO ESQUERDO
          
          //<form action="#" method="get" class="sidebar-form">
          //  <div class="input-group">
          //   <input type="text" name="q" class="form-control" placeholder="Search..."/>
          //    <span class="input-group-btn">
          //      <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          //    </span>
          //  </div>
          // </form>
          
          */
          ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">NAVEGAÇÃO PRINCIPAL</li>
            <li>
              <a href="contatos.php">
                <i class="fa fa-th"></i>
                <span>Contatos</span>
                <span class="label label-primary pull-right">
                  <?php
                    $sqlTrabalhosMenu     = "SELECT id FROM contato ORDER BY id";
                    $resultTrabalhosMenu  = consulta_db($sqlTrabalhosMenu);
                    $numTrabalhosMenu     = mysql_num_rows($resultTrabalhosMenu);
                    if($numTrabalhosMenu > 0){
                      echo $numTrabalhosMenu;
                    } else {
                      echo "0";
                    }
                  ?>
                </span>
              </a>
            </li>
            <li>
              <a href="representantes.php">
                <i class="fa fa-th"></i>
                <span>Representantes</span>
                <span class="label label-primary pull-right">
                  <?php
                    $sqlAutoresMenu = "SELECT id FROM representantes ORDER BY id";
                    $resultAutoresMenu  = consulta_db($sqlAutoresMenu);
                    $numAutoresMenu     = mysql_num_rows($resultAutoresMenu);
                    if($numAutoresMenu > 0){
                      echo $numAutoresMenu;
                    } else {
                      echo "0";
                    }
                  ?>
                </span>
              </a>
            </li>
            <li>
              <a href="trabalhe.php">
                <i class="fa fa-th"></i>
                <span>Trabalhe Conosco</span>
                <span class="label label-primary pull-right">
                  <?php
                    $sqlAutoresMenu = "SELECT id FROM trabalhe ORDER BY id";
                    $resultAutoresMenu  = consulta_db($sqlAutoresMenu);
                    $numAutoresMenu     = mysql_num_rows($resultAutoresMenu);
                    if($numAutoresMenu > 0){
                      echo $numAutoresMenu;
                    } else {
                      echo "0";
                    }
                  ?>
                </span>
              </a>
            </li>

            <?php
              /*if($_SESSION['nivel_acesso'] == "SUPER ADMIN"){
            ?>

                <li class="header">ACESSO RESTRITO</li>

                <li>
                  <a href="usuarios.php">
                    <i class="fa fa-users"></i>
                    <span>Usuários</span>
                  </a>
                </li>

                <li>
                  <a href="logs.php">
                    <i class="fa fa-table"></i>
                    <span>Logs</span>
                  </a>
                </li>
            <?php }*/ ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>