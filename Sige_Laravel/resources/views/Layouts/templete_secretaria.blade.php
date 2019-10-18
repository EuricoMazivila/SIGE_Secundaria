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

    <!-- Optional SmartWizard theme -->
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizardd.css')}}"/>
    <link rel="stylesheet" href="{{ asset('js/jquery/smartwizard/css/smart_wizard_dots.css')}}"/>
    
</head>
<body>
    <!--Aqui Fica o nav Bar-->
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
                <div>
                    <span class="i-color-white i-tamanho ">
                        <!--icone de bell -->
                        <i class="fas fa-bell md-2"></i>
                    </span>

                    <span class="i-color-white i-tamanho ">
                        <!--icone de envelope  -->
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="i-color-white">
                        
                    </span>
                </div>
        
                <div class="usermov">      
                    <li class="nav-item dropdown show">
                        <a class="nav-link dropdown- text-muted" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="{{ asset('img/call-nerds.png') }}"  alt="user" class="profile-pic"></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                <div class="u-img"><img src="{{ asset('img/call-nerds.png') }}" alt="user"></div>
                                <div class="u-text">
                                    
                                    <h6><?php //echo $usuario; ?></h6>
                                    <h3 class="text-muted vee"><?php //echo $email;?></h3>

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
    </div>

    <!--Aqui Fica o Menu e o corpo-->
    <div>
        <div class="main-menu">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-collapse menu-color i-color-white " id="menu-Candidado">
                    <ul class="nav navbar-nav nav-justified " role="menu">
                        <li class="text-left">
                            <a class="btn btn-default btn-lg btn-block text-left" href="{{ route('secretaria.home') }}">
                                <span class="i-color-white">
                                    <i class="fa fa-home fa-2x i-tamanho"></i>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class=" btn btn-default btn-lg btn-block text-left" href="" role="button">
                                <span class="i-color-white">
                                    <i class="fa fa-user-circle fa-2x i-tamanho"></i>
                                    Meu perfil
                                </span>
                            </a>
                        </li>
                        <!--Matricula sm-->
                        <div class="menu-sm">
                            <li class="dropdown menu-sm">
                                <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle" data-toggle="dropdown"
                                    href="">
                                    <span class="i-color-white">
                                        <i class="fa fa-paperclip fa-2x i-tamanho"></i>
                                        Matricula
                                    </span>
                                    <span class="caret i-tamanho"></span>
                                </a>
                                <ul class="dropdown-menu navbar-right menu-color" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="{{ route('secretaria.matricularstep0') }}">
                                            <span class="i-color-white"> <i class="fa fa-edit fa-2x i-tamanho"></i>

                                                Matricular Aluno
                                            </span>
                                        </a>
                                    </li>
                                    <li class="has-subnav">
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                            <span class="i-color-white"><i class=" fa fa-plus-square fa-2x i-tamanho"></i>

                                                Ver o estado
                                            </span>
                                        </a>
                                    </li>
                                    <li class="has-subnav">
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="{{route('secretaria.listacandidatos') }}">
                                            <span class="i-color-white"> <i class="fa fa-plus-square fa-2x i-tamanho"></i>

                                                Lista de Candidatos
                                            </span>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                </ul>
                            </li>

                            <!--Turma sm-->
                            <li class="dropdown menu-sm">
                                <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle" data-toggle="dropdown"
                                    href="">
                                    <span class="i-color-white"> <i class="fa fa-book-open fa-2x i-tamanho"></i>
                                        Turmas
                                        <i class="caret "></i>
                                    </span>
                                    <span class="caret i-tamanho"></span>
                                </a>
                                <ul class="dropdown-menu navbar-right menu-color" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="step0.html">
                                            <span class="i-color-white">
                                                <i class="i-tamanho"> </i>
                                                Professores
                                            </span>
                                        </a>
                                    </li>
                                    <li class="has-subnav">
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                            <span class="i-color-white">
                                                <i class="i-tamanho"> </i>
                                                Alunos
                                            </span>
                                        </a>
                                    </li>
                                    <li class="has-subnav">
                                        <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                            <span class="i-color-white">
                                                <i class="i-tamanho"> </i>
                                                Horarios
                                            </span>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                        </div>


                        <!--Matricula md-->
                        <li class="has-subnav menu-md">
                            <a class="btn btn-default btn-lg btn-block  text-left" href="#">
                                <span class="i-color-white">
                                    <i class="fa fa-paperclip fa-2x i-tamanho"></i>
                                    Matricula
                                </span>
                            </a>

                            <ul class="nav navbar-nav nav-justified">
                                <li>
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="{{ route('secretaria.matricularstep0') }}">
                                        <span class="i-color-white"> <i class="fa fa-edit fa-2x i-tamanho"></i>

                                            Matricular Aluno
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                        <span class="i-color-white"><i class=" fa fa-plus-square fa-2x i-tamanho"></i>

                                            Ver o estado
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="{{route('secretaria.listacandidatos') }}">
                                        <span class="i-color-white"> <i class="fa fa-plus-square fa-2x i-tamanho"></i>

                                            Lista de Candidatos
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--Turma md-->
                        <li class="has-subnav menu-md">
                            <a class="btn btn-default btn-lg btn-block  text-left" href="#">
                                <span class="i-color-white"> <i class="fa fa-book-open fa-2x i-tamanho"></i>
                                    Turmas
                                    <i class="caret "></i>
                                </span>
                            </a>
                            <ul class="nav navbar-nav nav-justified">
                                <li>
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                        <span class="i-color-white">
                                            <i class="i-tamanho"> </i>
                                            Professores
                                        </span>
                                    </a>
                                </li>
                                <li class="has-subnav">
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                        <span class="i-color-white">
                                            <i class="i-tamanho"> </i>
                                            Alunos
                                        </span>
                                    </a>
                                </li>
                                <li class="has-subnav">
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                        <span class="i-color-white">
                                            <i class="i-tamanho"> </i>
                                            Horarios
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                <span class="i-color-white">
                                    <i class="fa fa-server fa-2x i-tamanho"></i>
                                    Gerir Horarios
                                </span>
                            </a>
                        </li>
                        <li>

                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                <span class="i-color-white"> <i class="fa fa-magic fa-2x i-tamanho"></i>
                                    Operações
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                <span class="i-color-white">
                                    <i class="fa fa-info fa-2x i-tamanho"></i>
                                    Ajuda & Suporte
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                <span class="i-color-white">
                                    <i class="fa fa-cogs fa-2x i-tamanho"></i>
                                    Definições
                                </span>
                            </a>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav nav-justified" role="menu">
                        
                    </ul>

                </div>
            </nav>
        </div>
        <!--Aqui Fica o corpo da pagina-->
        <div class="menuT top-margin">
            <!--breadcrumb -->
            <div class="row">
                <ol class="breadcrumb col-12">
                    @yield('caminho') <!--Para adicisao de caminho de retorno -->
                    <small id="lect">Ano lectivo <?php echo date('Y');?></small>
                </ol>
            </div>
            <div>
                @yield('corpo')
            </div>     
        </div>
    </div>

    <!--Rodape-->
    <div>
        <div class="row ">
            <footer class="fixed-bottom bg-nav">
                <p id="pp">&copy;Copyright <?php echo date('Y');?> | SIGE YOUNG | Sobre Nós</p>
            </footer>
        </div>
    </div>


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