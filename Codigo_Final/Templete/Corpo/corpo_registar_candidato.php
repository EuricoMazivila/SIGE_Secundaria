<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Candidato.php">Gestao de candidatos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Registar candidato</h3>
        <hr>
    </div>

    <div class="container">
        <form method="POST" role="form" action="../../Dao/processa_candidato.php">
            <?php require_once("../../Dao/conexao.php"); ?>
            <input type="hidden" name="id_Escola" value='<?php  echo $_SESSION['id_Escola'];?>'>
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="digitNome">Nomes</label>
                    <input type="text" name="nome" id="digitNome" class="form-control" required
                        placeholder="Introduza os primeiros nomes">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label for="digitApelido">Apelido</label>
                    <input type="text" name="apelido" id="digitApelido" class="form-control" required
                        placeholder="Introduza o apelido">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="digitdataNasc">Data de Nascimento</label>
                    <input type="date" name="datanasc" id="digitdataNasc" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label for="pickSexo">Sexo</label>
                    <select class="form-control" id="pickSexo" name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-5">
                    <label for="pickClass">Classe a matricular</label>
                    <select class="form-control" id="pickClass" name="classe_matr">
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label for="pickTurno">Regime</label>
                    <select class="form-control" id="pickTurno" name="regime">
                        <option>Diurno</option>
                        <option>Nocturno</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="id_distrito">Distrito da escola de origem</label>
                    <select class="form-control" id="id_distrito" name="distrito" placeholder="Selecione o distrito da escola de origem">
                        <option value="">Selecione o distrito da escola de origem</option>
                        <?php 
                            include_once("conexao.php");
                            $query="SELECT id_distrito,Nome from distrito";
                            $resultado=$conexao->query($query);
                            if(!$resultado){
                                echo "Erro";
                            }

                            $linhas=$resultado->num_rows;   

                            for($j=0; $j<$linhas; ++$j){
                                $resultado->data_seek($j);
                                $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                                echo '<option value="'.$linha['id_distrito'].'">'.$linha['Nome'].'</option>';
                            }
                            
                            //Fecha a conexao
                            $resultado->close();
                            $conexao->close();
                        ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label>Escola de origem</label>
                    <select class="form-control" name="escola" id="id_escola">    
                        <option value="">Selecione a escola de origem</option>
                    </select>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="form-group col-6 col-sm-5 col-md-4 ">
                    <a class="btn btn-info " href="Candidato.php">
                        <span class="i-color-white">
                        <i class="fa fa-arrow-left"></i>Voltar </span></a>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 col-md-4">
                    <button type="submit" class="btn btn-success" name="registar">
                        <span class="i-color-white"><i class="fa fa-save"></i>Salvar</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>