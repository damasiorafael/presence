<?php
  $pagAtiva = "index";
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("inc/head.php"); ?>
  <body class="body">
    
    <?php include("inc/header.php"); ?>

    <section class="corpo corpo-index-1">
      <!-- Carousel -->
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <?php /* <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li> */ ?>
        </ol><!-- Indicators -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="img/topo_home.jpg">
          </div>
          <?php /*
          <div class="item">
            <img src="img/topo_home.jpg">
          </div>

          <div class="item">
            <img src="img/topo_home.jpg">
          </div>

          <div class="item">
            <img src="img/topo_home.jpg">
          </div>
          */ ?>
        </div><!-- Wrapper for slides -->

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div><!-- Carousel -->
    </section>

    <section class="corpo corpo-index-2">
      <nav id="menu-nav" class="menu-nav container menu-nav-corpo-index">
        <ul class="col-lg-12">
          <li class="col-lg-4 text-center">
            <a href="produtos.php" title="PRODUTOS">
              <img src="img/bg_link_produtos.png" />
              <span class="col-lg-12">PRODUTOS</span>
            </a>
          </li>
          <li class="col-lg-4 text-center">
            <a href="representantes.php" title="ONDE ENCONTRAR">
              <img src="img/bg_link_representantes.png" />
              <span class="col-lg-12">ONDE ENCONTRAR</span>
            </a>
          </li>
          <li class="col-lg-4 text-center">
            <a href="contato.php" title="CONTATO">
              <img src="img/bg_link_contato.png" />
              <span class="col-lg-12">CONTATO</span>
            </a>
          </li>
        </ul>
      </nav>
    </section>

    <?php include("inc/footer.php"); ?>

  </body>
</html>