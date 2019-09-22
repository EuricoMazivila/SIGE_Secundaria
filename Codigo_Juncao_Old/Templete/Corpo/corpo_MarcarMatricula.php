<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Matriculas.php">Matriculas</a></li>
        <li><a href="MarcarMatricula.php">Marcar Matricula</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Marcar Matrícula</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-sm-3 col-4 col-md-2">
                    <label for="dataInic">Data de início </label>
                </div>
                <div class="col-sm-3 col-8">
                    <input type="date" name="" class="form-control" id="dataInic">
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group col-4 col-sm-3 col-md-2 offset-md-2">
                    <label for="dataInic">Data de fim </label>
                </div>
                <div class="col-8 col-sm-3">
                    <input type="date" name="" class="form-control" id="dataFim">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

        </form>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Turno</th>
                        <th>Total de vagas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8</td>
                        <td>Diurno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Noturno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Diurno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Noturno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Diurno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Noturno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Diurno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Noturno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Diurno</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>Noturno</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row ">
            <div class="form-group col-6 col-sm-5 col-md-4 mt-5 offset-md-1">
                <a class="btn btn-danger text-left" href="Matricula.php">
                    <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp; Cancelar</span>
                </a>
            </div>
            <div class="form-group col-6 col-sm-5 mt-5 offset-sm-2 col-md-4">
                <a class="btn btn-success text-left" href="MarcarMatricula.html">
                    <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span>
                </a>
            </div>
        </div>
        <div class="size offset-6">
            <ul class="listaa">
                <li role="button" id="myBtn" onclick="popup()"><a><i
                            class="fa fa-eraser fa-2x"></i><span>Editar</span></a> </li>
            </ul>
        </div>

        <div id="myModal" class="modal">

            <div class="modal-content">
                <div class="container">
                    <div class="page-header">
                        <h3 class="offset-1">Editar matricula</h3>
                        <hr>
                    </div>

                    <form method="POST" role="form">
                        <div class="row">
                            <div class="form col-sm-10 col-md-4 offset-1">
                                <label for="inputVagas">Total de vagas</label>
                                <input type="text" name="" id="inputVagas" class="form-control" required
                                    placeholder="Introduza o novo total de vagas">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                                <a class="btn btn-danger text-left" onclick="closed()">
                                    <span class="i-color-white"> <i class="fa fa-window-close fa-2x"></i>&nbsp;
                                        Cancelar</span>
                                </a>
                            </div>
                            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                                <button class="btn btn-success text-left" id="submete_vaga" type="submit">
                                    <span class="i-color-white"><i class="fa fa-save fa-2x"></i>&nbsp;Salvar</span>
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>


</div>
