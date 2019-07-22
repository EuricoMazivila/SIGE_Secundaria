<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="_css/estilo_login.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css"> 
    <script src="jquery/_js/jquery.js"></script>
    <script src="bootstrap/_js/bootstrap.js"></script>
    <title>Login</title>
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

    <!--Deve-se Analisar-->
    <footer class="fixed-bottom col-md-12"> 
        <div class="container rodape" >
            <div class="row">
                <div class="col-xs-6">
                    <p>2019| &copy SIGA-SECUNDARIA | STUDENTS</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>