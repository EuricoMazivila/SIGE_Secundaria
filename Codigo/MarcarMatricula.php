<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $titulo="Marcar Matricula";
    include_once('metadados.php');
    ?>
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
        <?php
        include_once('Config/navbar.php');
        ?>
        <div class="containe-fluid top-margin">
            <!--Adicionando o menu do Pagamentos-->
            <?php include_once('Config/menuPagamentos.php');?>
            <!--Corpo-->
            <div class="menuT baixo">
                <div class="container">
                    <div class="page-header">
                        <h3 class="mt-5 offset-md-1 text-center">Marcar matrícula</h3>
                        <hr>
                       
                    </div>

                    <div class="">
                        <form method="POST" role="form">
                            <div class="form-row">

                                <div class="form-group col-4 col-sm-2">
                                    <label for="_ano">Data de início </label>

                                </div>
                                <div class="form-group col-8 col-sm-4">
                                    <input type="date" name="" name="" class="form-control" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group col-4 col-sm-2">
                                    <label for="_classe">Data de fim </label>

                                </div>
                                <div class="form-group col-8 col-sm-4  ">
                                    <input type="date" name="" name="" class="form-control" required>
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
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Noturno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Diurno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Noturno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Diurno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Noturno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Diurno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>11</td>
                                                <td>Noturno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Diurno</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>12</td>
                                                <td>Noturno</td>
                                                <td>0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="form-group col-6 col-sm-5 ">
                                        <a class="btn btn-danger btn-lg  btn-block" href="Matriculas.html">
                                            <span><i class="fa fa-window-close fa-2x"></i> Cancelar</span> </a>
                                    </div>
                                    <div class="form-group col-6 col-sm-5 offset-sm-2 ">
                                        <a class="btn btn-success btn-lg btn-block" href="Home_Page Director.html">
                                            <span> <i class="fa fa-save fa-2x"></i>Salvar</span>
                                        </a>
                                    </div>
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
    <?php 
    include_once('footer.php');
    ?>