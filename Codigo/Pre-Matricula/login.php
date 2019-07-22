<?php 
    $titulo="Login Pre Matricula";
    require_once('metadados.php');
    ?>
<body>
<div class="modal-dialog text-center">
        <div class="col-sm-11">
            <div class="modal-content pre_matricula" id="pre_matricula">
                <div class="col-12">
                    <div class="col-12 intro" >
                        <h1>Introduza a referência de acesso</h1>
                    </div>
                    <form class="col-12" method="POST" action="DAO/processamento.php">
                        <div class="form-group form-group_sc"> 
                            <input type="text" class="form-control" name="inputCod">
                        </div>
                        <span><?php //echo 
                        session_start();
                        echo $_SESSION['FalhaLogin'];?></span>
                        <div class="form-group form-group_sc"> 
                            <button type="submit" class="btn btn-success" name="entrar">Entrar</button>
                        </div>     
                    </form>
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