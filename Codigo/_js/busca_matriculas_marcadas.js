$(document).ready(function(){
    $('#ano_m').click(function(){
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



