
    <script>
    $('#pesquisar').focusin(function() {
      $('.pesq').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#pesquisar').focusout(function() {
       $('.pesq').css("box-shadow","none");
    });
  </script>