<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Escola</a></li>
        <li><a href="Candidato.php">Registo Escola</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Registar de Escola</h3>
        <hr>

    </div>
   
    <div class="container">
        <form method="POST" role="form" action="../Dao/processa_escola.php">
        <input class="ocultar"type="number" name="idDir" id="idDir"value=<?php echo  $_SESSION['id_dira'];?>>
   
        <div class="form-row">

                <div class="col-sm-5">
                    <label for="NomeEscola">Nome</label>
                    <input type="text" name="NomeEscola" id="NomeEscola" class="form-control" 
                        placeholder="Introduza da Escola">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label for="NivelEscola">Nivel</label>
                    <select class="form-control" id="NivelEscola" name="NivelEscola">
                        <option>Primaria</option>
                        <option>Secundaria</option>
                        <option>Tecnico</option>
                        <option>Superior</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-5">
                    <label for="PertencaEscola">Tipo</label>
                    <select class="form-control" id="PertencaEscola" name="PertencaEscola">
                        <option value="EPC grau 1">Escola Primaria do 1 Grau</option>
                        <option value="EPC grau 1">Escola Primaria do 2 Grau</option>
                        <option value="EPC grau 1">Escola Primaria do 1 e 2 Grau</option>
                        <option value="ESC grau 1">Escola Secundaria do 1 Grau</option>
                        <option value="ESC grau 1">Escola Secundaria do 2 Grau</option>
                        <option value="ESC grau 1">Escola Secundaria do 1 e 2 Grau</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-5 offset-sm-2">
                    <label for="PertencaEscola">Pertenca</label>
                    <select class="form-control" id="PertencaEscola" name="PertencaEscola">
                        <option>Publica</option>
                        <option>Privada</option>
                        <option>Comunitaria</option>

                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-12"> <span></span></div>
            </div>
            <fieldset class="mt-5">
                <legend>Localizacao da Escola</legend>

                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="BairroEscola">Bairro Localizacao</label>
                        <select class="form-control" id="BairroEscola" name="BairroEscola">
                        <?php include('../Dao\busca.php');
                            dadosBairos($_SESSION['id_dira']);
                        ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
          
                    <div class="col-sm-5 offset-sm-2">
                        <label for="AvenidaEscola">Avenida</label>
                        <input type="text" name="AvenidaEscola" id="AvenidaEscola" class="form-control" 
                            placeholder="Introduza a avenida">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="NrEscola">Nr</label>
                        <input type="number" name="NrEscola" id="NrEscola" class="form-control"
                            placeholder="Introduza a Numero ">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="QuarteraoEscola">Quarterao</label>
                        <input type="number" name="QuarteraoEscola" id="QuarteraoEscola" class="form-control"
                            placeholder="Introduza a avenida">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="mt-5">
                <legend>Dados do Administrador</legend>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label for="verConta">Possui uma Conta no Sistema?</label>
                        <select class="form-control" id="verConta" name="verConta" value='0'>
                        <option value=" " selected>Seleciona Para Dar Resposta</option> 
                        <option value="1">Sim</option>
                            <option value="2">Nao</option>

                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2 Sim">
                        <label for="NumeroConta" >Numero da Conta</label>
                        <input   type="text" name="NumeroConta" id="NumeroConta" class="form-control"
                            placeholder="Introduza o Numero da Conta">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row Nao">
                    <div class="col-sm-5">
                        <label for="NomeAdmin">Nome </label>
                        <input type="text" name="NomeAdmin" id="NomeAdmin" class="form-control"
                            placeholder="Introduza o nome do administrador">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="ApelidoAdmin">Apelido </label>
                        <input type="text" name="ApelidoAdmin" id="ApelidoAdmin" class="form-control"
                            placeholder="Introduza o apelido do administrador">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row Nao">
                    <div class="col-sm-5">
                        <label for="DataAdmin">Data de Nascimento </label>
                        <input type="date" name="DataAdmin" id="DataAdmin" class="form-control"
                            placeholder="Introduza o nome do administrador">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col-sm-5 offset-sm-2">
                        <label for="EmailAdmin">Email do Administrador</label>
                        <input type="email" name="EmailAdmin" id="EmailAdmin" class="form-control"
                            placeholder="Introduza o apelido do administrador">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </fieldset>


            <div class="row mt-5">
                <div class="form-group col-6 col-sm-5 col-md-4 ">
                    <a class="btn btn-danger " href="Candidato.php">
                        <span class="i-color-white">
                            <i class="fa fa-window-close"></i>Cancelar </span></a>
                    </a>
                </div>
                <div class="form-group col-6 col-sm-5 col-md-4">
                    <input type="submit" class="btn btn-success " name="RegistarEscola" value="Salvar">
                        <span class="i-color-white"><i class="fa fa-save"></i>Salvar</span>
                    <!--</a>-->
                </div>
            </div>



        </form>
    </div>
</div>
<!--Deve-se Organizar este codigo -->


</div>

