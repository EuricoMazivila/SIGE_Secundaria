$(document).ready(function(){
    $('#nome_candidato').keyup(function(){
        $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: 'Dao/processa_candidato.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function(data){
                   $('#resultado').empty().html(data); 
                }
            });
            return false;
        });
        $('form').trigger('submit');
    });
});
    
$(document).ready(function(){
    $('#ano').click(function(){
        $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: 'Dao/processa_candidato.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function(data){
                   $('#resultado').empty().html(data); 
                }
            });
            return false;
        });
        $('form').trigger('submit');
    });
});

