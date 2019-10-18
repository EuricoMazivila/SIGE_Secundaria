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
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizardd.css')}}"/>
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizard_dots.css')}}"/>
    
</head>
<body>


    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <!--Tabela Buasca de Candidatos registados sem refresh-->
    <script src="{{ asset('js/js/busca_candidatos_registados.js') }}"></script>
    <!--Tabela Buasca de Alunos Matriculados sem refresh-->
    <script src="{{ asset('js/busca_alunos_matriculados.js') }}"></script>
    
    <script src="{{ asset('js/Telinha.js') }}"></script>

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