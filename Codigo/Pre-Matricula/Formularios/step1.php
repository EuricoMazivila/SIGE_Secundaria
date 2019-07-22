<div id="step-1" class="mt-4">
    <div class="container-fluid">
        <div id="form-step-0" role="form" data-toggle="validator">
            <!--Primeira Linha-->
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputSobrenome">Apelido</label>
                    <input type="text" name="_Apelido" id="inputSobrenome" class="form-control" required
                        placeholder="Introduza o Apelido">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12  col-sm-12 col-md-4 offset-1">
                    <label for="inputNome">Nome</label>
                    <input type="text" name="_Nome" id="inputNome" class="form-control" required
                        placeholder="Introduza o Nome">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Segunda Linha-->
            <script>
            function mudar(){
                
                alert('Mudou');
                chos
            }
            </script>
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputNacionalidade">Nacionalidade</label>
                    <input list="Nacionalidade" class="form-control" name="_pais" id="inputNacionalidade" required
                        placeholder="Seleciona a Nacionalidade" onchange="mudar()">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputProvincia">Província de Nascimento</label>
                    <input list="Provincia" class="form-control" name="_provincia" id="inputProvincia" required
                        placeholder="Seleciona a Provincia">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Terceira Linha-->
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputDistrito">Distrito de Nascimento</label>
                    <input list="Distrito" class="form-control" name="_distrito" id="inputDistrito" required
                        placeholder="Seleciona o Distrito">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputDataNascimnto">Data de Nascimento</label>
                    <input type="date" name="" id="inputDataNascimnto" name="_Data_Nascimento" class="form-control"
                        required>
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Quarta Linha-->
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputBI">Tipo de Documento de Identificação</label>
                    <select class="form-control" name="_tipoBi" id="inputBI" required
                        placeholder="Seleciona o Documento de Identificacao">
                        <option value="BI">BI</option>
                        <option value="cedula">Cedula</option>
                    </select>
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputBinr">Documento de Identificação Nr</label>
                    <input type="number" class="form-control" name="_nrBI" id="inputBinr" required
                        placeholder="Introduza o nr do documento de identificacao">
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Quinta Linha-->
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputArquivo">Arquivo de Identificação</label>
                    <input list="EmissaoBI" class="form-control" name="_arquivo" id="inputArquivo" required
                        placeholder="Local de emissão do BI">
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputDataEm">Data de Emissão</label>
                    <input type="date" name="_DataEmissao" id="inputDataEm" class="form-control" required>
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!--Sexta Linha-->
            <div class="form-row">
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputSexo">Sexo</label>
                    <select class="form-control" name="_Sexo" id="inputSexo" required placeholder="Selecione o Sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                    <div class="help-block with-errors text-danger"></div>
                </div>
                <div class="form-group col-xs-12 col-sm-12 col-md-4 offset-1">
                    <label for="inputEstado">Estado Civil</label>
                    <select class="form-control" name="_Estado_Civil" id="inputEstado" required
                        placeholder="Selecione Estado civil">
                        <option value="Casado">Casado</option>
                        <option value="Solteiro">Solteiro</option>
                    </select>
                    <div class="help-block with-errors text-danger"></div>
                </div>
            </div>
            <!---->
        </div>
    </div>
</div>
  