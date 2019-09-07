//Funciona quando se seleciona o Pais
$('#pais').change(function () {
    var idPais = $(this).val();
    //   $.post('url', name:post);
            $.post('php/busca_dados.php', { idPais: idPais }, function (data) {
            //retorna as opcoes da busca no banco de dados
            $('#provincia').html(data);
        });    
});
//Funciona quando se seleciona a Provincia
$('#provincia').change(function () {
    var idProv = $(this).val();
    //   $.post('url', name:post);
    $.post('php/busca_dados.php',
        { idProv: idProv }, function (data) {
            //retorna as opcoes da busca no banco de dados
            $('#distrito').html(data);
        });
});
//Funciona quando se seleciona o Distrito
$('#distrito').change(function () {
    var iddistrito = $(this).val();
    //   $.post('url', name:post);
    $.post('php/busca_dados.php',
        { iddistrito: iddistrito }, function (data) {
            //retorna as opcoes da busca no banco de dados
            $('#bairro').html(data);

        });
});
$('#pesquisar').keyup(function () {
    var pesquisa = $(this).val();
    
    //   $.post('url', name:post);
    $.post('php/busca_dados.php',
        { pesquisarTabela: pesquisa}, function (data) {
            //retorna as opcoes da busca no banco de dados
            $('#resultadoTabela').html(data);
            
        });
});
