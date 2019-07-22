<!DOCTYPE html>
<html>

<head>
    <title>Disciplina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="../../css/outros/estilo_.css">
    <link rel="stylesheet" href="../../css/outros/MenLateral.css">
    <link href="../../fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/outros/Testando.css">
    <script src="../../jquery/jquery.js"></script>
    <script src="../../bootstrap/_js/bootstrap.js"></script>
    <script src="../../js/outros/TestandoDisciplina.js"></script>
    <script src="../../js/outros/js/highcharts.js"></script>
    <script src="../../js/outros/modules/exporting.js"></script>
    <script src="../../js/outros/modules/export-data.js"></script>

    <script>
        $(function () {
            $('.size').styleddropdown();
        });
    </script>

</head>

<body>

<?php
include ('../header.php');
?>


    <?php
include ('menuLateral.php');
?>

    <div class="centroo col-md-12">
        <!--div para parte central -->

        <div class="container">
            <h3>Adicionar Disciplina</h3>
            <hr>
            <a class="btn btn-success offset-sm-11" href="Disciplina_Registar.php">
                <i class="fas fa-plus"></i> &nbsp; Nova
            </a>
            <div class="page-header">

                <div class="table-responsive">
                    <table class="table table-hover col-sm-10 offset-sm-1">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include_once('../DAO/consultas.php');
                                $executar=busca("SELECT * FROM `disciplina` order by id_disciplina");
                                while($linha=mysqli_fetch_array($executar)){
                                    ?>


                            <tr>
                                <td><?php echo $linha['id_disciplina'];?> </td>
                                <td><?php echo $linha['Descricao'];?></td>
                                <td><?php echo $linha['Tipo'];?></td>
                            </tr>
                            <?php
                                }?>
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>

        <div class="size offset-6">
            <ul class="list">
                <li><a href="#"><i class="fa fa-trash-alt fa-2x"></i><span>Remover</span></a> </li>

                <li><a href="#"><i class="fa fa-eraser fa-2x"></i><span>Editar</span></a> </li>
            </ul>
        </div>

    </div>
    </div>

    <?php 
include('rodape.php');
?>

</body>

</html>

<!--

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite">
        </div>

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>


<div id="mySidebar" class="sidebar">    

        <div id="usuu">
            <p>
                <span style="font-size: 250%">
                    <i class="fas fa-user"></i>
                </span>
                Ricardo Mazivila
            </p><hr>
        </div>




    