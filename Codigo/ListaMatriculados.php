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


    <!--   <link rel="stylesheet" href="_css/estilo_.css">  <link rel="stylesheet" href="_css/style.css">-->

    <script src="jquery/jquery.js"></script>
    <script src="bootstrap/_js/bootstrap.js"></script>
    <script src="bootstrap/_js/bootstrap.min.js"></script>
    <script src="_js/highcharts.js"></script>
    <script src="_js/modules/exporting.js"></script>
    <script src="_js/modules/export-data.js"></script>
    <script src="_js/contador.js"></script>
    <script src="_js/busca_alunos_matriculados.js"></script>
    


    <title>Templete</title>
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
                        <h3 class="mt-5 offset-md-1 text-center">Lista de Matriculados</h3>
                        <hr>
                        </hr>
                    </div>
                    <div class="col-md-9">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-2 col-sm-1">
                                    <label for="ano_mat">Ano </label>

                                </div>
                                <div class="form-group col-9 col-sm-3  offset-1">
                                    <select name="ano_mat" id="ano_mat" class="form-control">
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option selected>2019</option>
                                        <option>2020</option>
                                    </select>
                                </div>
                                <div class="form-group col-2 col-sm-1  offset-sm-2">
                                    <label for="classe">Classe </label>

                                </div>
                                <div class="form-group col-9 col-sm-3  offset-1">
                                    <select name="classe" id="classe" class="form-control">
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                            </div>
                        </form>    

                        <div class="mt-3 table-responsive" id="resultado">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nome</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once("Dao/conexao.php");
                                        
                                        //Estágio 1: Preparação
                                        $query="SELECT codal,nome,data from alunos_matriculados"; /*where ano=year(curdate())*/;
                                        
                                        $stmt=$conexao->prepare($query);
                                        if(!$stmt){
                                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                                        }
                                
                                        // Estágio 2: execução
                                        if(!$stmt->execute()){
                                            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
                                        }
                                
                                        // Estágio 3: Obtenção de dados    
                                        $res=$stmt->get_result();
                                        if(!$res){
                                            echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                                        }
                            
                                        $linhas=$res->num_rows;
                                    
                                        for($j=0; $j<$linhas; ++$j){
                                            $res->data_seek($j);
                                            $linha=$res->fetch_assoc();
                                    ?>
                                    <tr>
                                        <td><?php echo $linha['codal']?></td>
                                        <td><?php echo $linha['nome']?></td>
                                        <td><?php echo $linha['data']?></td>
                                    </tr>
                                    <?php 
                                        } 
                                        $stmt->close();
                                        $conexao->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="">
                                <nav class="menu-small">
                                    <ul>
                                        <li>
                                            <a href="#top">
                                                Tabela
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#containerP">
                                                <i class="fa fa-chart-bar fa-2x"></i>
                                            </a>
                                        </li>
            
                                        <li>
                                            <a href="#containerB">
                                                <i class="fa fa-chart-pie fa-2x"></i>
            
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="btn btn-default btn-lg btn-block  text-left btn-primary" href="">
                                <span class="i-color-white"> <i class="fas fa-print "></i>
                                    Imprimir
                                </span>
                            </a>
                        </div>
                    </div>


                    <div class="row">
                        <div class="mt-5 col-12 ">
                            <h3 class="text-center">Graficos Estatisticos</h3>
                            <hr>
                            </hr>
                        </div>

                        <div class="col-md-6">
                            <div id="containerP" class="contaGrafico">
                                <script src="_js/Grafico_Pizza.js"></script>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="containerB" class="contaGrafico">
                                <script src="_js/Grafico_Barras.js"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div>
            <div id="containerB" style=""></div>
            <script src="_js/Grafico_Barras.js"></script>
        </div>

    </div>



    </div>
    <script>
        $('.btn-menu').click(function () {
            $('.menuS').fadeToggle(5);
            $('.menuT').fadeToggle(4);


        })
    </script>
    <!--<script>
        $('.btn-menu').click(function () {
            $('.menuT').toggle();

        })
    </script>-->
    <script src="_js/contador.js"></script>

    <div class="row ">
        <!--Rodape-->
        <footer class="fixed-bottom bg-nav">
            <p id="pp">&copy;Copyright 2019 | SIGA YOUNG | Sobre Nós</p>
        </footer>
    </div>
</body>

</html> 