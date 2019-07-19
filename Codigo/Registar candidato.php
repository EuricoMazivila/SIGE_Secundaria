<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        $titulo="Registar Disciplina";
        include_once('metadados.php');
    ?>
</head>

<body>
    <div class="container">
        <?php
        include_once('Config/navbar.php');
        ?>
        <div class="containe-fluid top-margin">
            <!--Adicionando o menu do Matricula-->
            <?php
           include_once('Config/menuMatricula.php');
           ?>
            <!--Aqui fica o corpo-->

            <div class="menuT ">
                <div class="container">
                    <div class="row top-margin">
                        <ol class="breadcrumb col-10 col-sm-12">
                            <li><a href="Home_page Secretaria11.html">Home</a></li>
                            <li><a href="Candidatos.html">Gestao de candidatos</a></li>
                            <small id="lect">Ano lectivo 2019</small>

                        </ol>
                    </div>
                    <div class="page-header">
                        <h3 class="mt-5 offset-md-1 text-center">Registar candidato</h3>
                        <hr class="light">

                    </div>
                    <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="digitNome">Nome</label>
                                <input type="text" name="" id="digitNome" class="form-control" required
                                    placeholder="Introduza o Apelido">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5 offset-sm-2">
                                <label for="pickClasse">Classe anterior</label>
                                <select class="form-control" id="pickClasse">
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="pickClass">Classe a matricular</label>
                                <select class="form-control" id="pickClass">
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5 offset-sm-2">
                                <label for="pickTurno">Regime</label>
                                <select class="form-control" id="pickTurno">
                                    <option>Diurno</option>
                                    <option>Nocturno</option>
                                    <option>A distancia</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                        </div>
                        <div class="form-row">
                        <div class="form-group col-sm-5">
                                <label for="pickProv">Provincia da escola de origem</label>
                                <select class="form-control" id="pickProv">
                                    <option>Maputo</option>
                                    <option>Gaza</option>
                                    <option>Inhambane</option>
                                    <option>Tete</option>
                                    <option>Cabo Delgado</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-sm-5  offset-sm-2">
                                <label for="pickDist">Distrito da escola de origem</label>
                                <select class="form-control" id="pickDist">
                                    <option>KaMavota</option>
                                    <option>KaMubukwana</option>
                                    <option>KaLhamankulo</option>
                                    <option>KaTembe</option>
                                    <option>KaNhaka</option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5 ">
                                <label>Escola de origem</label>
                                <select class="form-control">
                                    <option>Escola Secundaria Joaquim Chissano</option>
                                    <option>Escola Secundaria Herois Mocambicanos</option>
                                    <option>Escola Secundaria Quisse Mavota</option>
                                    <option>Escola Secundaria Santa Montanha</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-row">
                            <div class="form-group col-6 col-sm-5 col-md-2">

                                <a class="btn btn-danger btn-block text-left" href="Candidato.html">
                                <span class="i-color-white">
                                    <i class="fa fa-window-close"></i> Cancelar
                                </span>
                               </a>
                            </div>
                            <div class="form-group col-6 col-sm-5  col-md-2 offset-sm-2 offset-md-1">
                                <button class="btn btn-success btn-block text-left">
                                <span class="i-color-white"><i class="fa fa-save"></i>
                                Salvar </span>
                            </button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>



        </div>
    </div>
    <?php 
include_once('footer.php');
?>