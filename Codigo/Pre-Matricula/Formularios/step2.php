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
                        <input list="Provincia" class="form-control" name="_provinciaM" id="inputProvincia" required
                            placeholder="Seleciona a Província">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputDistrito">Distrito</label>
                        <input list="Distrito" class="form-control" name="_distritoM" id="inputDistrito" required
                            placeholder="Seleciona o Distrito">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                </div>

                <!--Segunda Linha-->
                <div class="row">
                    <!--Tirar-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputAvenida">AV/Rua</label>
                        <input list="Avenidas" class="form-control" name="_avenida" id="inputAvenida" required
                            placeholder="Seleciona a Avenida">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputBairro">Bairro</label>
                        <input list="Bairros" class="form-control" name="_bairroM" id="inputBairro" required
                            placeholder="Seleciona o Bairro">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                </div>
                <!--Terceira Linha-->
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputQuarterao">Quarteirão Nr</label>
                        <input type="number" class="form-control" name="_quarterao" id="inputQuarterao" required
                            placeholder="Introduza Numero de Quarteirão">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputCasa">Casa Nr</label>
                        <input type="number" class="form-control" name="_nrCasa" id="inputCasa" required
                            placeholder="Introduza Numero da casa">
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
                        <input type="number" class="form-control" name="_Nr_Tell" id="inputTel" required
                            placeholder="Introduza Numero de Telefone">
                        <div class="help-block with-errors text-danger"></div>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" name="_Email" id="inputEmail"
                            placeholder="Introduza o email">
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>