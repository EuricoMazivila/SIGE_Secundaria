<script>

  $('.Sim').hide();
  $('.Nao').hide();
  $('#idDir').hide();
  $('.pesquisar').focusin(function () {
    $('.pesq').css("box-shadow", "0 0 0 0.2rem rgba(0, 123, 255, 0.25)");

  });

  $('.pesquisar').focusout(function () {
    $('.pesq').css("box-shadow", "none");
  });

  $('#verConta').change(function () {
    var idProv = $(this).val();
    if ($(this).val() > 1) {
      $('.Sim').hide();
      $('.Nao').show();
    }
    else {
      $('.Sim').show();
      $('.Nao').hide();

    }
  });
  $('#logout').click(function () {
    var pesquisa="Sair";
   // $('#logout1').html(pesquisa);
 //   alert(pesquisa);
 $.post('../Dao/Pesquisa_dados.php', {logout: pesquisa }, function (data) {

$('#logout1').html(data);
});
alert(pesquisa);
     
     
    });
  $('#buscaEscola').keyup(function () {
    var pesquisa = $(this).val();
    $.post('../Dao/processa_escola.php', { buscaEscola: pesquisa }, function (data) {

      $('#ResultadoEscolaBusca').html(data);
    });

  });
  $('#NumeroConta').keyup(function () {
    var pesquisa = $(this).val();
    alert(pesquisa);


  });
/*
    
    /*
    $('#provincia').change(function () {
        var idProv = $(this).val();
        //   $.post('url', name:post);
        $.post('php/busca_dados.php',
            { idProv: idProv }, function (data) {
                //retorna as opcoes da busca no banco de dados
                $('#distrito').html(data);
            });
    });*/

</script>