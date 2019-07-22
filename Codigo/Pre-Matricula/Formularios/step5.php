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
                                    <select class="form-control" name="_classe" required id="inputDadm">
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                </div>
            </fieldset>
            <fieldset class="mt-5">
                <legend>Informações do ultimo ano lectivo que frequentou</legend>
                <hr class="light">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="form-group offset-1">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <label for="inputCla">Classe</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <select class="form-control" name="_classeAnte" required id="inputCla">
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
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
                                    <input type="text" name="_turmaAnte" required class="form-control" id="inputTurm">
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
                                    <input type="number" id="inputNr" name="_numeroAnte" required name=""
                                        class="form-control">
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
                                    <input type="number" class="form-control" name="_ano" required id="inputAn">
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group offset-1">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <label for="inputEns">Ensino</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <select class="form-control" name="_ensino" required id="inputEns">
                                        <option>Primário </option>
                                        <option>Secundário</option>
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
                                    <select class="form-control" name="_escolaAnte" required id="inputEsc">
                                        <option>Escola</option>
                                    </select>
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