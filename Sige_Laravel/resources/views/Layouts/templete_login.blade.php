<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.8.2-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilo_.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estiloN.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estiloX.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Teste.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Popupi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-pequeno.css')}}">
    <link rel="stylesheet" href="{{ asset('css/inputDiv.css')}} ">
    <link rel="stylesheet" href="{{ asset('css/main-menu.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu-pequeno.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style_templete.css')}}">    
</head>
<body>

    <!--Aqui Fica o corpo da pagina-->
    <div class="menuT top-margin">
        @yield('corpo')     
    </div>

    <!--Rodape-->
    <div>
        <div class="row ">
            <footer class="fixed-bottom bg-nav">
                <p id="pp">&copy;Copyright <?php echo date('Y');?> | SIGE YOUNG | Sobre Nós</p>
            </footer>
        </div>
    </div>    
    
    <!-- Javascripts-->
    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- Include Smartwizard -->
    <script src="{{ asset('js/validator.js') }} "></script>
    <script src="{{ asset('js/popper.js') }} "></script>



    <script>
        $('#usuario').focusin(function() {
            $('.us').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#usuario').focusout(function() {
            $('.us').css("box-shadow","none");
        });
    </script>

    <!-- =================================================================-->
    <script>
        $('#password').focusin(function() {
        $('.pass').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#password').focusout(function() {
        $('.pass').css("box-shadow","none");
        });
    </script>

    <!-- =================================================================-->

    <script>
        $('#newPass').focusin(function() {
        $('.us').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#newPass').focusout(function() {
        $('.us').css("box-shadow","none");
        });
    </script>

    <!-- =================================================================-->

    <script>
        $('#newPass2').focusin(function() {
        $('.pass').css("box-shadow","0 0 0 0.2rem rgba(0, 123, 255, 0.25)");
            
        });

        $('#newPass2').focusout(function() {
        $('.pass').css("box-shadow","none");
        });
    </script>

    <!-- =================================================================-->

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

</body>
<html>