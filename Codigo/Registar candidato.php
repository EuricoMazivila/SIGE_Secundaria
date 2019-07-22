<?php
    session_start();
    if(!isset($_SESSION['ususario']) && !isset($_SESSION['senha'])){
        header('Location: Login_Principal.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.8.2-web/css/all.css">
    <link rel="stylesheet" href="_css/MenLateral.css">
    <link rel="stylesheet" href="_css/menu.css">
    <link rel="stylesheet" href="_css/Grafico.css">
    <link rel="stylesheet" href="_css/graficosEstatiscticos.css">

    <!--   <link rel="stylesheet" href="_css/style.css">-->

    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/_js/bootstrap.js"></script>
    <script src="bootstrap/_js/bootstrap.min.js"></script>
    <script src="_js/highcharts.js"></script>
    <script src="_js/modules/exporting.js"></script>
    <script src="_js/modules/export-data.js"></script>
    <script src="_js/contador.js"></script>


    <title>Registar candidato</title>
</head>

<body>
    <div class="container">
            <div class="fixed-top  bg-nav">
                    <a>
                        <button class="btn-menu navbar-toggle navbar-brand bg-nav menu-sm">
                            <i class="fa fa-bars fa-lg"></i></button>
                    </a>
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
        
                        </div>
                        <div>
                            <span class="i-color-white" id="bel">
                                <!--icone de bell -->
                                <i class="fas fa-bell i-tamanho"></i>
                            </span>
        
                            <span class="i-color-white" id="env">
                                <!--icone de envelope  -->
                                <i class="fas fa-envelope i-tamanho"></i>
                            </span>
                        </div>
                        <div>
                            <form class="navbar-form navbar-left">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>Ricardo</option>
                                        <option>Sobre nos</option>
                                        <option>Sair</option>
                                    </select>
                                </div>
                            </form>
        
                        </div>
        
                    </nav>
                </div>
        <div class="containe-fluid top-margin">
            <div class="menuS collapse">
                <div class="main-menu">
                    <nav class="navbar navbar-inverse" role="navigation">
                        <div class="navbar-collapse menu-color i-color-white" id="menu-Candidado">
                            <ul class="nav navbar-nav nav-justified " role="menu">
                                <li class="text-left">
                                    <a class="btn btn-default btn-lg btn-block text-left" href="">
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
                                        <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle"
                                            data-toggle="dropdown" href="">
                                            <span class="i-color-white">
                                                <i class="fa fa-paperclip fa-2x i-tamanho"></i>
                                                Matricula
                                            </span>
                                            <span class="caret i-tamanho"></span>
                                        </a>
                                        <ul class="dropdown-menu navbar-right menu-color"
                                            aria-labelledby="dropdownMenu1">
                                            <li>
                                                <a class="btn btn-default btn-lg btn-block  text-left"
                                                    href="step0.html">
                                                    <span class="i-color-white"> <i
                                                            class="fa fa-edit fa-2x i-tamanho"></i>

                                                        Matricular Aluno
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white"><i
                                                            class=" fa fa-plus-square fa-2x i-tamanho"></i>

                                                        Ver o estado
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white"> <i
                                                            class="fa fa-plus-square fa-2x i-tamanho"></i>

                                                        Registar candidato
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                        </ul>
                                    </li>

                                    <!--Turma sm-->
                                    <li class="dropdown menu-sm">
                                        <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle"
                                            data-toggle="dropdown" href="">
                                            <span class="i-color-white"> <i class="fa fa-book-open fa-2x i-tamanho"></i>
                                                Turmas
                                                <i class="caret "></i>
                                            </span>
                                            <span class="caret i-tamanho"></span>
                                        </a>
                                        <ul class="dropdown-menu navbar-right menu-color"
                                            aria-labelledby="dropdownMenu1">
                                            <li>
                                                <a class="btn btn-default btn-lg btn-block  text-left"
                                                    href="step0.html">
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
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="step0.html">
                                                <span class="i-color-white"> <i class="fa fa-edit fa-2x i-tamanho"></i>

                                                    Matricular Aluno
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="#">
                                                <span class="i-color-white"><i
                                                        class=" fa fa-plus-square fa-2x i-tamanho"></i>

                                                    Ver o estado
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="#">
                                                <span class="i-color-white"> <i
                                                        class="fa fa-plus-square fa-2x i-tamanho"></i>

                                                    Registar candidato
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
                                <li class="logout">
                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                        <span class="i-color-white"> <i class="fa fa-power-off fa-2x i-tamanho"></i>
                                            Logout
                                        </span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
            <div class="menuT offset-1 ">
                <div class="container">
                    <div class="row top-margin">
                        <ol class="breadcrumb col-10 col-sm-12">
                            <li><a href="Home_page Secretaria11.html">Home</a></li>
                            <li><a href="Candidatos.html">Gestao de candidatos</a></li>
                            <small id="lect">Ano lectivo 2019</small>

                        </ol>
                    </div>
                    <div class="page-header">
                        <h3 class="mt-5 offset-md-1 text-center">Registar candidato</h3>
                        <hr class="light">
                        </hr>
                    </div>
                    <form method="POST" role="form" action="Dao/processa_candidato.php">
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="digitNome">Nome</label>
                                <input type="text" name="nome" id="digitNome" class="form-control" required
                                    placeholder="Introduza o Apelido">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5 offset-sm-2">
                                <label for="pickClasse">Classe anterior</label>
                                <select class="form-control" id="pickClasse" name="classe_anter">
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="pickClass">Classe a matricular</label>
                                <select class="form-control" id="pickClass" name="classe_matr">
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5 offset-sm-2">
                                <label for="pickProv">Provincia da escola de origem</label>
                                <select class="form-control" id="pickProv" name="provincia">
                                    <option>Cidade de Maputo</option>
                                    <option>Gaza</option>
                                    <option>Inhambane</option>
                                    <option>Tete</option>
                                    <option>Cabo Delgado</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="pickDist">Distrito da escola de origem</label>
                                <select class="form-control" id="pickDist" name="distrito">
                                    <option>KaMavota</option>
                                    <option>Kamubukwana</option>
                                    <option>KaLhamankulo</option>
                                    <option>KaTembe</option>
                                    <option>KaNhaka</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5 offset-sm-2">
                                <label for="pickTurno">Regime</label>
                                <select class="form-control" id="pickTurno" name="regime">
                                    <option>Diurno</option>
                                    <option>Nocturno</option>
                                    <option>A distancia</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 ">
                                <label>Escola de origem</label>
                                <select class="form-control" name="escola">
                                    <option>Escola Secundaria Joaquim Chissano</option>
                                    <option>Escola Secundaria Herois Mocambicanos</option>
                                    <option>Escola Secundaria Quisse Mavota</option>
                                    <option>Escola Secundaria Santa Montanha</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-2">
                                <a class="btn btn-danger btn-block" href="Candidato.php"> <i class="fa fa-window-close"></i>Cancelar</a>
                            </div>
                            <div class="form-group col-2 offset-1">
                                <button class="btn btn-success btn-block" name="registar"><i class="fa fa-save"></i>Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $('.btn-menu').click(function () {
                $('.menuS').fadeToggle(5);
                $('.menuT').fadeToggle(4);


            })
        </script>
        <script src="_js/contador.js"></script>

        <div class="row ">
            <!--Rodape-->
            <footer class="fixed-bottom bg-nav">
                <p id="pp">&copy;Copyright 2019 | SIGA YOUNG | Sobre Nós</p>
            </footer>
        </div>
</body>

</html>