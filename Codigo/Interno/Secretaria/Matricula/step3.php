<!DOCTYPE html>
<html>
<head>
    <title>Segundo passo secretaria</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/outros/estilo_.css">
    <link rel="stylesheet" href="../../../css/outros/MenLateral.css">
    <link rel="stylesheet" href="../../../css/outros/estilo1.css">
  <link href="../../../fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet"> 
  <link rel="stylesheet" href="../../../css/outros/Testando.css">
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
            <div class="container-fluid padding">
    <form method="POST" role="form">
        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Filiação</legend>
                    <hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputNomep">Nome do Pai</label>
                        <input type="text" class="form-control" name="" id="inputNomep" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelP">Telefone</label>
                        <input type="number" class="form-control" name="" id="inputTelp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocp">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfp">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfp" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNomem">Nome da Mãe</label>
                        <input type="text" class="form-control" name="" id="inputNomem" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelm">Telefone</label>
                        <input type="text" class="form-control" name="" id="inputTelm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocm">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfm">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfm" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="enc">O Encarregado é</label>
                        <select id="enc" class="form-control" aria-placeholder="Selecione uma opcao">
                            <option>Pai</option>
                            <option>Mãe</option>
                            <option>Outro</option>
                        </select>
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Encarregado</legend>
                    <hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputNomeenc">Nome do Encarregado</label>
                        <input type="text" class="form-control" name="" id="inputNomeenc" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTelEnc">Telefone</label>
                        <input type="number" class="form-control" name="" id="inputTelEnc" placeholder="Introduza ">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputres">Residência/Bairro</label>
                        <select class="form-control" id="inputres" aria-placeholder="Selecione uma opcao">
                            <option>Selecione uma opcao x</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAv">Av/Rua</label>
                        <select class="form-control" id="inputAv">
                            <option>Exemplo</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputLocenc">Local de Trabalho</label>
                        <input type="text" class="form-control" name="" id="inputLocenc" placeholder="Introduza ">  
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProfenc">Profissão</label>
                        <input type="text" class="form-control" name="" id="inputProfenc" placeholder="Introduza ">
                    </div>
                </fieldset>  
                <div class="row">
                    <a class="btn btn-info offset-1 mt-5" href="step1.php">
                        <i class="fas fa-arrow-left"></i> &nbsp; Voltar
                    </a>
                    
                    <a class="btn btn-info offset-1 mt-5" href="step5.php">
                        <i class="fas fa-arrow-right"></i> &nbsp; Próximo
                    </a>
                </div> 
            </div>
        </div>    
    </form>
</div>
            
<?php 
include('../../rodape.php');
?>


      

</body> 
</html>





