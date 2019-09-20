<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/_css/bootstrap.css">
    <script src="jquery/jquery.js"></script>

    <title>Select Dependentes</title>
</head>

<body>
    <?php include('php/busca_dados.php');?>


    <div class="container">
        <div class="row">
            <h1>Criacao do Select Dependentes</h1>

        </div>
        <div class="form-row">
            <div class="form-group col-sm-5">
                <label for="pais">PAIS</label>
                <select name="pais" id="pais" class="form-control">
                    <option value="">Seleciona o Pais</option>
                    <?php busca_pais() ?>
                </select>
            </div>
            <div class="form-group col-sm-5 offset-sm-2">
                <label for="provincia"> PROVINCIA</label>
                <select name="provincia" id="provincia" class="form-control">

                </select>
            </div>
            <div class="form-group col-sm-5">
                <label for="distrito">DISTRITO</label>
                <select name="distrito" id="distrito" class="form-control">

                </select>
            </div>
            <div class="form-group col-sm-5 offset-sm-2">
                <label for="bairro">Bairro</label>
                <select name="bairro" id="bairro" class="form-control">

                </select>
            </div>
        </div>


    </div>

    <div class="container">
        <div class="row">
            <h1>Busca Sem Refresh</h1>

        </div>
        <div class="form-row">
            <div class="form-group col-sm-5">
                <input type="search" name="pesquisar" id="pesquisar" class="form-control"  placeholder="Pesquisa Pelo Nome ou Codigo do Aluno">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
            <div class="table-responsive" id="resultado">
                <table class="table table-hover" id="resultadoTabela">
                    <?php
                    busca_pessoa();
                    ?>
                </table>
            </div>
            </div>
        </div>


    </div>
    <!--Script que contem eventos para o funconamento dos Selects
    Dependenetes do JQuery-->
    <script src="js\Select_Dependentes_Localizacao.js">
    
    </script>



</body>

</html>