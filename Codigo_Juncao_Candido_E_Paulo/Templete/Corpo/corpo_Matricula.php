<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="Home_Page Director.html">Home</a></li>
        <li><a href="Matriculas.html">Matriculas</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrículas</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="selecAnoo">Ano </label>
                </div>
                <div class="col-4 col-sm-3">
                    <select name="ano" id="selecAnoo" class="form-control">
                        <?php
                        //Completa os anos automaticamente
                        $ano=date('Y');
                        echo '<option value="'.($ano+1).'">'.($ano+1).'</option>';
                        echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                        
                        for ($i=1; $i <10 ; $i++) {
                           echo '<option value="'.($ano-$i).'">'.($ano-$i).'</option>';
                        }
                       ?>
                    </select>

                </div>

                <div class="form-group offset-sm-2 offset-md-5  col-6 col-sm-5 col-md-3">
                    <a class="btn btn-default text-left btn-block   btn-primary" href="ListaMatriculados.php">
                        <span class="i-color-white">
                            <i class="fas fa-list-alt"></i>
                            Listar matriculados
                        </span>
                    </a>
                </div>
            </div>

        </form>
        <div class="table-responsive" id="resultado">
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
        <div class="row ">
            <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                <a class="btn btn-info text-left btn-block" href="MarcarMatricula.php">
                <span class="i-color-white"> <i class="fas fa-marker"></i>&nbsp; Editar Matricula</span>
                </a>
            </div>
            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                <a class="btn btn-info text-left btn-block" href="MarcarMatricula.php">
                <span class="i-color-white"><i class="fas fa-highlighter"></i>&nbsp;Marcar Matricula</span>
                </a>
            </div>
        </div>
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
<div>
    <div id="containerB" style=""></div>
    <script src="_js/Grafico_Barras.js"></script>
</div>

</div>
<script >
        $(function(){
            $('.size').styleddropdown();
        });
    </script>