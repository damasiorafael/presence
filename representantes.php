<?php
  $pagAtiva = "representantes";
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("inc/head.php"); ?>
  <body class="body">
    
    <?php include("inc/header.php"); ?>

    <section class="corpo corpo-internas corpo-representantes">
      <div class="container container-representantes">
        <h2 class="col-lg-12 text-center title-representantes">REPRESENTANTES/LOJISTAS</h2>
        <div class="col-lg-12 container-representantes">
          <div class="col-lg-6 map map-representantes">
            <div class="mapa">
              <?php include("mapa.php"); ?>
            </div>
            <div class="col-lg-12 infos infos-representantes">
              <div class="item-representante display-none" data-estado="parana">
                <h4>PARANÁ</h4>
                <br />
                <br /> 
                <span>Região: Todo Interior.</span> 
                <span>
                  Representante: <br />
                  Izaque Lemos de Almeida
                </span>
                <br />
                <span>DIZA REPRESENTAÇÕES COMERCIAIS</span>
                <span>izaquealalmeida007@gmail.com</span>
                <span>(44) 9861 – 1948</span>
                <span>(48) 8415 – 5010</span>
              </div>
              <div class="item-representante display-none" data-estado="goias">
                <h4>GOIÁS</h4>
                <br />
                <br /> 
                <span>Região: Goiânia/Brasília</span> 
                <span>
                  Representante: <br />
                  Adiel Reis
                </span>
                <br />
                <span>ACR REPRESENTAÇÕES COMERCIAIS</span>
                <span>adiel_reis@hotmail.com</span>
                <span>(62) 8125 – 1748</span>
              </div>
              <div class="item-representante display-none" data-estado="todos">
                <h4>PRESENCE DESIGN</h4>
                <br />
                <br /> 
                <span>Região: Estado Inteiro</span>
                <span>
                  Representante: <br />
                  Diego A. Lançoni
                </span>
                <br />
                <span>presence@presencedesign.com.br</span>
                <span>(44) 3152 – 8740</span>
                <span>(48) 8817 - 7575</span>
              </div>
              <div class="item-representante" data-estado="escolha">
                <h4>ESCOLHA SEU ESTADO</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-6 formulario formulario-representantes">
            <p class="col-lg-12 text-justify tx-informa-form">Preencha nosso formulário e entraremos em contato para informações sobre as lojas que revendem nossos produtos.</p>
            <form name="contato" id="contato" validate action="contacts.php" method="post" class="col-lg-12 form-rep">
              <div class="control-group form-group">
                <div class="controls">
                  <input type="hidden" class="form-control" id="tipo" name="tipo" value="representantes">
                  <input type="text" class="form-control" id="nome" name="nome" required Placeholder="Nome">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input type="email" class="form-control" id="email" name="email" required Placeholder="E-mail">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input type="tel" class="form-control" id="telefone" name="telefone" required data-mask="" data-inputmask="'mask': '(99) 9999[9]-9999'" Placeholder="Telefone">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input type="text" class="form-control" id="empresa" name="empresa" required Placeholder="Empresa">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <input type="text" class="form-control" id="cidade_estado" name="cidade_estado" required required Placeholder="Cidade/Estado">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <textarea rows="10" cols="100" class="form-control" id="mensagem" name="mensagem" required Placeholder="Mensagem" maxlength="999" style="resize:none"></textarea>
                </div>
              </div>
              <div id="success"></div>
              <!-- For success/fail messages -->
              <button type="submit" class="btn btn-primary btn-envia-form pull-right">Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal Contato -->
    <div class="modal fade bs-example-modal-lg modal-contato" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissable display-none">
                                    <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                                    <p></p>
                                </div>
                                <div class="alert alert-warning alert-dismissable display-none">
                                    <h4><i class="icon fa fa-check"></i> Aviso!</h4>
                                    <p></p>
                                </div>
                                <div class="alert alert-success alert-dismissable display-none">
                                    <h4><i class="icon fa fa-check"></i> Mensagem!</h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-lg display-none btn-auto-contato" data-toggle="modal" data-target=".modal-contato">alert</button>

    <?php include("inc/footer.php"); ?>

    <div class="loading-overlay"></div>
    <div class="loading"></div>

    <!-- InputMask -->
    <script src="js/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="js/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="js/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <script type="text/javascript">
        $("[data-mask]").inputmask();

        $(".estado.estado1").on("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          var $this = $(this);
          var thislink = $this.attr("xlink:href");
          thislink = thislink.split("/#")[1];

          $(".item-representante").addClass("display-none");
          
          if($(".item-representante[data-estado='"+thislink+"']").length > 0){
            $(".item-representante[data-estado='"+thislink+"']").removeClass("display-none");
          } else {
            switch(thislink){
              case "tocantins":
                thislink = "Tocantins"
                break;
              case "matogrossodosul":
                thislink = "Mato Grosso do Sul"
                break;
              case "riograndedosul":
                thislink = "Rio Grande do Sul"
                break;
              case "santacatarina":
                thislink = "Santa Catarina"
                break;
              case "riograndedonorte":
                thislink = "Rio Grande do Norte"
                break;
              case "ceara":
                thislink = "Ceará"
                break;
              case "saopaulo":
                thislink = "São Paulo"
                break;
              case "riodejaneiro":
                thislink = "Rio de Janeiro"
                break;
              case "minasgerais":
                thislink = "Minas Gerais"
                break;
              case "espiritosanto":
                thislink = "Espírito Santo"
                break;
              case "matogrosso":
                thislink = "Mato Grosso"
                break;
              case "matogrossodosul":
                thislink = "Mato Grosso do Sul"
                break;
              case "bahia":
                thislink = "Bahia"
                break;
              case "sergipe":
                thislink = "Sergipe"
                break;
              case "alagoas":
                thislink = "Alagoas"
                break;
              case "paraiba":
                thislink = "Paraíba"
                break;
              case "piaui":
                thislink = "Piauí"
                break;
              case "maranhao":
                thislink = "Maranhão"
                break;
              case "para":
                thislink = "Pará"
                break;
              case "amapa":
                thislink = "Amapá"
                break;
              case "roraima":
                thislink = "Roraima"
                break;
              case "riograndedosul":
                thislink = "Rio Grande do Sul"
                break;
              case "acre":
                thislink = "Acre"
                break;
              case "amazonas":
                thislink = "Amazonas"
                break;
              case "rondonia":
                thislink = "Rondônia"
                break;
              case "distritofederal":
                thislink = "Distrito Federal"
                break;
              default:
                //Instruções executadas quando o valor da expressão é diferente de todos os cases
                break;
            }

            $(".item-representante[data-estado='todos'] h4").text(thislink);
            $(".item-representante[data-estado='todos']").removeClass("display-none");
          }


        });
    </script>

  </body>
</html>