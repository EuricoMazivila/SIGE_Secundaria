<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <!--Esta-se a utilizar o bootstrap.css e min ao mesmo tempo porque -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.8.2-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estiloO.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estiloX.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Teste.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Popupi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-pequeno.css')}}">
    <link rel="stylesheet" href="{{ asset('css/inputDiv.css')}} ">
    <link rel="stylesheet" href="{{ asset('css/main-menu.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu-pequeno.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style_templete.css')}}">

    <!-- Optional SmartWizard theme -->
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/_css/smart_wizardd.css') }}"/>
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/_css/smart_wizard_dots.css') }}"/>
    
</head>
<body>
<!--
    <div class="fixed-top bg-nav bottom-margin">
        <div>
            <button class="btn-menu bg-nav menu-sm">
                <i class="fa fa-bars fa-lg"></i>
            </button>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header navbar-right mb-3">
                <a class="navbar-brand h1 mb-0" href="#">SIGE</a>
            </div>
    
            <div class="usermov">      
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown- text-muted" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="{{ asset('img/call-nerds.png') }}" alt="user" class="profile-pic"></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="dropdown-user">
                        <li>
                            <div class="dw-user-box">
                            <div class="u-img"><img src="{{ asset('img/call-nerds.png') }}" alt="user"></div>
                            <div class="u-text">
                                <h6><?php //echo $usuario; ?></h6>
                            </div>
                            </div>
                        </li>
                        <p class="espa" align="center"><?php //echo $local;?></p>
                        <li role="separator" class="divider"></li>

                        <li><a href="#"><i class=" fas fa-user-circle ti-user"></i> My Profile</a></li>
                            <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="fas fa-cogs o ti-email"></i> Inbox</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="fas fa-power-off ti-settings"></i> Account Setting</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href=""><i class="fas fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>  
            </div>
        </nav>
    </div>
-->
    <!--Corpo-->
    <div>
        @yield('corpo')
    </div>

    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/highcharts.js') }}"></script>
    <script src="{{ asset('js/modules/exporting.js') }}"></script>
    <script src="{{ asset('js/modules/export-data.js') }}"></script>
    <script src="{{ asset('js/contador.js') }}"></script> 

    <!--
    <script src="fileinput/_js/fileinput.js"></script>
    <script src="_js/fileinput.js"></script>
    -->
   
   <!--Formulario do Candidato-->
   <script src="{{ asset('js/steps_pre_matricula.js') }} "></script>
    <!-- Include Smartwizard -->
    <script src="{{ asset('js/validator.js') }} "></script>
    <script src="{{ asset('js/jquery/smartwizard/_js/jquery.smartWizardd.js') }} "></script>
    <script src="{{ asset('js/popper.js') }} "></script>
    
    <script>
        $('.btn-menu').click(function () {
            $('.menuS').fadeToggle(5);
            $('.menuT').fadeToggle(4);
        });
    </script>

    @stack('scripts')
</body>
<html>