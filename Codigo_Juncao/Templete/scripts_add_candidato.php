<script src="_js/contador.js"></script>
   <script>
    $('#nome_candidato').focusin(function() {
      $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#nome_candidato').focusout(function() {
       $('.pesq').css("box-shadow","none");
    });
 </script>
<script src="_js/busca_candidatos_registados.js"></script>