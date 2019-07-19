<!DOCTYPE html>
<html lang="en">
<head>

<?php
$titulo="Lista Matriculados";
include_once('metadados.php');
?>

</head>



<body>
    <div class="container">
        <?php
        include_once('Config/navbar.php');
        ?>
        <div class="containe-fluid top-margin">
            <!--Adicionando o menu do Pagamentos-->
            <?php include_once('Config/menuPagamentos.php');?>
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
                        <div class="form-row">
                            <div class="form-group col-2 col-sm-1">
                                <label for="_ano">Ano </label>

                            </div>
                            <div class="form-group col-9 col-sm-3  offset-1">
                                <select name="_Nome" id="_ano" class="form-control">
                                    <option>2014</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                </select>
                            </div>
                            <div class="form-group col-2 col-sm-1  offset-sm-2">
                                <label for="_classe">Classe </label>

                            </div>
                            <div class="form-group col-9 col-sm-3  offset-1">
                                <select name="_classe" id="_classe" class="form-control">
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nome</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>84666</td>
                                        <td>Titos Junior</td>
                                        <td>25/02/2019</td>
                                    </tr>
                                    <tr>
                                        <td>14366</td>
                                        <td>Hamilton Titos</td>
                                        <td>09/01/2019</td>
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
 
    
    <script src="_js/contador.js"></script>

    <?php 
include_once('footer.php');
?>