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

    <link rel="stylesheet" href="{{ asset('plugin/fileinput/css/fileinput.css')}}">

    <!-- Optional SmartWizard theme -->
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizardd.css')}}"/>
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizard_dotsc.css')}}"/>

</head>

<body>
    <div>
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
                    <ul>
                        <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i> Sair</a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>
    </div>
    <!--Corpo-->
    <div class="mt-5">
        @yield('corpo')
    </div>

    <div class="mt-4">
    </div>

    <!-- Javascripts-->
    <script src="{{ asset('js/jquery/jquery.js') }}"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/steps_pre_matricula.js') }}"></script>

    <script src="{{ asset('plugin/fileinput/js/fileinput.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>

    <!-- Include Smartwizard -->
    <script src="{{ asset('js/validator.js') }} "></script>
    <script src="{{ asset('js/jquery/smartwizard/js/jquery.smartWizardd.js') }} "></script>

    <script src="{{ asset('js/popper.js') }} "></script>
    @stack('scripts')
</body>
<html>
