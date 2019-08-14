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

     <form class="" id="myForm" role="form" method="POST">
        <!--Primeira Linha-->
        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Dados Pessoais</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputSobrenome">Apelido</label>
                        <input type="text" name="apelido" id="inputSobrenome" class="form-control" placeholder="Introduza o Apelido">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNome">Nome</label>
                        <input type="text" name="" id="inputNome" class="form-control" placeholder="Introduza o Nome">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNacionalidade">Nacionalidade</label>
                        <input list="Nacionalidade" class="form-control" id="inputNacionalidade"
                                placeholder="Seleciona a Nacionalidade">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProvincia">Província de Nascimento</label>
                        <input list="Provincia" class="form-control" id="inputProvincia"
                        placeholder="Seleciona a Provincia">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDistrito">Distrito de Nascimento</label>
                        <input list="Distrito" class="form-control" id="inputDistrito"
                                    placeholder="Seleciona o Distrito">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDataNascimnto">Data de Nascimento</label>
                        <input type="date" name="" id="inputDataNascimnto" name="" class="form-control"> 
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBI">Tipo de Documento de Identificação</label>
                        <input list="BI" class="form-control" id="inputBI"
                                    placeholder="Seleciona o Documento de Identificacao">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBinr">Documento de Identificação Nr</label>
                        <input type="number" class="form-control" name=" " id="inputBinr"  placeholder="Introduza o nr do documento de identificacao">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputArquivo">Arquivo de Identificação</label>
                        <input list="EmissaoBI" class="form-control" id="inputArquivo"
                                    placeholder="Local de emissão do BI">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDataEm">Data de Emissão</label>
                        <input type="date" name="" id="inputDataEm" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSexo">Sexo</label>
                        <input list="Sexo" class="form-control" id="inputSexo"
                                    placeholder="Selecione o Sexo">
                    </div>
                </fieldset>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Morada</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputProvincia">Província</label>
                        <input list="Provincia" class="form-control " id="inputProvincia" placeholder="Seleciona a Província">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDistrito">Distrito</label>
                        <input list="Distrito" class="form-control" id="inputDistrito" placeholder="Seleciona o Distrito">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAvenida">AV/Rua</label>
                        <input list="Avenidas" class="form-control" id="inputAvenida" placeholder="Seleciona a Avenida">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBairro ">Bairro</label>
                        <input list="Bairros" class="form-control" id="inputBairro" placeholder="Seleciona o Bairro">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputQuarterao">Quarteirão Nr</label>
                        <input type="number" class="form-control" id="inputQuarterao" placeholder="Introduza Numero de Quarteirão">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputCasa">Casa Nr</label>
                        <input type="number" class="form-control" id="inputCasa" placeholder="Introduza Numero da casa">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTel">Número de Telefone</label>
                        <input type="number" class="form-control" id="inputTel" placeholder="Introduza Numero de Telefone">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Introduza o email">
                    </div>
                </fieldset>

            </div>

            <a class="btn btn-info offset-6 mt-5" href="Matricular_Step_2.php">
                Próximo <i class="fas fa-arrow-right"></i>
             </a>

        </div>
    </form>

    <!--Datalist de Nacionalidade-->
    <datalist id="Nacionalidade">
        <option value="Angola">
        <option value="Mocambique">
    </datalist>
    <!--Datalist de Provincia-->
    <datalist id="Provincia">
        <option value="Maputo">
        <option value="Gaza">
    </datalist>
    <!--Datalist de Distito-->
    <datalist id="Distrito">
        <option value="Maracuene">
        <option value="Manhica">
    </datalist>
    <!--Datalist de EmissaoBI-->
    <datalist id="EmissaoBI">
        <option value="Maracuene">
        <option value="Manhica">
    </datalist>
    <!--Datalist de Tipo de BI-->
    <datalist id="BI">
        <option value="BI">
        <option value="NUIT">
        <option value="Cedula">
        <option value="Passaporte">
    </datalist>
    <!--Datalist de Sexo-->
    <datalist id="Sexo">
        <option value="Masculino">
        <option value="Femenino">
    </datalist>

</div>