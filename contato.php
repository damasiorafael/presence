<?php
  $pagAtiva = "contato";
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("inc/head.php"); ?>
  <body class="body">
    
    <?php include("inc/header.php"); ?>

    <!-- GOOGLE MAPS -->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDfVpzxaQRLeD6z-r-RaEzNbRfD-c6aWmo&sensor=TRUE"></script>
    <script type="text/javascript">
        function initializeMaps() {
            var myLatlng = new google.maps.LatLng(-23.391446, -51.437484);
            var latlngAlpha = new google.maps.LatLng(-23.391446, -51.437484);
            var mapOptions = {
              zoom: 17,
              center: myLatlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            var marker = new google.maps.Marker({
                position: latlngAlpha,
                title:"Presence Design"
            });
            var styles = [{
                stylers: [
                    { hue: ""},
                ]
            }];
            var styledMap = new google.maps.StyledMapType(styles,
            {name: "Styled Map"});
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            marker.setMap(map);
        }
    </script>
    <!-- GOOGLE MAPS -->

    <section class="corpo corpo-internas corpo-representantes">
      <div class="container container-representantes">
        <h2 class="col-lg-12 text-center title-representantes">CONTATO</h2>
        <div class="col-lg-12 container-contato">
          <div class="col-lg-6 map map-contato">
            <div class="mapa"></div>
            <div class="col-lg-12 infos infos-contato">
              <div class="item-representante">
                <span class="rua">Avenida Sanhaço Rei, 300</span>
                <span class="bairro-cidade-estado">Jardim Santa Alice - Arapongas - PR</span>
                <span class="fone">043 3152 8740</span>
                <span class="nome">043 8817 7575</span>
              </div>
              <!-- Google Map -->
              <div id="map_canvas"></div>
            </div>
          </div>
          <div class="col-lg-6 formulario formulario-contato">
            <form name="contato" id="contato" validate action="contacts.php" method="post" class="col-lg-12 form-rep">
              <div class="control-group form-group">
                <div class="controls">
                  <input type="hidden" class="form-control" id="tipo" name="tipo" value="contato">
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
          <div class="col-lg-6 formulario formulario-trabalhe-conosco">
            <form name="contato" id="contato" validate action="contacts.php" method="post" class="col-lg-12 form-rep form-rep-trabalhe" enctype="multipart/form-data">
              <div class="control-group form-group">
                <div class="controls">
                  <label for="arquivo">Trabalhe conosco</label>
                  <input type="hidden" class="form-control" id="tipo" name="tipo" value="representantes">
                  <input type="text" class="form-control" id="nome" name="nome" required Placeholder="Nome">
                </div>
              </div>
              <div class="control-group form-group">
                <div class="controls">
                  <div class="controls">
                    <input type="file" id="arquivo" name="arquivo" required placeholder="Escolha o arquivo" class="form-control arquivo pull-left">
                    <input type="hidden" class="form-control" id="tipo" name="tipo" value="trabalhe">
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary btn-envia-form pull-right">Enviar</button>
                  </div>
                </div>
              </div>
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
        initializeMaps();
        $("[data-mask]").inputmask();
    </script>

  </body>
</html>