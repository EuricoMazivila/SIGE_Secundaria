<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="Home_Page Director.html">Home</a></li>
        <li><a href="Matricula.php">Matriculas</a></li>
        <li><a href="ListaMatriculados.php">Lista de matriculados</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Lista de Matriculados</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-md-1">
                    <label for="selecAnoo">Ano </label>
                </div>
                <div class="col-4 col-md-3">
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

                <div class="form-group col-2 col-md-1 offset-md-4">
                    <label for="selectClasee">Classe </label>
                </div>
                <div class="col-4 col-md-3">
                    <select name="ano" id="selectClasee" class="form-control">
                        <?php
                        //Completa as classe automaticamente
                        for ($i=8; $i <=12 ; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                         }
                       ?>
                    </select>
                </div>
            </div>


        </form>
        <div class="offset-sm-1 col-sm-10 mt-2">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11" id="pesquisar" name="nome_candidato" type="search" required
                        placeholder="Pesquise nome do aluno">
                </div>
            </div>
        <div class="table-responsive" id="resultado">
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
        <div class="row ">
            <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                <a class="btn btn-info text-left " href="Matricula.php">
                    <span class="i-color-white"> <i class="fas fa-arrow-left"></i>&nbsp; Voltar </span>
                </a>
            </div>
            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                <a class="btn btn-info text-left " href="MarcarMatricula.html">
                    <span class="i-color-white"><i class="fas fa-print"></i>&nbsp; Imprimir</span>
                </a>
            </div>
        </div>
    </div>

</div>




</div>