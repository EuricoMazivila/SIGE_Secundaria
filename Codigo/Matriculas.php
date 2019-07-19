<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $titulo="Matricula";
    include_once('metadados.php');
    ?>
    <script>
        $(function () {
            $('.size').styleddropdown();
        });
    </script>
</head>


<body>
    <div class="container">
        <?php
        include_once('Config/navbar.php');
        ?>
        <div class="containe-fluid top-margin">
            <!--Adicionando o menu do Pagamentos-->
            <?php include_once('Config/menuPagamentos.php');?>
            <!--Corpo-->
            <div class="menuT">
                <div class="container">
                    <div class="row top-margin">
                        <ol class="breadcrumb col-10 col-sm-12">
                            <li><a href="Home_page Secretaria11.html">Home</a></li>
                            <li><a href="Candidatos.html">Gestao de candidatos</a></li>
                            <small id="lect">Ano lectivo 2019</small>

                        </ol>
                    </div>
                    <div class="page-header">
                        <h3 class="mt-5 offset-md-1 text-center">Matrículas</h3>
                        <hr class="light">

                    </div>
                    <form method="POST" role="form">
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
                                    href="ListaMatriculados.html">
                                    <span class="i-color-white">
                                        <i class="fas fa-list-alt"></i> Listar matriculados
                                    </span>
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-9">
                        <div class="mt-3 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Classe</th>
                                        <th>Turno</th>
                                        <th>Total de vagas</th>
                                        <th>Vagas preenchidas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>8</td>
                                        <td>Diurno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Noturno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Diurno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Noturno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Diurno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Noturno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Diurno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Noturno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Diurno</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Noturno</td>
                                        <td>0</td>
                                        <td>0</td>
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
                        <div class="row  mt-5">

                            <a class="btn btn-primary col-5" href="MarcarMatricula.html">
                                <i class="fas fa-plus"></i> &nbsp; Editar periodo de matriculas
                            </a>

                            <a class="btn btn-primary col-5 offset-2" href="MarcarMatricula.html">
                                <i class="fas fa-plus"></i> &nbsp; Marcar matricula
                            </a>

                        </div>

                    </div>


                    <!--Graficos Estatisticos-->
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
        </div>
    </div>
    <?php 
    include_once('footer.php');
    ?>