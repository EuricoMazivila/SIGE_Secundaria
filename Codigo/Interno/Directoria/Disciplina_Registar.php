<!DOCTYPE html>
<html>

<head>
    <title>Registar disciplina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap/_css/bootstrap.css">
    <link rel="stylesheet" href="../../css/outros/estilo_.css">
    <link rel="stylesheet" href="../../css/outros/MenLateral.css">
    <link href="../../fontawesome-free-5.8.2-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/outros/estilo1.css">
    <script src="../../jquery/jquery.js"></script>
    <script src="../../bootstrap/_js/bootstrap.js"></script>

    <script src="../../js/outros/js/highcharts.js"></script>
    <script src="../../js/outros/modules/exporting.js"></script>
    <script src="../../js/outros/modules/export-data.js"></script>

</head>

<body>

<?php
include ('header.php');
?>


    <?php
        include ('menuLateral.php');
    ?>

    <div class="centroo col-md-12">
        <!--div para parte central -->

        <div class="container">
            <div class="page-header">
                <h3 class="mt-5 offset-1">Adicionar nova disciplina</h3>
                <hr>
            </div>

            <!--Formulario-->
            <div class="container-fluid padding">
                <form method="POST" role="form" action="../DAO/processamento.php">
                    <fieldset class="offset-1">
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 mt-4">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label for="inputNivel">Nome da Disciplina</label>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <input type="text" class="form-control" id="inputNivel" name='nomeDisciplina'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-6 mt-4">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label for="inputTipo">Tipo</label>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <select class="form-control" id="inputTipo" name='tipoDisciplina'>
                                        <option value="Geral">Geral</option>
                                        <option value="A">Letras</option>
                                        <option value="B">Ciencias com Biologia</option>
                                        <option value="C">Ciencias com Desenho</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-sm-6 col-md-6">
                            <label class="col-md-2"></label>
                            <div class="col-md-10 offset-7">
                                <a class="btn btn-info" href="Disciplina.php">
                                    <i class="fas fa-arrow-left"></i> &nbsp; Voltar
                                </a>
                                <button type="submit" class="btn btn-success" name="AdicionaDisciplina">
                                    <i class="fas fa-save"></i>&nbsp; Gravar
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php 
        include('rodape.php');
    ?>

    <script src="js/outros/contador.js"></script>
</body>

</html>