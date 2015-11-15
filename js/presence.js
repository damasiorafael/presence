$("#contato").on("submit", function(e){
  e.preventDefault();
  e.stopPropagation();
  var $this = $(this);

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
            $this.find("input, textarea").val("");
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