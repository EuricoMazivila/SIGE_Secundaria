<?php 
    $titulo="Login Geral";
    require_once('metadado.php');
    ?>
<body>
<div class="modal-dialog text-center c">
        <div class="col-sm-9 main-section">
            <div class="modal-content form-input" id="principal">
                <div class="col-12">
                    <div class="col-12 bem">
                        <h2>Bem Vindo</h2>
                    </div>
                    <form class="col-12" method="POST" action="DAO/processamento.php">
                        <div class="form-group form-group_pr">
                            <input type="text" class="form-control" placeholder="Usuario" name="inputUsuario">
                        </div>
                        <div class="form-group form-group_pr">
                            <input type="password" class="form-control" placeholder="Senha" name="inputSenha">
                        </div>
                        <div> <span><?php
                        session_start();
                         echo $_SESSION['FalhaLogin'];
                         ?></span></div>
                        <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                    </form> 
                </div>
                <div class="col-12 esqueceu">
                        <a href="#">Esqueceu Password?</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="fixed-bottom col-md-12"> 
        <div class="container rodape" >
            <div class="row">
                <div class="col-xs-6">
                    <p><?php echo date("Y")?>| &copy SIGA-SECUNDARIA | STUDENTS</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>