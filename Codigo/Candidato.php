<!DOCTYPE html>
<html lang="en">
<head>
<?php
$titulo="Pagina Candidado";
include_once('metadados.php');
?>
</head>
 
<body>
    <div class="container">
        <?php
        include_once('Config/navbar.php');
        ?>
        <div class="containe-fluid top-margin">
            <!--Adicionando o menu do candidato-->
            <?php
           include_once('Config/menuMatricula.php');
           ?>
            <!--Aqui fica o corpo-->
            <div class="menuT">
                <div class="container">
                    <div class="row top-margin">
                        <ol class="breadcrumb col-10 col-sm-12">
                            <li><a href="Home_page Secretaria11.html">Home</a></li>
                            <li><a href="Candidatos.html">Gestao de candidatos</a></li>
                            <small id="lect">Ano lectivo 2019</small>

                        </ol>
                    </div>
                    <div class="page-header" id="top">
                        <h3 class="mt-5 offset-md-1 text-center">Gestão de candidatos</h3>
                        <hr>
                       
                    </div>
                    <div class="form-row">
                        <div class="form-group col-1 offset-md-1 ">
                            <label for="_ano">Ano </label>

                        </div>
                        <div class="form-group col-5 col-sm-4 offset-1">
                            <select name="_Nome" id="_ano" class="form-control">
                                <option>2014</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                            </select>
                        </div>
                        <div class="form-group col-5 offset-sm-1 col-sm-5 col-md-4 ">
                            <a class="btn btn-default btn-lg btn-block  text-left btn-primary"
                                href="Registar candidato.html">
                                <span class="i-color-white">
                                    Adicionar novo
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-7 col-sm-6 offset-md-1">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Pesquise nome do candidato">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <!--Icon de pesquisa--> <i class="fas fa-print "></i>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group col-5 offset-sm-1 col-sm-5 col-md-4">
                            <a class="btn btn-default btn-lg btn-block  text-left btn-primary" href="">
                                <span class="i-color-white"> <i class="fas fa-print "></i>
                                    Imprimir
                                </span>
                            </a>
                        </div>
                    </div>

                </div>


                <div class="mt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Turno</th>
                                <th>Classe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>84666</td>
                                <td>Eurico Mazivila</td>
                                <td>Diurno</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14366</td>
                                <td>Claudio Bucene</td>
                                <td>Nturno</td>
                                <td>10</td>
                            </tr>
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

                <div class="row" id="graficos">
                    <div class="mt-5 col-12 ">
                        <h3 class="text-center">Graficos Estatisticos</h3>
                        <hr>
                       
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
        <div>
            <div id="containerB" style=""></div>
            <script src="_js/Grafico_Barras.js"></script>
        </div>

    </div>

    <?php 
include_once('footer.php');
?>