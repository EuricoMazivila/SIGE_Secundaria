$(document).ready(function(){
    $('#ano_mat').click(function(){
        $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: 'Dao/processa_matricula.php',
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
    $('#classe').click(function(){
        $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: 'Dao/processa_matricula.php',
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
    $('#nome_aluno').keyup(function(){
        $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: 'Dao/processa_matricula.php',
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
