<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="../">Escola</a></li>
        <li><a href="../Ensino">Ensino</a></li>
       
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>
<div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão do Ensino <?php 
  
        echo 'na '.$_SESSION['nome_Escola'];?></h3>
        <hr>

    </div>


    <div class="container mt-4">
    
        <div class="form-row mt-4">
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-primary btn-block  estloBtn" href="Aluno">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Alunos</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block  estloBtn" href="Aulas">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Aulas</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-info btn-block  estloBtn" href="Professor">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Professores</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-warning btn-block  estloBtn" href="Turmas">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Turmas</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-secondary btn-block  estloBtn" href="Disciplina">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Disciplina</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-success btn-block  estloBtn" href="Avaliacoes">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Avaliacoes</span></a>
                </a>
            </div>
       
        
        </div>

    </div>
</div>
<!--Deve-se Organizar este codigo -->


</div>