
<div class="centro_login">
    <div class="modal-dialog text-center c">
        <div class="col-sm-11 main-section">
            <div class="modal-content form-input" id="principal">

                <div class="col-12">
                    <div class="col-12 bemVindo">
                        <h2>Bem Vindo</h2>
                        <hr>
                    </div>

                    <form class="col-sm-12" method="POST" action="Dao/processa_login.php">
                        <div class="us form-row mt-2">
                            <i class="fa fa-user form-group col-1"></i>
                            <input class="form-group col-11 log w-50" id="usuario" type="text" name="user" required placeholder="Insira o username">
                        </div>

                        <div class="pass form-row mt-4">
                            <i class="fa fa-key form-group col-1"></i>
                            <input class="form-group col-11 log w-50" type ="password" id="password" name="senha" required placeholder="Insira o password">
                        </div>
                    
                        <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                    </form> 
                </div>
                <div class="col-12 esqueceu">
                        <a href="Recuperacao_Step_0.php">Esqueceu Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
