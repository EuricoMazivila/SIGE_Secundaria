<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $titulo="Login Principal";
        include_once('metadados.php');
      
    ?>
      <link rel="stylesheet" href="_css/estilo_login.css">
</head>
<body>
    <div class="modal-dialog text-center c">
        <div class="col-sm-9 main-section">
            <div class="modal-content form-input" id="principal">
                <div class="col-12">
                    <div class="col-12 bemVindo">
                        <h2>Bem Vindo</h2>
                    </div>
                    <form class="col-12" method="POST" action="Dao/processa_login.php">
                        <div class="form-group form-group_pr">
                            <input type="text" class="form-control" placeholder="Usuario" name="inputUsuario">
                        </div>
                        <div class="form-group form-group_pr">
                            <input type="password" class="form-control" placeholder="Senha" name="inputSenha">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Entrar</button>
                    </form> 
                </div>
                <div class="col-12 esqueceu">
                        <a href="#">Esqueceu Password?</a>
                </div>
            </div>
        </div>
    </div>

    <?php 
include_once('footer.php');
?>