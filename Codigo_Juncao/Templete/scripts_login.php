<script src="_js/contador.js"></script>
   <script>
    $('#usuario').focusin(function() {
      $('.us').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#usuario').focusout(function() {
       $('.us').css("box-shadow","none");
    });
 </script>

    <script>
    $('#password').focusin(function() {
      $('.pass').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#password').focusout(function() {
       $('.pass').css("box-shadow","none");
    });
 </script>

 <script>
    $('#newPass').focusin(function() {
      $('.us').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#newPass').focusout(function() {
       $('.us').css("box-shadow","none");
    });
 </script>

 <script>
    $('#newPass2').focusin(function() {
      $('.pass').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
        
    });

    $('#newPass2').focusout(function() {
       $('.pass').css("box-shadow","none");
    });
 </script>

 
<script>

    function popup() {
        var modal = document.getElementById("myModal");
        var modalii = document.getElementById("modelo");
        modal.style.display = "block";
        modelo.style.width = "40%";

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    function closed() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

</script>

<script src="_js/busca_candidatos_registados.js"></script>

