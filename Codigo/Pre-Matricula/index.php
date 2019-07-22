<?php
    session_start();
    $_SESSION['FalhaLogin']="";

	if(!isset($_SESSION['preMatricula'])){
		header('Location: login.php');
    }
    
?>
<?php
$titulo='Pre Matricula Aluno';
include('metadados.php');
?>

<body>
    <!--Cabecalho
    <div class="row">
        <header class="fixed-top col-md-12">
            <div class="navbar-header">
                <a class="mb-0 siga" href="#">SIGA</a>
            </div>
        </header>
    </div>

    <div class="container">
        <form method="POST" id="myForm" action="dao/processa_formulario.php" role="form" data-toggle="validator">
        <!--  <br />
            <input type="submit" value="Submeter" name="submeter">
            -- SmartWizard html 
            <div id="smartwizard" class="mt-5 offset-1">
                <ul>
                    <li id="stp1"><a class="step" href="#step-1">Dados Pessoais<br><small>Passo 1</small></a></li>
                    <li id="stp2"><a class="step" href="#step-2">Morada<br><small>Passo 2</small></a></li>
                    <li id="stp3"><a class="step" href="#step-3">Filiação<br><small>Passo 3</small></a></li>
                    <li id="stp4"><a class="step" href="#step-4">Encarregado<br><small>Passo 4</small></a></li>
                    <li id="stp5"><a class="step" href="#step-5">Matricula<br><small>Passo 5</small></a></li>
                    <li id="stp6"><a class="step" href="#step-6">Outros Dados<br><small>Passo 6</small></a></li>
                </ul>
            <div>-->
            <div class="container">
            <form method="POST" id="myForm" action="dao/processa_formulario.php" role="form" data-toggle="validator">
            <?php
                include ('Formularios/dados.php');
                include('Formularios/step1.php');
                include('Formularios/step2.php');
                include('Formularios/step3.php');
                include('Formularios/step4.php');
                include('Formularios/step5.php');
                include('Formularios/step6.php');

            ?>
          <!-- </div>-->
        </form>
    </div>

    <!--Rodape-->
    <footer class="fixed-bottom rodape ">
        <div class="conatiner-fluid padding">
            <div class="row text-center">
                <div class="col-lg-12">
                <p><?php echo date("Y")?>| &copy SIGA-SECUNDARIA | STUDENTS</p>
                </div>
            </div>
        </div>
    </footer>
<!--

    <form action="DAO/processamento.php" method="post">
        <input type="submit" value="Teminar Sessao" name="fecharSecao">;
    </form>
-->

    <!--Javascript de Bootstrap-->
    <script src="../bootstrap/_js/bootstrap.js"></script>
    <!-- Include jQuery -->
    <script src="../jquery/jquery.js"></script>
    <script src="../js/outros/validator.js"></script>
    <script src="../jquery/smartwizard/_js/jquery.smartWizard.js"></script>
    <script src="../js/outros/popper.js"></script>
    <script src="../js/outros/steps_pre_matricula.js"></script>
    <script src="../fontawesome-free-5.8.2-web/js/all.js"></script>

    <!--Include FileInput Javascript-->
    <script src="../fileinput/js/fileinput.js"></script>
    <!-- the fileinput plugin initialization -->
    <script src="../js/outros/fileinput.js"></script>

    <!--
    <script src="fileinput/js/plugins/piexif.min.js"><script>
    <script src="fileinput/js/plugins/purify.min.js"><script>
    <script src="fileinput/js/plugins/sortable.min.js"><script>
    -->
</body>

</html>