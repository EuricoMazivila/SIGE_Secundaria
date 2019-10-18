<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Lista_Professores.php">Professores</a></li>
        <li><a href="Registar_professor.php">Registar professor</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Registar professor</h3>
        <hr>
    </div>

    <div class="container-fluid padding" data-toggle="validator">
        <form method="POST" id="formProfessor" role="form" action="" data-toggle="validator">
            <?php require_once("../../Dao/conexao.php"); ?>
        
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="nomProf">Nome</label>
                     <input type="text" class="form-control" data-error="Por favor, introduza valor" required name="nomProf" id="nomProf" required
                    pattern="[0-9]{0,2}$ placeholder="Introduza a quantidade de disciplinas">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-sm-5 offset-sm-2">
                    <label for="qtdDisciplina">Quantidade de disciplinas lecionada</label>
                     <input type="number" class="form-control" data-error="Por favor, introduza valor" required name="qtdDisciplina" id="qtdDisciplina" required
                    placeholder="Introduza a disciplina">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-5 mt-4">
                    <label for="nomDisciplina1">Disciplina</label>
                     <input type="text" class="form-control" data-error="Por favor, introduza valor" required name="nomDisciplina1" id="nomDisciplina1" required
                    placeholder="Introduza a disciplina">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="col-sm-5 offset-sm-2 mt-4 apagado">
                    <label for="nomDisciplina">Disciplina</label>
                     <input type="text" class="form-control" data-error="Por favor, introduza valor" required name="nomDisciplina" id="nomDisciplina" required
                    placeholder="Introduza a disciplina">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="form-group col-6 col-sm-5 col-md-4 ">
                    <a class="btn btn-info " href="Lista_Professores.php">
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