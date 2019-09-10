<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/estilo_.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/Testando.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/Popup.css') }}" type="text/css" rel="stylesheet">
 <!--Links Novos--->
    <link href="{{ asset('css/style/main-menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/pesquisasDiv.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/menu-pequeno.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style/style_templete.css') }}" rel="stylesheet">
</head>
<body>

<!--Navbar-->
<div>
    <div class="fixed-top bg-nav">
        <div>
            <button class="btn-menu bg-nav menu-sm">
                <i class="fa fa-bars fa-lg"></i></button>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header navbar-right">
                <a class="navbar-brand h1 mb-0" href="#">SIGE</a>
            </div>
            <div class="navbar-center">
                <span class="i-color-white i-tamanho">
                    <!--icone de bell -->
                    <i class="fas fa-bell i-tamanho "></i>
                </span>

                <span class="i-color-white i-tamanho">
                    <!--icone de envelope  -->
                    <i class="fas fa-envelope i-tamanho"></i>
                </span>
            </div>
            <div class="navbar-left form-group">
                <select class="form-control">
                    <option>Ricardo</option>
                    <option>Sobre nos</option>
                    <option>Sair</option>
                </select>
            </div>
        </nav>
    </div>
</div>

    <!--Aqui Fica o Menu-->
    <div>
        <div class="top-margin">
            <div class="menuS collapse">
                <div>
                    @yield('menu') <!--Para adicionar o Menu -->
                </div>    
            </div>

            <!--Aqui Fica o corpo da pagina-->
            <div class="menuT top-margin">
                <!--breadcrumb -->
                <div class="row">
                    <ol class="breadcrumb col-12">
                        <li class="offset-sm-1"><a href="#">Home</a></li>
                        @yield('caminho') <!--Para adicisao de caminho de retorno -->
                        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
                    </ol>
                </div>
                @yield('corpo') 
            </div>
        </div>
    </div>        

    <!--Rodape-->
    <div>
        <div class="row ">
            <!--Rodape-->
            <footer class="fixed-bottom bg-nav">
                <p id="pp">&copy;Copyright <?php echo date('Y');?> | SIGA YOUNG | Sobre Nós</p>
            </footer>
        </div>
    </div>    

    <!--Arquivos javascript-->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/highcharts.js')}}"></script>
    <script src="{{asset('js/modules/exporting.js')}}"></script>
    <script src="{{asset('js/modules/export-data.js')}}"></script>
    <script src="{{asset('js/script/contador.js')}}"></script>
    <script>
        $('.btn-menu').click(function () {
            $('.menuS').fadeToggle(5);
            $('.menuT').fadeToggle(4);
        });
    </script>
    @stack('scripts')<!--Para adicionar arquivos de javascript particulares   !--> 

</body>
</html>