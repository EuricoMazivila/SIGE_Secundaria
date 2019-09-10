<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Escola</a></li>
        <li><a href="../../Ensino">Ensino</a></li>
        <li><a href="../Aluno">Gestao de Alunos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>
<div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão de Alunos<?php 
  
  echo ' da '.$_SESSION['nome_Escola'];?></h3>
  <hr>
        <hr>

    </div>


    <div class="container mt-4">
    
        <div class="form-row mt-4">
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4 ">
                <a class="btn btn-primary btn-block" href="Ensino/Aluno">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Registar</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block " href="Ensino">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Explorar</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-primary btn-block " href="Ensino/Professor">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Matricular</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block " href="Ensino/Turmas">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Turmas</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-primary btn-block " href="Ensino\Disciplina">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Disciplina</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block " href="Ensino\Avalicoes">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Avaliacoes</span></a>
                </a>
            </div>
        
            
        </div>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codigo Aluno</th>
                        <th>Nome Completo</th>
                        <th>Data Ingresso</th>
                        <th>Classe Ingresso</th>
                        <th>Data Saida</th>
                        <th>Classe Atual/Saida</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="ResultadoEscolaBusca">
                     <?php 
                    require_once('../../Dao/processa_aluno.php');
                    busca_Alunos();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--Deve-se Organizar este codigo -->


</div>