    <div class="container">
        <form method="POST" id="myForm" action="Dao/processa_matricular_aluno.php" role="form" data-toggle="validator">
            <br />
            <!-- SmartWizard html -->
            <div id="smartwizard" class="mt-5 offset-1">
                <ul>
                    <li id="stp1"><a class="step" href="#step-1">Dados Pessoais<br><small>Passo 1</small></a></li>
                    <li id="stp2"><a class="step" href="#step-2">Morada<br><small>Passo 2</small></a></li>
                    <li id="stp3"><a class="step" href="#step-3">Filiação<br><small>Passo 3</small></a></li>
                    <li id="stp4"><a class="step" href="#step-4">Encarregado<br><small>Passo 4</small></a></li>
                    <li id="stp5"><a class="step" href="#step-5">Matricula<br><small>Passo 5</small></a></li>
                    <li id="stp6"><a class="step" href="#step-6">Outros Dados<br><small>Passo 6</small></a></li>
                </ul>
                <div>
                    <div id="step-1" class="mt-4">
                        <div class="container-fluid padding">
                            <div id="form-step-0" role="form" data-toggle="validator">
                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputSobrenome">Apelido</label>
                                        <input type="text" name="apelido" id="inputSobrenome" class="form-control"
                                            required placeholder="Introduza o Apelido">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12  col-sm-12 col-md-4 offset-1">
                                        <label for="inputNome">Outros Nome</label>
                                        <input type="text" name="nome" id="inputNome" class="form-control" required
                                            placeholder="Introduza o Nome">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNacionalidade">Nacionalidade</label>
                                        <select class="form-control" name="pais_nas" id="inputNacionalidade" required placeholder="Seleciona a Nacionalidade">
                                            <option>Mocambique</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProvincia">Província de Nascimento</label>
                                        <select class="form-control" name="provincia_nas" id="inputProvincia" required placeholder="Seleciona a Provincia">
                                            <option>Cidade de Maputo</option>    
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDistrito">Distrito de Nascimento</label>
                                        <select class="form-control" name="distrito_nas" id="inputDistrito" required placeholder="Seleciona o Distrito">
                                            <option>kamubukwana</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDataNascimnto">Data de Nascimento</label>
                                        <input type="date" name="data_nas" id="inputDataNascimnto" name="data_nas"
                                            class="form-control" required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputBI">Tipo de Documento de Identificação</label>
                                        <select class="form-control" name="_tipoBi" id="inputBI" required
                                            placeholder="Seleciona o Documento de Identificacao">
                                            <option>BI</option>
                                            <option>Cedula</option>
                                            <option>Carta de conducao</option>
                                            <option>Passaporte</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputBinr">Documento de Identificação Nr</label>
                                        <input type="text" class="form-control" name="nrBI" id="inputBinr" required
                                            placeholder="Introduza o nr do documento de identificacao">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Quinta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputArquivo">Arquivo de Identificação</label>
                                        <select class="form-control" name="local_em" id="inputArquivo" required placeholder="Local de emissão do BI">
                                            <option>Cidade de Maputo</option>
                                        </select>    
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDataEm">Data de Emissão</label>
                                        <input type="date" name="dataEmissao" id="inputDataEm" class="form-control"
                                            required>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Sexta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputSexo">Sexo</label>
                                        <select class="form-control" name="sexo" id="inputSexo" required
                                            placeholder="Selecione o Sexo">
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputEstado">Estado Civil</label>
                                        <select class="form-control" name="estado_Civil" id="inputEstado" required
                                            placeholder="Selecione Estado civil">
                                            <option value="Casado(a)">Casado(a)</option>
                                            <option value="Solteiro(a)">Solteiro</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Passo 2-->
                    <div id="step-2">
                        <div class="container-fluid padding">
                            <div id="form-step-1" role="form" data-toggle="validator">
                                <fieldset>
                                    <legend>Morada</legend>
                                    <hr class="light">
                                    <!--Primeira Linha-->
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputProvincia">Província</label>
                                            <select class="form-control" name="provincia_res" id="inputProvincia" required placeholder="Seleciona a Província">
                                                <option>Cidade de Maputo</option>
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputDistrito">Distrito</label>
                                            <select class="form-control" name="distrito_res" id="inputDistrito" required placeholder="Seleciona o Distrito">
                                                <option>kamubukwana</option>
                                            </select>    
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>

                                    <!--Segunda Linha-->
                                    <div class="row">
                                        <!--Tirar-->
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputBairro">Bairro</label>
                                            <select class="form-control" name="bairro_res" id="inputBairro" required placeholder="Seleciona o Bairro">
                                                <option>Jorge Dimitrov</option>
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputAvenida">AV/Rua</label>
                                            <select class="form-control" name="avenida" id="inputAvenida" required placeholder="Seleciona a Avenida">
                                                <option>Av. de Mocambique</option>    
                                            </select>
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                    <!--Terceira Linha-->
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputQuarterao">Quarteirão</label>
                                            <input type="text" class="form-control" name="quarteirao_res"
                                                id="inputQuarterao" required
                                                placeholder="Introduza Numero de Quarteirão">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputCasa">Casa Nr</label>
                                            <input type="number" class="form-control" name="nrCasa_res" id="inputCasa"
                                                required placeholder="Introduza Numero da casa">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--Quarta Linha-->
                                <fieldset class="mt-4">
                                    <legend>Contacto</legend>
                                    <hr class="light">
                                    <div class="row">
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputTel">Número de Telefone</label>
                                            <input type="number" class="form-control" name="nr_Tell" id="inputTel"
                                                required placeholder="Introduza Numero de Telefone">
                                            <div class="help-block with-errors text-danger"></div>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                            <label for="inputEmail">Email</label>
                                            <input type="email" class="form-control" name="email" id="inputEmail"
                                                placeholder="Introduza o email">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!--Passo 3-->
                    <div id="step-3" class="mt-4">
                        <div class="container-fluid padding">
                            <div id="form-step-2" role="form" data-toggle="validator">
                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomep">Nome do Pai</label>
                                        <input type="text" class="form-control" name="nomePai" id="inputNomep" required
                                            placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelP">Telefone</label>
                                        <input type="number" class="form-control" name="telefonePai" id="inputTelp"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocp">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabPai" id="inputLocp" required placeholder="Introduza">
                                            <option>Cidade de Maputo</option>
                                        <select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfp">Profissão</label>
                                        <input type="text" class="form-control" name="profissaoPai" id="inputProfp"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomem">Nome da Mãe</label>
                                        <input type="text" class="form-control" name="nomeMae" id="inputNomem" required
                                            placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelm">Telefone</label>
                                        <input type="number" class="form-control" name="telefoneMae" id="inputTelm"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!-- Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocm">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabMae" id="inputLocm" required placeholder="Introduza">
                                            <option>Cidade de Maputo</option>
                                        <select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfm">Profissão</label>
                                        <input type="text" class="form-control" name="profissaoMae" id="inputProfm"
                                            required placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Quinta Linha
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="enc">O Encarregado é</label>
                                        <select id="enc" class="form-control" required aria-placeholder="Selecione uma opcao">
                                            <option>Pai</option>
                                            <option>Mãe</option>
                                            <option>Outro</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>

                    <!--Passo 4-->
                    <div id="step-4" class="mt-4">
                        <div class="container-fluid padding">
                            <div id="form-step-3" role="form" data-toggle="validator">
                                <!--Primeira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputNomeenc">Nome do Encarregado</label>
                                        <input type="text" class="form-control" name="nomeEnc" required
                                            id="inputNomeenc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputTelEnc">Telefone</label>
                                        <input type="number" class="form-control" name="telefoneEnc" required
                                            id="inputTelEnc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Segunda Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputprovincEnc">Provincia de Residencia</label>
                                        <select class="form-control" name="provinciaEnc" id="inputprovincEnc" required placeholder="Selecione uma opcao">
                                            <option>Cidade de Maputo<option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <!--Tirar-->
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputDistritoEnc">Distrito de Residencia</label>
                                        <select class="form-control" required id="inputDistritoEnc" name="distritoEnc">
                                            <option>kamubukwana</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Terceira Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputres">Bairro</label>
                                        <select class="form-control" name="moradaEnc" id="inputres" required placeholder="Selecione uma opcao">
                                            <option>Jorge Dimitrov</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <!--Tirar-->
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputAv">Av/Rua</label>
                                        <select class="form-control" required id="inputAv" name="av_rua_enc">
                                            <option>Av. de Mocambique</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>

                                <!--Quarta Linha-->
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputLocenc">Local de Trabalho</label>
                                        <select class="form-control" name="localTrabEnc" required id="inputLocenc" placeholder="Introduza ">
                                            <option>Cidade de Maputo</option>
                                        </select>
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                                        <label for="inputProfenc">Profissão</label>
                                        <input type="text" class="form-control" name="profissaoEnc" required
                                            id="inputProfenc" placeholder="Introduza ">
                                        <div class="help-block with-errors text-danger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                    <!--Passo 5-->
                    <div id="step-5" class="mt-5">
                        <div class="container-fluid padding">
                            <div id="form-step-4" role="form" data-toggle="validator">
                                <fieldset>
                                    <legend>Dados da Matrícula</legend>
                                    <hr class="light">
                                    <!--Primeira Linha-->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                                        <label for="inputDadm">Pretende-se Matricular na classe</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                                        <select class="form-control" name="classe_m" required
                                                            id="inputDadm">
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                        </select>
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <!--Ainda por pensar-->
                                            <!--    
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label for="inputSec">Secção a matricular-se</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                                        <select class="form-control" name="_seccao" id="inputSec">
                                                            <option>A</option>
                                                            <option>B</option>
                                                            <option>C</option>
                                                        </select>
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                    </div>
                                </fieldset>
                                <!--Ainda por pensar-->     
                                <fieldset class="mt-5">
                                    <legend>Informações do ultimo ano lectivo que frequentou</legend>
                                    <hr class="light">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                                        <label for="inputEns">Ensino</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <select class="form-control" name="ensino" required
                                                            id="inputEns">
                                                            <option value="primaria">Primário </option>
                                                            <option value="secundaria">Secundário</option>
                                                        </select>
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label for="inputEsc">Na Escola</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                                        <select class="form-control" name="escolaAnte" required
                                                            id="inputEsc">
                                                            <option>Escola Secundaria Quisse Mavota</option>
                                                        </select>
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label for="inputCla">Classe</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <select class="form-control" name="classeAnte" required
                                                            id="inputCla">
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                        </select>
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label for="inputTurm">Turma</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <input type="text" name="turmaAnte" required
                                                            class="form-control" id="inputTurm">
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label for="inputNr">Nr</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <input type="number" id="inputNr" name="numeroAnte" required
                                                            name="" class="form-control">
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label for="inputAn">Ano</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <input type="number" class="form-control" name="ano" required
                                                            id="inputAn">
                                                        <div class="help-block with-errors text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                    <!---->
                    <!--Passo 6-->
                    <div id="step-6">
                        <div class="container-fluid padding">
                            <div id="form-step-5" role="form" data-toggle="validator">
                                <fieldset>
                                    <legend>Submissões</legend>
                                    <hr class="light">
                                    <!--Primeira Linha-->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <div class="form-group offset-1">
                                                <label for="inputImagem"></label>
                                                <div id="kv-avatar-errors-2" class="center-block"
                                                    style="width:500px;display:none"></div>
                                                <div class="text-center">
                                                    <div class="kv-avatar">
                                                        <div class="file-loading">
                                                            <input id="avatar-2" name="userImage" type="file" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ofsset-1">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group offset-1">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <label for="inputSbi">BI</label>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <input type="file" class="form-control" name="userBi"
                                                                id="inputSbi">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group offset-1">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <label for="inputScert">Certificado de Habilitações</label>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <input type="file" class="form-control"
                                                                name="userCertificado" id="inputScert">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="mt-5">
                                    <legend>Dados Adicionais</legend>
                                    <hr class="light">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group offset-1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label for="inputSofd">Sofre de Alguma doença</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                                        <select class="form-control" name="_sofre_doenca" id="inputSofd"
                                                            aria-placeholder="Selecione uma opcao">
                                                            <option>Sim</option>
                                                            <option>Não</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <div class="form-group offset-1">
                                                <label for="inputInd">Em caso afirmativo indique-a</label>
                                                <textarea class="form-control" rows="5" name="_se_sim" cols="10"
                                                    id="inputInd"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <!---->
                </div>
                <!---->
            </div>
        </form>
    </div>