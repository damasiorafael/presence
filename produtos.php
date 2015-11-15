<?php
  include("inc/produtos.php");
  $pagAtiva = "produtos";
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("inc/head.php"); ?>
  <body class="body">
    
    <?php include("inc/header.php"); ?>

    <section class="corpo corpo-internas corpo-produtos">
      <div class="container container-produtos">
        <?php /* <h2 class="col-lg-12 title-produtos">EMPRESA</h2> */ ?>
        <nav id="menu-nav" class="menu-nav menu-nav-filtros filtros">
          <ul>
            <li class="pull-left">
              <a href="#retrateis" title="RETRÁTEIS E RECLINÁVEIS">RETRÁTEIS E RECLINÁVEIS</a>
            </li>
            <li class="pull-left">
              <a href="#fixos" title="FIXOS">FIXOS</a>
            </li>
            <li class="pull-left">
              <a href="#poltronas" title="POLTRONAS">POLTRONAS</a>
            </li>
            <li class="pull-left">
              <a href="#complementos" title="COMPLEMENTOS">COMPLEMENTOS</a>
            </li>
            <li class="pull-right">
              <a href="#todos" title="TODOS" class="filtroAtivo">TODOS</a>
            </li>
          </ul>
        </nav>
        <div class="col-lg-12 listagem-produtos">
          <?php for ($i=0; $i<12; $i++) { ?>
            <div class="col-lg-3 item-produto" rel="<?php echo $produtos[0]["categoria"]; ?>">
              <a href="#">
                <img src="<?php echo $produtos[0]["imagem"]; ?>" />
                <span><?php echo $produtos[0]["titulo"]; ?></span>
              </a>
            </div>
          <?php } ?>
          <?php echo count($produtos); ?>
        </div>
      </div>
    </section>

    <?php include("inc/footer.php"); ?>

  </body>
</html>