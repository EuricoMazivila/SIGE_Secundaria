<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Candidato.php">Gestao de candidatos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrícula de aluno</h3>
        <hr>
    </div>

    <div class="form-row">
    	<div class="pesq row offset-sm-1 col-sm-6 mt-2">
            <i class="fa fa-search form-group col-1"></i>
            <input class="form-group col-11" id="pesquisar" name="nome_candidato" type="search" required placeholder="Pesquise nome do pré-matriculado">
        </div>

        <a class="btn btn-primary offset-sm-3 col-sm-1 mt-2" href="">
            <span class="i-color-white"> <i class="fas fa-print "></i>
               	Imprimir
            </span>
        </a>
    </div>

    <div class="form-row">

    	<div class="table-responsive" id="result">
            <table class="table table-hover offset-md-1 col-md-10" id="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Turno</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                		<td>56656</td>
                		<td>Ricardo Bucene</td>
                		<td>Diurno</td>
                		<td>10</td>
                	</tr>

                	<tr>
                		<td>86556</td>
                		<td>Absalao Nhantumbo</td>
                		<td>Noturno</td>
                		<td>12</td>
                	</tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="size offset-6">
        <ul class="lista">
            <li role="button" id="myBtn" onclick="popup()"><a href="Matricular_Step_1.php"><i class="fa fa-eraser fa-2x"></i><span>Matricular aluno</span></a> </li>
        </ul>
    </div>
</div>