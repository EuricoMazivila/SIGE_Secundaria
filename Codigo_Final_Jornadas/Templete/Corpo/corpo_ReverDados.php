<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-4 offset-sm-1">Revisão de dados</h3>
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
        </div>

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
            <a class="btn btn-info offset-1 mt-5" href="formulario.php">
                <i class="fas fa-arrow-left"></i>Editar
            </a>

            <a class="btn btn-success offset-1 mt-5" onclick="popup()">
                <span class="i-color-white"><i class="fas fa-save"></i> Gravar
            </a> </span>
        </div>
    </form> 

    <div id="myModal" class="modal">

        <div class="modal-content" id="modelo">
            <div class="container">
                <div class="page-header">
                    <h3 class="offset-1">Tens certeza que pretendes gravar?</h3> 
                </div>

                <form method="POST" role="form">
                        
                    <div class="form-row mt-5">
                        <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                            <a class="btn btn-danger text-left" onclick="closed()">
                                <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp;
                                    Cancelar
                                </span>
                            </a>
                        </div>

                        <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                            <a class="btn btn-success text-left" href="Login_Principal.php">
                                <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Gravar</span>
                            </a>
                            <!--<button class="btn btn-success text-left" id="submete_pre-matricula" type="submit">
                                <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Gravar</span>
                            </button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>