<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Lista_Professores.php">Professores</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Lista de professores</h3>
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
                    <a class="btn btn-default text-left btn-block   btn-primary" href="Registar_professor.php">
                        <span class="i-color-white">
                            <i class="fas fa-plus"></i>
                            Adicionar novo
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
                    <input class="form-group col-11 pesquisa" id="nome_professor" name="nome-professor" type="search" required
                        placeholder="Pesquise nome do professor">
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Disciplina</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2019B21</td>
                        <td>Antonio Muchanga</td>
                        <td>Historia</td>
                    </tr>

                    <tr>
                        <td>2019B22</td>
                        <td>Armando Guebuza</td>
                        <td>Filosofia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    