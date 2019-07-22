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
                            <div id="kv-avatar-errors-2" class="center-block" style="width:500px;display:none"></div>
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
                                        <input type="file" class="form-control" name="userBi" id="inputSbi">
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
                                        <input type="file" class="form-control" name="userCertificado" id="inputScert">
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
                            <textarea class="form-control" rows="5" name="_se_sim" cols="10" id="inputInd"></textarea>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
