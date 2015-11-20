<?php
  include("inc/produtos.php");
  $pagAtiva = "produtos";
?>
<!DOCTYPE html>
<html lang="en">
  
  <?php include("inc/head.php"); ?>

  <!-- Lightbox -->
  <link href="css/lightbox.css" rel="stylesheet" type="text/css">

  <body class="body">
    
    <?php include("inc/header.php"); ?>

    <section class="corpo corpo-internas corpo-produtos">
      <div class="container container-produtos">
        <?php /* <h2 class="col-lg-12 title-produtos">EMPRESA</h2> */ ?>
        <nav id="menu-nav" class="menu-nav menu-nav-filtros filtros">
          <ul>
            <li class="pull-left">
              <a href="#retrateis" data-categoria="retrateis" title="RETRÁTEIS E RECLINÁVEIS">RETRÁTEIS E RECLINÁVEIS</a>
            </li>
            <li class="pull-left">
              <a href="#fixos" data-categoria="fixos" title="FIXOS">FIXOS</a>
            </li>
            <li class="pull-left">
              <a href="#poltronas" data-categoria="poltronas" title="POLTRONAS">POLTRONAS</a>
            </li>
            <li class="pull-left">
              <a href="#complementos" data-categoria="complementos" title="COMPLEMENTOS">COMPLEMENTOS</a>
            </li>
            <li class="pull-right">
              <a href="#todos" data-categoria="todos" title="TODOS" class="filtroAtivo">TODOS</a>
            </li>
          </ul>
        </nav>
        <div class="col-lg-12 listagem-produtos">
          <?php for ($i=0; $i<count($produtos); $i++) { ?>
            <div class="col-lg-3 item-produto" rel="<?php echo $produtos[$i]["categoria"]; ?>">
              <a
                href="<?php echo $produtos[$i]["imagem"]; ?>"
                data-lightbox="<?php echo $produtos[$i]["categoria"]; ?>"
                data-title="<?php echo $produtos[$i]["descricao"]; ?>">
                  <img src="<?php echo $produtos[$i]["imagem"]; ?>">
                  <span><?php echo $produtos[$i]["titulo"]; ?></span>
              </a>
            </div>
          <?php } ?>
          <p class="col-lg-12 novidades display-none">EM BREVE NOVIDADES</p>
        </div>
      </div>
    </section>

    <?php include("inc/footer.php"); ?>

    <!-- Lightbox JavaScript -->
    <script src="js/lightbox.js"></script>

    <script type="text/javascript">
      $(".filtros li a").on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        var $this = $(this);
        var categoria = $this.attr("data-categoria");

        if($this.hasClass("filtroAtivo")){
          $(".filtros li a").removeClass("filtroAtivo");
          $(".item-produto").removeClass("display-none");
          return false;
        }

        if(categoria != "todos" && categoria != "complementos"){

          $(".novidades").addClass("display-none");
          $(".filtros li a").removeClass("filtroAtivo");

          $this.addClass("filtroAtivo");

          $(".item-produto").addClass("display-none");
          $("div[rel='"+categoria+"']").removeClass("display-none");

        } else if(categoria == "complementos"){

          $(".filtros li a").removeClass("filtroAtivo");
          $this.addClass("filtroAtivo");

          $(".novidades").removeClass("display-none");
          $(".item-produto").addClass("display-none");

        } else {
          
          $(".filtros li a").removeClass("filtroAtivo");
          $this.addClass("filtroAtivo");
          $(".novidades").addClass("display-none");
          $(".item-produto").removeClass("display-none");

        }
      });
    </script>

  </body>
</html>