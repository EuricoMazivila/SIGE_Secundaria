
<script>
    $(function () {
        $('.size').styleddropdown();
    });
</script>

 <script>

    $('#nome_candidato').focusin(function() {
      $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#nome_candidato').focusout(function() {
       $('.pesq').css("box-shadow","none");
    });
 
 </script>

<script src="../../_js/busca_candidatos_registados.js"></script>

<script>
	$(document).ready(function(){
    $('#nome_candidato').keyup(function(){
    	/* var dados=$(this).val();
    	$.post('../../Dao/processa_candidato.php', {nome_candidato_m: dados}, function (data) {

     $('#resultado').empty().html(data); 
});*/

      $('form').submit(function(){
            var dados=$(this).serialize();
            $.ajax({
                url: '../../Dao/processa_candidato.php',
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
                url: '../../Dao/processa_candidato.php',
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


</script>