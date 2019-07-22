<!DOCTYPE html>
<html>
<head>
    <title>Primeiro passo secretaria</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/outros/estilo_.css">
    <link rel="stylesheet" href="../../../css/outros/MenLateral.css">
    <link rel="stylesheet" href="../../../css/outros/estilo1.css">
  <link href="../../../fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet"> 
  <link rel="stylesheet" href="css/outros/Testando.css">
  <script src="../../../jquery/jquery.js"></script>
  <script src="../../../bootstrap/_js/bootstrap.js"></script>
  <script src="../../../js/outros/highcharts.js"></script>
  <script src="../../../js/outros/exporting.js"></script>
  <script src="../../../js/outros/export-data.js"></script>
  <script src="../../../js/outros/contador.js"></script>
  <script src="../../../js/outros/TestandoMatricula.js"></script>

    <script >
        $(function(){
            $('.size').styleddropdown();
        });
    </script>

</head>
<body>

 <div class="row"> <!--header -->
    
    <header class="fixed-top">
    <nav class="navbar navbar-expand-lg  bg-nav navbar-light col-md-12" role="navigation"> 

        <div class="navbar-header">
            <a class="navbar-brand h1 mb-0" href="#">SIGA</a>
        </div>

            <span id="bel">  <!--icone de bell -->
                <i class="fas fa-bell"></i>
            </span>

            <span id="env">  <!--icone de envelope  -->
                <i class="fas fa-envelope"></i>
             </span>
            
            <div class="form-group">
                    <select class="form-control">
                        <option>Ricardo</option>
                        <option>Sobre nos</option>
                        <option>Sair</option>
                    </select>
            </div>
    </nav>  
    </header>
</div> 


<div class="row container">
        
        <div class="area">
            
        <?php
      include ('menuLateral.php');
      ?>

        <div class="centroo col-md-12">  <!--div para parte central -->

            <div class="container">
                <h3>Matricular aluno</h3>
                <hr>

                <div class="page-header">

                    <div class="table-responsive">
                        <table class="table table-hover col-sm-10 mt-5">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nome Completo</th>
                                    <th>Classe</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>5555</td>
                                    <td>Candido Mazivila</td>
                                    <td>9</td>
                                </tr>
                            </tbody>
                        </table>
                     </div>
                </div>

            </div>

            <div class="size offset-6">
                <ul class="lista">
                    <li><a href="#"><i class="fa fa-trash-alt fa-2x"></i><span>Remover</span></a> </li>
                    <li><a href="step1.php"><i class="fa fa-eraser fa-2x"></i><span>Matricular</span></a> </li>
                </ul>
            </div>
        </div>


        <?php 
include('../../rodape.php');
?>

</body> 
</html>