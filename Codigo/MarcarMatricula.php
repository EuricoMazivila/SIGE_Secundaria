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
    <link rel="stylesheet" href="_css/Testando.css">
    <link rel="stylesheet" type="text/css" href="_css/Popup.css">

    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/_js/bootstrap.js"></script>
    <script src="bootstrap/_js/bootstrap.min.js"></script>
    <script src="_js/TestandoDisciplina.js"></script>
    <script src="_js/highcharts.js"></script>
    <script src="_js/modules/exporting.js"></script>
    <script src="_js/modules/export-data.js"></script>
    <script src="_js/contador.js"></script>
    <title>Marcar Matricula</title>
    <script>
        $(function () {
            $('.size').styleddropdown();
        });

        function popup() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

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
</head>


<body>
    <div class="container">
        <div class="fixed-top  bg-nav">
            <a>

                <button class="btn-menu navbar-toggle navbar-brand bg-nav menu-sm"><i
                        class="fa fa-bars fa-lg"></i></button>

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
        <div class="containe-fluid top-margin baixo">
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
                                <li>
                                    <a class=" btn btn-default btn-lg btn-block text-left" href="" role="button">
                                        <span class="i-color-white">
                                            <i class="fa fa-money-bill-alt fa-2x i-tamanho"></i>
                                            Pagamentos
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class=" btn btn-default btn-lg btn-block text-left" href="" role="button">
                                        <span class="i-color-white">
                                            <i class="fa fa-users fa-2x i-tamanho"></i>

                                            Funcionários
                                        </span>
                                    </a>
                                </li>
                                <!--Estatísticas sm-->
                                <div class="menu-sm">
                                    <li class="dropdown menu-sm">
                                        <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle"
                                            data-toggle="dropdown" href="">
                                            <span class="i-color-white">
                                                <i class="fa fa-chart-bar fa-2x i-tamanho"></i>
                                                Estatísticas
                                            </span>
                                            <span class="caret i-tamanho"></span>
                                        </a>
                                        <ul class="dropdown-menu navbar-right menu-color"
                                            aria-labelledby="dropdownMenu1">
                                            <li>
                                                <a class="btn btn-default btn-lg btn-block  text-left"
                                                    href="step0.html">
                                                    <span class="i-color-white">
                                                        <i class="fa fa-puzzle-piece fa-2x i-tamanho"></i>

                                                        Gerais
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white"><i
                                                            class="fa fa-user-friends fa-2x i-tamanho"></i>
                                                        Funcionários
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white">
                                                        <i class="fa fa-pencil-alt fa-2x i-tamanho"></i>
                                                        Alunos
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                        </ul>
                                    </li>

                                    <!--Gestão sm-->
                                    <li class="dropdown menu-sm">
                                        <a class="btn btn-default btn-lg btn-block text-left dropdown-toggle"
                                            data-toggle="dropdown" href="">
                                            <span class="i-color-white">
                                                <i class="fa fa-desktop fa-2x i-tamanho"></i>
                                                Gestão

                                            </span>
                                            <span class="caret i-tamanho"></span>
                                        </a>
                                        <ul class="dropdown-menu navbar-right menu-color"
                                            aria-labelledby="dropdownMenu1">
                                            <li>
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white">
                                                        <i class="fa fa-edit fa-2x i-tamanho"></i>
                                                        Matricula
                                                    </span>
                                                    <span class="caret i-tamanho"></span>
                                                </a>
                                                <ul class="dropdown-menu navbar-right menu-color"
                                                    aria-labelledby="dropdownMenu1">
                                                    <li>
                                                        <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                            <span class="i-color-white">
                                                                <i class="fa fa-female fa-2x i-tamanho"></i>
                                                                Marcar matricula
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white"><i
                                                            class="fa fa-plus-square fa-2x i-tamanho"></i>
                                                        Adicionar disciplina
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="has-subnav">
                                                <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                    <span class="i-color-white">
                                                        <i class="fa fa-anchor fa-2x i-tamanho"></i>
                                                        Adicionar classe
                                                    </span>
                                                </a>
                                            </li>

                                            <li class="divider"></li>
                                        </ul>
                                    </li>
                                </div>

                                <li class="has-subnav menu-md">
                                    <a class="btn btn-default btn-lg btn-block text-left" href="">
                                        <span class="i-color-white">
                                            <i class="fa fa-chart-bar fa-2x i-tamanho"></i>
                                            Estatísticas
                                        </span>
                                        <span class="caret i-tamanho"></span>
                                    </a>
                                    <ul class="nav navbar-nav nav-justified" aria-labelledby="dropdownMenu1">
                                        <li>
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="step0.html">
                                                <span class="i-color-white">
                                                    <i class="fa fa-puzzle-piece fa-2x i-tamanho"></i>

                                                    Gerais
                                                </span>
                                            </a>
                                        </li>
                                        <li class="has-subnav">
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                <span class="i-color-white">
                                                    <i class="fa fa-user-friends fa-2x i-tamanho"></i>
                                                    Funcionários
                                                </span>
                                            </a>
                                        </li>
                                        <li class="has-subnav">
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                <span class="i-color-white">
                                                    <i class="fa fa-pencil-alt fa-2x i-tamanho"></i>
                                                    Alunos
                                                </span>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                    </ul>
                                </li>



                                <!--Turma md-->
                                <li class="has-subnav menu-md">
                                    <a class="btn btn-default btn-lg btn-block text-left  " href="">
                                        <span class="i-color-white">
                                            <i class="fa fa-desktop fa-2x i-tamanho"></i>
                                            Gestão
                                            <i class="caret "></i>
                                        </span>
                                        <span class="caret i-tamanho"></span>
                                    </a>
                                    <ul class="nav navbar-nav nav-justified">
                                        <li>
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                <span class="i-color-white">
                                                    <i class="fa fa-edit fa-2x i-tamanho"></i>
                                                    Matricula
                                                </span>
                                            </a>
                                            <ul class="nav navbar-nav nav-justified">
                                                <li>
                                                    <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                        <span class="i-color-white">
                                                            <i class="fa fa-female fa-2x i-tamanho"></i>
                                                            Marcar matricula
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="has-subnav">
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                <span class="i-color-white"><i
                                                        class="fa fa-plus-square fa-2x i-tamanho"></i>
                                                    Adicionar disciplina
                                                </span>
                                            </a>
                                        </li>
                                        <li class="has-subnav">
                                            <a class="btn btn-default btn-lg btn-block  text-left" href="">
                                                <span class="i-color-white">
                                                    <i class="fa fa-anchor fa-2x i-tamanho"></i>
                                                    Adicionar classe
                                                </span>
                                            </a>
                                        </li>

                                        <li class="divider"></li>
                                    </ul>
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
            <!--Corpo-->
            <div class="menuT offset-1 baixo">
                <div class="container">
                    <div class="page-header">
                        <h3 class="mt-5 offset-md-1 text-center">Marcar matrícula</h3>
                        <hr>
                        </hr>
                    </div>

                    <div class="">
                        <form method="POST" role="form" action="Dao/processa_matricula.php">
                            <div class="form-row">
                                <div class="form-group col-4 col-sm-2">
                                    <label for="dataInic">Data de início </label>
                                </div>
                                <div class="form-group col-8 col-sm-4">
                                    <input type="date" name="dataInic" id="dataInic" class="form-control" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-4 col-sm-2">
                                    <label for="_classe">Data de fim </label>
                                </div>
                                <div class="form-group col-8 col-sm-4  ">
                                    <input type="date" name="dataFim" id="dataFim" class="form-control" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="mt-3 table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Classe</th>
                                                <th>Turno</th>
                                                <th>Total de vagas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>8</td>
                                                <td>Diurno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_oita_d"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Noturno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_oita_n"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Diurno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_nona_d"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Noturno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_nona_n"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Diurno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_dec_d"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Noturno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_dec_n"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Diurno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_decp_d"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Noturno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_decp_n"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Diurno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_decs_d"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Noturno</td>
                                                <td>
                                                    <input type="number" class="form-control" name="tot_vagas_decs_n"
                                                        required placeholder="Introduza Total de Vagas">
                                                    <div class="help-block with-errors text-danger"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <a class="btn btn-danger offset-3 mt-5" href="Matriculas.php">
                                        <i class="fa fa-window-close fa-2x"></i>Cancelar
                                    </a>
                                    <button class="btn btn-success offset-1 mt-5" name="marcar_matricula"> 
                                        <i class="fa fa-save fa-2x"></i>Salvar
                                    </button>
                                </div>
                            </div>

                            <div class="size offset-6">
                                <ul class="list">

                                    <li role="button" id="myBtn" onclick="popup()"><a><i
                                                class="fa fa-eraser fa-2x"></i><span>Editar</span></a> </li>
                                </ul>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
            <div id="myModal" class="modal">

                <div class="modal-content">
                    <div class="container">
                        <div class="page-header">
                            <h3 class="mt-5 offset-md-1 text-center">Editar matricula</h3>
                            <hr>
                            </hr>
                        </div>


                        <form method="POST" role="form">

                            <div class="form-row">
                                <div class="form-group col-sm-7 offset-sm-3">
                                    <label for="inputVagas">Total de vagas</label>
                                    <input type="text" name="" id="inputVagas" class="form-control" required
                                        placeholder="Introduza o novo total de vagas">
                                    <div class="help-block with-errors"></div>

                                </div>


                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-3 offset-sm-3">
                                    <button class="btn btn-danger btn-block " onclick="closed()">
                                        <span class="text-left">
                                            <i class="fa fa-window-close fa-2x i-tamanho" role="button"
                                                onclick="popup()"></i>Cancelar
                                        </span>
                                    </button>


                                </div>
                                <div class="form-group col-sm-3 offset-sm-1">
                                    <button class="btn btn-success btn-block">
                                        <span class="text-left">
                                            <i class="fa fa-save fa-2x i-tamanho"></i>Salvar
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        $('.btn-menu').click(function () {
            $('.menuS').fadeToggle(5);
            $('.menuT').fadeToggle(4);
        });
    </script>

    <!--Scripts -->

    <div class="row ">
        <!--Rodape-->
        <footer class="fixed-bottom bg-nav">
            <p id="pp">&copy;Copyright 2019 | SIGA YOUNG | Sobre Nós</p>
        </footer>

    </div>
    <script>
        var t = document.getElementById('tabela'), rIndex;
        var x;

        for (var i = 0; i < t.rows.length; i++) {
            t.rows[i].onclick = function () {

                rIndex = this.rowIndex;
                this.cells[2].innerHTML = x;
                /*this.cells[0].innerHTML = prompt("valor actual: "+this.cells[0].innerHTML+"\nDigite o novo valor: ");*/
            };

            function popup() {
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
                x = document.getElementById('inputVagas').value;

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


        }

    </script>
</body>

</html>