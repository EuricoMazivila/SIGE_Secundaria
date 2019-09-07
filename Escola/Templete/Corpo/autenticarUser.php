

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Login Principal</h3>
        <hr>

    </div>

    <div class="container">
        <form method="POST" role="form" action="Dao/processa_autenticar.php">
            <div class="form-row">
                <div class="col-sm-6 offset-sm-3">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="Username" class="form-control" 
                        placeholder="Introduza o username">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-sm-6 offset-sm-3">
                <label for="Senha">Senha</label>
                    <input type="password" name="Senha" id="Senha" class="form-control" 
                        placeholder="Introduza a Senha">
                    <div class="help-block with-errors"></div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-sm-4 offset-sm-2">
                    <a class="btn btn-danger " href="Candidato.php">
                        <span class="i-color-white">
                            <i class="fa fa-window-close"></i>Cancelar </span></a>
                    </a>
                </div>
                <div class="col-sm-4 offset-sm-1">
                    <input type="submit" class="btn btn-success fa fa-save i-color-white" name="Entrar" value="Salvar">
                        <span class="i-color-white"><i class="fa fa-save"></i>Entrar</span>
                    <!--</a>-->
                </div>
            </div>



        </form>
    </div>
</div>
<!--Deve-se Organizar este codigo -->


</div>