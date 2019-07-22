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
    <form class="" id="myForm" role="form" method="POST">
        <!--Primeira Linha-->
        <div class="row mt-4">
            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Dados Pessoais</legend>
                    <hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputSobrenome">Apelido</label>
                        <input type="text" name="apelido" id="inputSobrenome" class="form-control" placeholder="Introduza o Apelido">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNome">Nome</label>
                        <input type="text" name="" id="inputNome" class="form-control" placeholder="Introduza o Nome">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputNacionalidade">Nacionalidade</label>
                        <input list="Nacionalidade" class="form-control" id="inputNacionalidade"
                                placeholder="Seleciona a Nacionalidade">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputProvincia">Província de Nascimento</label>
                        <input list="Provincia" class="form-control" id="inputProvincia"
                        placeholder="Seleciona a Provincia">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDistrito">Distrito de Nascimento</label>
                        <input list="Distrito" class="form-control" id="inputDistrito"
                                    placeholder="Seleciona o Distrito">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDataNascimnto">Data de Nascimento</label>
                        <input type="date" name="" id="inputDataNascimnto" name="" class="form-control"> 
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBI">Tipo de Documento de Identificação</label>
                        <input list="BI" class="form-control" id="inputBI"
                                    placeholder="Seleciona o Documento de Identificacao">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBinr">Documento de Identificação Nr</label>
                        <input type="number" class="form-control" name=" " id="inputBinr"  placeholder="Introduza o nr do documento de identificacao">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputArquivo">Arquivo de Identificação</label>
                        <input list="EmissaoBI" class="form-control" id="inputArquivo"
                                    placeholder="Local de emissão do BI">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDataEm">Data de Emissão</label>
                        <input type="date" name="" id="inputDataEm" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputSexo">Sexo</label>
                        <input list="Sexo" class="form-control" id="inputSexo"
                                    placeholder="Selecione o Sexo">
                    </div>
                </fieldset>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 offset-1 alt_coluna">
                <fieldset disabled>
                    <legend>Morada</legend>
                    <hr>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12 mt-4">
                        <label for="inputProvincia">Província</label>
                        <input list="Provincia" class="form-control " id="inputProvincia" placeholder="Seleciona a Província">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputDistrito">Distrito</label>
                        <input list="Distrito" class="form-control" id="inputDistrito" placeholder="Seleciona o Distrito">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputAvenida">AV/Rua</label>
                        <input list="Avenidas" class="form-control" id="inputAvenida" placeholder="Seleciona a Avenida">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputBairro ">Bairro</label>
                        <input list="Bairros" class="form-control" id="inputBairro" placeholder="Seleciona o Bairro">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputQuarterao">Quarteirão Nr</label>
                        <input type="number" class="form-control" id="inputQuarterao" placeholder="Introduza Numero de Quarteirão">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputCasa">Casa Nr</label>
                        <input type="number" class="form-control" id="inputCasa" placeholder="Introduza Numero da casa">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputTel">Número de Telefone</label>
                        <input type="number" class="form-control" id="inputTel" placeholder="Introduza Numero de Telefone">
                    </div>
                    <div class="form-group col-xs-12 col-sm-10 col-md-12 col-lg-12">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Introduza o email">
                    </div>
                </fieldset>
                <a class="btn btn-info offset-1 mt-5" href="step3.php">
                    <i class="fas fa-arrow-right"></i> &nbsp; Próximo
                </a>
            </div>
        </div>
    </form>
    <!--Datalist de Nacionalidade-->
    <datalist id="Nacionalidade">
        <option value="Angola">
        <option value="Mocambique">
    </datalist>
    <!--Datalist de Provincia-->
    <datalist id="Provincia">
        <option value="Maputo">
        <option value="Gaza">
    </datalist>
    <!--Datalist de Distito-->
    <datalist id="Distrito">
        <option value="Maracuene">
        <option value="Manhica">
    </datalist>
    <!--Datalist de EmissaoBI-->
    <datalist id="EmissaoBI">
        <option value="Maracuene">
        <option value="Manhica">
    </datalist>
    <!--Datalist de Tipo de BI-->
    <datalist id="BI">
        <option value="BI">
        <option value="NUIT">
        <option value="Cedula">
        <option value="Passaporte">
    </datalist>
    <!--Datalist de Sexo-->
    <datalist id="Sexo">
        <option value="Masculino">
        <option value="Femenino">
    </datalist>
</div>
            
        </div>


        <?php 
include('../../rodape.php');
?>

</body> 
</html>


