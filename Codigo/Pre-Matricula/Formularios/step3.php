<!--Passo 3-->
<div id="step-3" class="mt-4">
    <div class="container-fluid padding">
        <div id="form-step-2" role="form" data-toggle="validator">
            <!--Primeira Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputNomep">Nome do Pai</label>
                    <input type="text" class="form-control" name="_nomePai" id="inputNomep" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputTelP">Telefone</label>
                    <input type="number" class="form-control" name="_telefonePai" id="inputTelp" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Segunda Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputLocp">Local de Trabalho</label>
                    <input type="text" class="form-control" name="_localTrabPai" id="inputLocp" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputProfp">Profissão</label>
                    <input type="text" class="form-control" name="_profissaoPai" id="inputProfp" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>

            <!--Terceira Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputNomem">Nome da Mãe</label>
                    <input type="text" class="form-control" name="_nomeMae" id="inputNomem" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputTelm">Telefone</label>
                    <input type="number" class="form-control" name="_telefoneMae" id="inputTelm" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>

            <!-- Quarta Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputLocm">Local de Trabalho</label>
                    <input type="text" class="form-control" name="_localTrabMae" id="inputLocm" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputProfm">Profissão</label>
                    <input type="text" class="form-control" name="_profissaoMae" id="inputProfm" required
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>

            Quinta Linha
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

        </div>
    </div>
</div>