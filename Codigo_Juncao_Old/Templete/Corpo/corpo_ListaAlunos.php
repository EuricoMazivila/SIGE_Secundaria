<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="ListaAlunos.php">Alunos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Alunos</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="year">Ano </label>
                </div>

                <div class="col-4 col-sm-2">
                    <select class="form-control" name="yyy" id="year">
                        <option><?php echo date('Y');?></option>
                        <option>2018</option>
                        <option>2017</option>
                     </select>
                </div>

                <div class="offset-sm-1 form-group col-2 col-sm-1">
                    <label for="classe#">Classe</label>
                </div>

                <div class="col-4 col-sm-2">
                    <select class="form-control" name="Class" id="classe#">
                        <option>Todas</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                     </select>
                </div>

                <div class="offset-sm-1 form-group col-2 col-sm-1">
                    <label for="turno">Turno</label>
                </div>

                <div class="col-5 col-sm-2">
                    <select class="form-control" name="periodo" id="turno">
                        <option>Todos</option>
                        <option>Diurno</option>
                        <option>Noturno</option>
                     </select>
                </div>

            </div>
            <div class="offset-sm-1 col-sm-10 mt-sm-5 mt-3">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11 pesquisa" id="nome_aluno" name="nome_aluno" type="search" required
                        placeholder="Pesquise nome do aluno">
                </div>
            </div>
        </form>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Turno</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Candido Barato</td>
                        <td>8</td>
                        <td>Noturno</td>
                    </tr>
                    <tr>
                        <td>Eurico Mazivila</td>
                        <td>9</td>
                        <td>Diurno</td>
                    </tr>
                    <tr>
                        <td>Claudio Bucene</td>
                        <td>10</td>
                        <td>Diurno</td>
                    </tr>
                    <tr>
                        <td>Absalao Nhantumbo</td>
                        <td>11</td>
                        <td>Noturno</td>
                    </tr>
                    <tr>
                        <td>Ricardo Manhice</td>
                        <td>12</td>
                        <td>Noturno</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="size offset-6">
        <ul class="listaa">
           <li><a href="Matricular_Step_1.php"><i class="fa fa-address-book fa-2x"></i><span>Ver Dados</span></a> </li>

           <li><a href="Matricular_Step_1.php"><i class="fa fa-times fa-2x"></i><span>Anular matrícula </span></a> </li>

        </ul>
    </div>

    <div class="row" id="graficos">
        <div class="mt-5 col-12 ">
            <h3 class="text-center">Graficos Estatisticos</h3>
            <hr>
        </div>

        <div class="col-md-6">
            <div id="containerP" class="contaGrafico">
                
            </div>
        </div>
        <div class="col-md-6">
            <div id="containerB" class="contaGrafico">
                
            </div>
        </div>
    </div>
</div>

<div class="">
    <nav class="menu-small menu-md">
        <ul>
            <li>
                <a href="#top">
                <span class="i-color-white  ">
                    <i class="fa fa-table fa-2x i-tamanho"></i>
                    </span>
               
                </a>
            </li>
            <li>
                <a href="#containerP">
                <span class="i-color-white">
                    <i class="fa fa-chart-bar fa-2x i-tamanho"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href="#containerB">
                <span class="i-color-white  ">
                    <i class="fa fa-chart-pie fa-2x i-tamanho"></i>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<div>
    <div id="containerB" style=""></div>
    
</div>

</div>

<script src="_js/Grafico_Barras.js"></script>

<script src="_js/Grafico_Pizza.js"></script>

<script src="_js/Grafico_Barras.js"></script>
