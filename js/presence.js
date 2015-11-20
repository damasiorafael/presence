alturaBody = $("body").height();
larguraBody = $("body").width();

alturaHtml = $("html").height();
larguraHtml = $("html").width();

//CHAMA LOADING NA TELA
chamaLoading = function(){
  $(".loading-overlay").css({
    "width" : larguraBody,
    "height" : alturaHtml
  });
  $(".loading-overlay").fadeIn();
  $(".loading").fadeIn();
}

//FECHA LOADING NA TELA
fechaLoading = function(){
  $(".loading-overlay").fadeOut();
  $(".loading").fadeOut();
}

//CONTATO - REPRESENTANTES
$("#contato").on("submit", function(e){
  e.preventDefault();
  e.stopPropagation();
  var $this = $(this);
  chamaLoading();
  $.ajax({
    type: "POST",
    url: "contacts.php",
    data: $this.serialize(),
    success: function(data){
      fechaLoading();
      if(data == "sucesso"){
        $(".modal-contato .box-body .alert-success p").html("Mensagem enviada com sucesso!");
        $(".modal-contato .box-body .alert-danger").fadeOut();
        $(".modal-contato .box-body .alert-warning").fadeOut();
        $(".modal-contato .box-body .alert-success").fadeIn();
        $(".btn-auto-contato").trigger('click');
        $(".modal, .modal .close, .modal .btn").on("click", function(){
          $this.find("textarea").val("");
          $this.find("input").each(function(){
            var $this = $(this);
            var thisName = $this.attr("name");
            if(thisName != "tipo"){
              $this.val("");
            }            
          });
        });
      } else {
        $(".modal-contato .box-body .alert-danger p").html(data);
        $(".modal-contato .box-body .alert-warning").fadeOut();
        $(".modal-contato .box-body .alert-success").fadeOut();
        $(".modal-contato .box-body .alert-danger").fadeIn();
        $(".btn-auto-contato").trigger('click');
      }
    },
    error: function(data){
      fechaLoading();
      $(".modal-contato .box-body .alert-danger p").html("Houve um erro ao enviar a mensagem, por favor tente novamente!");
      $(".modal-contato .box-body .alert-warning").fadeOut();
      $(".modal-contato .box-body .alert-success").fadeOut();
      $(".modal-contato .box-body .alert-danger").fadeIn();
      $(".btn-auto-contato").trigger('click');
    }
  });
});

$(".form-rep-trabalhe").on("submit", function(){
  chamaLoading();
  var options = {
    target: '.alert-dismissable p',
    success: function(data){
      fechaLoading();
      if(data == "sucesso"){
        $(".modal-contato .box-body .alert-success p").html("Mensagem enviada com sucesso!");
        $(".modal-contato .box-body .alert-danger").fadeOut();
        $(".modal-contato .box-body .alert-warning").fadeOut();
        $(".modal-contato .box-body .alert-success").fadeIn();
        $(".btn-auto-contato").trigger('click');
        $(".modal, .modal .close, .modal .btn").on("click", function(){
          $this.find("input").val("");
        });
      } else {
        fechaLoading();
        $(".modal-contato .box-body .alert-danger p").html(data);
        $(".modal-contato .box-body .alert-warning").fadeOut();
        $(".modal-contato .box-body .alert-success").fadeOut();
        $(".modal-contato .box-body .alert-danger").fadeIn();
        $(".btn-auto-contato").trigger('click');
      }
    }
  };
  $(".form-rep-trabalhe").ajaxForm(options);
});