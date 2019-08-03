<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="Home_page Secretaria11.html">Home</a></li>
        <li><a href="Candidato.php">Gestao de candidatos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão de candidatos</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="ano">Ano </label>
                </div>
                <div class="col-4 col-sm-4">
                    <select name="ano" id="ano" class="form-control">
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
                <!--Serve para da espacamento-->
                <div class="offset-sm-2 offset-md-4">

                </div>
                <div class="form-group col-6 col-sm-5 col-md-3">
                    <a class="btn btn-default text-left btn-block   btn-primary" href="Registar candidato.php">
                        <span class="i-color-white">
                            <i class="fas fa-plus"></i>
                            Adicionar novo
                        </span>
                    </a>
                </div>
                
                <div class="form-group col-6 offset-6 col-md-3 col-sm-5 offset-sm-7 offset-md-9">
                    <a class="btn btn-default btn-block  text-left btn-primary" href="">
                        <span class="i-color-white"> <i class="fas fa-print "></i>
                            Imprimir
                        </span>
                    </a>
                </div>

            </div>
            <div class="offset-sm-1 col-sm-10 mt-2">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11" id="pesquisar" name="nome_candidato" type="search" required
                        placeholder="Pesquise nome do candidato">
                </div>
            </div>
        </form>
        <div class="table-responsive" id="resultado">
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="graficos">
        <div class="mt-5 col-12 ">
            <h3 class="text-center">Graficos Estatisticos</h3>
            <hr>

        </div>

        <div class="col-md-5">
            <div id="containerP" class="contaGrafico">
                <script src="_js/Grafico_Pizza.js"></script>
            </div>
        </div>
        <div class="col-md-5 offset-sm-2">
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