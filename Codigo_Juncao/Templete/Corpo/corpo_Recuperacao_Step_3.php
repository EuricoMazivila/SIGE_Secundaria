
<div class="centro_login">
    <div class="modal-dialog text-center c">
        <div class="col-sm-11 main-section">
            <div class="modal-content form-input" id="principal">

                <div class="col-12">
                    <div class="col-12 bemVindo">
                        <h5 class="text-center titulo">Recuperação de conta</h5>
                        <hr>
                    </div>

                    <form class="col-sm-12" method="POST" action="../../Dao/Processamento/processa_login.php">
                        <div class="us form-row mt-3">
                            <i class="fa fa-key form-group col-1"></i>
                            <input class="form-group col-11 log w-50" type="password" id="newPass" name="newSenha" required placeholder="Insira uma nova palavra passe">
                        </div>

                        <div class="pass form-row mt-4">
                            <i class="fa fa-key form-group col-1"></i>
                            <input class="form-group col-11 log w-50" type="password" id="newPass2" name="senha2" required placeholder="Volte a inserir a palavra passe">
                        </div>
                    
                        <button type="submit" onclick="popup()" id="submeter" name='SalvarRecuperacao' class="btn btn-primary" name="save">Salvar</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal">

            <div class="modal-content">
                <div class="container">
                    <div class="page-header">
                        <h3 class="offset-1">Confirmar Edição</h3>
                        <hr>
                    </div>

                    <form method="POST" role="form">
                        <div class="row">
                            <div class="form col-sm-10 col-md-4 offset-1">
                                <label for="inputVagas">Pretendes salvar os dados?</label>
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                                <a class="btn btn-danger text-left" onclick="closed()">
                                    <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp;
                                        Cancelar</span>
                                </a>
                            </div>
                            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                                
                                <a href="../Login\Login_Principal.php" class="btn btn-success text-left">
                                    <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span>
                                </a>

                                <!-- <button class="btn btn-success text-left" id="salvaPass" type="submit">
                                    <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span>
                                </button>    Quando estiver a trabalhar use esse botao e nao a ancora-->
                                
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
</div>