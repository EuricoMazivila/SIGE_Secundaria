<!--Passo 4-->
<div id="step-4" class="mt-4">
    <div class="container-fluid padding">
        <div id="form-step-3" role="form" data-toggle="validator">
            <!--Primeira Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputNomeenc">Nome do Encarregado</label>
                    <input type="text" class="form-control" name="_nomeEnc" required id="inputNomeenc"
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputTelEnc">Telefone</label>
                    <input type="number" class="form-control" name="_telefoneEnc" required id="inputTelEnc"
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>

            <!--Segunda Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputres">Bairro</label>

                    <input list="Bairro" class="form-control" name="_moradaEnc" id="inputres" required
                        placeholder="Selecione uma opcao">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <!--Tirar-->
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputAv">Av/Rua</label>
                    <select class="form-control" required id="inputAv">
                        <option>Exemplo</option>
                    </select>
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>

            <!--Terceira Linha-->
            <div class="row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputLocenc">Local de Trabalho</label>
                    <input type="text" class="form-control" name="_localTrabEnc" required id="inputLocenc"
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputProfenc">Profissão</label>
                    <input type="text" class="form-control" name="_profissaoEnc" required id="inputProfenc"
                        placeholder="Introduza ">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
        </div>
    </div>
</div>