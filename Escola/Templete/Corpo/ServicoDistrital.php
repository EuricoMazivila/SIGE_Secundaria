<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Candidato.php">Gestao de DDEJ</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão da <?php echo $_SESSION['nome_Distrito'];?></h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->

    <div class="container mt-4">

        <div class="form-row mt-4">
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-primary btn-block  estloBtn" href="RegitarEscola.php">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Registar Escola</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block  estloBtn" href="Ensino">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Inspencionar Escola</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block  estloBtn" href="Ensino">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Outras Operacoes</span></a>
                </a>
            </div>
        </div>
        <form>
            <div class="offset-sm-1 col-sm-10 mt-4">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11 pesquisa" id="buscaEscola" name="nome_candidato" type="search"
                        required placeholder="Pesquise por escola">
                </div>
            </div>
        </form>
        
                </p>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Pertenca</th>
                        <th>Nivel</th>
                    </tr>
                </thead>
                
                <tbody id="ResultadoEscolaBusca">
    <?php include('../Dao\busca.php');
        dadosTabela($_SESSION['id_dira']);
        ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
