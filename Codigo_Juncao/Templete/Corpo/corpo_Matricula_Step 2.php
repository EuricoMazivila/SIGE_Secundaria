<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Candidato.php">Gestao de candidatos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrícula de aluno</h3>
        <hr>
    </div>

    <form method="POST" role="form">
        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Filiação</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputNomep">Nome do Pai</label>
                        <input type="text" class="form-control" name="" id="inputNomep" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelP">Telefone</label>
                        <input type="number" class="form-control" name="" id="inputTelp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocp">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfp">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNomem">Nome da Mãe</label>
                        <input type="text" class="form-control" name="" id="inputNomem" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelm">Telefone</label>
                        <input type="text" class="form-control" name="" id="inputTelm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocm">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfm">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="enc">O Encarregado é</label>
                        <select id="enc" class="form-control" aria-placeholder="Selecione uma opcao">
                            <option>Pai</option>
                            <option>Mãe</option>
                            <option>Outro</option>
                        </select>
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Encarregado</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputNomeenc">Nome do Encarregado</label>
                        <input type="text" class="form-control" name="" id="inputNomeenc" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelEnc">Telefone</label>
                        <input type="number" class="form-control" name="" id="inputTelEnc" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputres">Residência/Bairro</label>
                        <select class="form-control" id="inputres" aria-placeholder="Selecione uma opcao">
                            <option>Selecione uma opcao x</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAv">Av/Rua</label>
                        <select class="form-control" id="inputAv">
                            <option>Exemplo</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocenc">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocenc" placeholder="Introduza ">  
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfenc">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfenc" placeholder="Introduza ">
                    </div>
                </fieldset>  
            </div>
        </div>

        <div class="row offset-4">
            <a class="btn btn-info offset-1 mt-5" href="Matricular_Step_1.php">
               	<i class="fas fa-arrow-left"></i>Voltar
             </a>
                    
            <a class="btn btn-info offset-1 mt-5" href="Matricular_Step_3.php"> 
                Próximo <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </form>

</div>