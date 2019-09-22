<script src="_js/contador.js"></script>
   <script>
    $('#nome_aluno').focusin(function() {
      $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#nome_aluno').focusout(function() {
       $('.pesq').css("box-shadow","none");
    });
 </script>

 <script>
    $(function () {
        $('.size').styleddropdown();
    });
 </script>