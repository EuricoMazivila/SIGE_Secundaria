<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="turmas.php">Gestao de turmas</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão de turmas</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="anoTurmas">Ano </label>
                </div>
                <div class="col-4 col-sm-4">
                    <select name="ano" id="anoTurmas" class="form-control">
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
                <div class="offset-6  offset-sm-2 offset-md-4">

                </div>
                <div class="form-group col-6 col-sm-5 col-md-3">
                    <a class="btn btn-default text-left btn-block   btn-primary" href="Registar_turma.php">
                        <span class="i-color-white">
                            <i class="fas fa-plus"></i>
                            Adicionar nova
                        </span>
                    </a>
                </div>
                
                <div class="form-group col-6 offset-sm-6 col-md-3 col-sm-5 offset-sm-7 offset-md-9">
                    <a class="btn btn-default btn-block  text-left btn-primary" href="#">
                        <span class="i-color-white"> <i class="fas fa-print "></i>
                            Imprimir dados
                        </span>
                    </a>
                </div>
            </div>
            <div class="offset-sm-1 col-sm-10 mt-2">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11 pesquisa" id="nome_turma" name="nome-turma" type="search" required
                        placeholder="Pesquise nome da turma">
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Sala</th>
                        <th>Turno</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2019B21</td>
                        <td>B2-1</td>
                        <td>2</td>
                        <td>Diurno-matutino</td>
                        <td>10</td>
                    </tr>

                    <tr>
                        <td>2019B22</td>
                        <td>B2-2</td>
                        <td>15</td>
                        <td>Noturno</td>
                        <td>11</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    