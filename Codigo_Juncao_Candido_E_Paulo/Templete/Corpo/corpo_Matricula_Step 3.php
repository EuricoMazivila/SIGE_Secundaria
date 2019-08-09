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
                    <legend>Dados Académicos</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputDadm">Pretende-se Matricular na classe</label>
                        <select class="form-control" id="inputDadm">
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>    
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSec">Secção a matricular-se</label>
                        <select class="form-control" id="inputSec">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option> 
                        </select>
                    </div>
                    <legend>Dados do último ano Académico</legend>
                    <hr></hr>
                    <!--Fieldset-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputCla">Classe</label>
                        <select class="form-control" id="inputCla">
                            <option>7</option>
                            <option>8</option>
                            <option>9</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTurm">Turma</label>
                        <input type="text" class="form-control" id="inputTurm">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNr">Nr</label>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <input type="number" id="inputNr"  name="" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAn">Ano</label>
                        <select class="form-control" id="inputAn">
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEns">Ensino</label>
                        <select class="form-control" id="inputEns">
                            <option>Primário </option>
                            <option>Secundário</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEsc">Na Escola</label>
                        <select class="form-control" id="inputEsc">
                            <option>Escola</option> 
                        </select>       
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Dados Adicionais</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputImagem"></label>
                        <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
                        <div class="text-center">
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="avatar-2" name="userImage" type="file" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Organizar os ficheiros deve ter uma opcao para abrir os ficheiros-->
                    <!--BI-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSbi">BI</label>
                        <input type="file" class="form-control" name="" id="inputSbi">
                    </div>
                    <!--Certificado-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputScert">Certificado de Habilitações</label>
                        <input type="file" class="form-control" name="" id="inputScert">    
                    </div>
                    <!--Dados Adicionais-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSofd">Sofre de Alguma doença</label> 
                        <select class="form-control" id="inputSofd" aria-placeholder="Selecione uma opcao">
                            <option>Sim</option>
                            <option>Não</option>
                        </select>    
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputInd">Em caso afirmativo indique-a</label>
                        <textarea class="form-control" rows="5" cols="10" id="inputInd"></textarea>
                    </div>
                </fieldset>
            </div>        
        </div>    

        <div class="row offset-4">
            <a class="btn btn-info offset-1 mt-5" href="Matricular_Step_2.php">
                <i class="fas fa-arrow-left"></i>Voltar
            </a>

           	<button class="btn btn-success offset-1 mt-5" type="submit">
                <a href="Home_page Secretaria11.html"><i class="fas fa-save"></i></a> Matricular
           	</button>
            </div>

    </form> 

</div>