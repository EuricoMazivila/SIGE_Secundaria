<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="turmas.php">Gestao de turmas</a></li>
        <li><a href="Registar_turma.php">Registar turma</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Registar turma</h3>
        <hr>
    </div>

    <div class="container-fluid padding" data-toggle="validator">
        <form method="POST" role="form" action="" data-toggle="validator">
            <?php require_once("../../Dao/conexao.php"); ?>
        
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="sala">Sala</label>
                     <input type="number" class="form-control" data-error="Por favor, introduza valor" required name="sala" id="sala" required
                    placeholder="Introduza a sala">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-sm-5 offset-sm-2">
                    <label for="nomeDt">Director de turma</label>
                    <input type="text" name="nomeDt" id="nomeDt" class="form-control" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[a-zA-Z][a-zA-Z-_\.]{2,20}$" required placeholder="Introduza o nome do diretor de turma">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-sm-5">
                    <label for="pickPeriodo">Turno</label>
                    <select class="form-control" id="pickPeriodo" name="pickPeriodo">
                        <option value="m">Diurno-matutino</option>
                        <option value="v">Diurno-vespertino</option>
                        <option value="n">Nocturno</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-sm-5 offset-sm-2">
                    <label for="classeTurma">Classe</label>
                    <select class="form-control" id="classeTurma" name="classe_turma">
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row mt-4">
                <div class="col-sm-5 escondido">
                    <label for="seccao">Secção</label>
                    <input type="text" name="seccao" id="seccao" class="form-control" data-error="Por favor, introduza texto" data-pattern-error="Texto invalido. Introduza letras de (3-20) caracteres" required pattern="^[a-zA-Z][a-zA-Z-_\.]{2,20}$" required placeholder="Introduza o nome do diretor de turma">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="form-group col-6 col-sm-5 col-md-4 ">
                    <a class="btn btn-info " href="turmas.php">
                        <span class="i-color-white">
                        <i class="fa fa-arrow-left"></i>Voltar </span></a>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 col-md-4">
                    <button type="submit" enabled class="btn btn-success" name="registarTurma">
                        <span class="i-color-white"><i class="fa fa-save"></i>Salvar</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>