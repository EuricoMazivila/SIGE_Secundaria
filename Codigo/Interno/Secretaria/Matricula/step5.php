<!DOCTYPE html>
<html>
<head>
    <title>Terceiro passo secretaria</title>
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
   <form method="POST" role="form">
        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Dados Académicos</legend>
                    <hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputDadm">Pretende-se Matricular na classe</label>
                        <select class="form-control" id="inputDadm">
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>    
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSec">Secção a matricular-se</label>
                        <select class="form-control" id="inputSec">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option> 
                        </select>
                    </div>
                    <legend>Dados do ultimo ano Academico</legend>
                    <hr>
                    <!--Fieldset-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputCla">Classe</label>
                        <select class="form-control" id="inputCla">
                            <option>7</option>
                            <option>8</option>
                            <option>9</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTurm">Turma</label>
                        <input type="text" class="form-control" id="inputTurm">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNr">Nr</label>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <input type="number" id="inputNr"  name="" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAn">Ano</label>
                        <select class="form-control" id="inputAn">
                            <option>2010</option>
                            <option>2011</option>
                            <option>2012</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEns">Ensino</label>
                        <select class="form-control" id="inputEns">
                            <option>Primário </option>
                            <option>Secundário</option> 
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEsc">Na Escola</label>
                        <select class="form-control" id="inputEsc">
                            <option>Escola</option> 
                        </select>       
                    </div>
                </fieldset>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Dados Adicionais</legend>
                    <hr></hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputImagem"></label>
                        <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
                        <div class="text-center">
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="avatar-2" name="userImage" type="file" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Organizar os ficheiros deve ter uma opcao para abrir os ficheiros-->
                    <!--BI-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSbi">BI</label>
                        <input type="file" class="form-control" name="" id="inputSbi">
                    </div>
                    <!--Certificado-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputScert">Certificado de Habilitações</label>
                        <input type="file" class="form-control" name="" id="inputScert">    
                    </div>
                    <!--Dados Adicionais-->
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSofd">Sofre de Alguma doença</label> 
                        <select class="form-control" id="inputSofd" aria-placeholder="Selecione uma opcao">
                            <option>Sim</option>
                            <option>Não</option>
                        </select>    
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputInd">Em caso afirmativo indique-a</label>
                        <textarea class="form-control" rows="5" cols="10" id="inputInd"></textarea>
                    </div>
                </fieldset>
                <div class="row">
                    <a class="btn btn-info offset-1 mt-5" href="step3.php">
                        <i class="fas fa-arrow-left"></i> &nbsp; Voltar
                    </a>

                    <button class="btn btn-success offset-1" type="submit">
                        <a href="Home_page Secretaria11.html"><i class="fas fa-save"></i></a> &nbsp; Matricular
                    </button>
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









 