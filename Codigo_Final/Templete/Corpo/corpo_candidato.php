<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Candidato.php">Gestao de candidatos</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Gestão de candidatos</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="ano">Ano </label>
                </div>
                <div class="col-4 col-sm-4">
                    <select name="ano" id="ano" class="form-control">
                        <?php
                        //Completa os anos automaticamente
                        $ano=date('Y');
                        echo '<option value="'.($ano+1).'">'.($ano+1).'</option>';
                        echo '<option value="'.$ano.'" selected>'.$ano.'</option>';
                        
                        for ($i=1; $i <10 ; $i++) {
                           echo '<option value="'.($ano-$i).'">'.($ano-$i).'</option>';
                        }
                       ?>
                     </select>
                    
                </div>
                <!--Serve para da espacamento-->
                <div class="offset-6  offset-sm-2 offset-md-4">

                </div>
                <div class="form-group col-6 col-sm-5 col-md-3">
                    <a class="btn btn-default text-left btn-block   btn-primary" href="Registar_Candidato.php">
                        <span class="i-color-white">
                            <i class="fas fa-plus"></i>
                            Adicionar novo
                        </span>
                    </a>
                </div>
                
                <div class="form-group col-6 offset-sm-6 col-md-3 col-sm-5 offset-sm-7 offset-md-9">
                    <a class="btn btn-default btn-block  text-left btn-primary" href="">
                        <span class="i-color-white"> <i class="fas fa-print "></i>
                            Imprimir
                        </span>
                    </a>
                </div>
            </div>
            <div class="offset-sm-1 col-sm-10 mt-2">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11 pesquisa" id="nome_candidato" name="nome_candidato" type="search" required
                        placeholder="Pesquise nome do candidato">
                </div>
            </div>
        </form>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Turno</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        require_once("../../Dao/conexao.php");
                        
                        //Estágio 1: Preparação
                        $query="SELECT id_candidato, CONCAT(nome,' ',apelido) as nome_completo,regime,classe_matricular from candidato_aluno where ano=year(curdate())";
                        
                        $stmt=$conexao->prepare($query);
                        if(!$stmt){
                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                        }
                
                        // Estágio 2: execução
                        if(!$stmt->execute()){
                            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
                        }
                
                        // Estágio 3: Obtenção de dados    
                        $res=$stmt->get_result();
                        if(!$res){
                            echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                        }
            
                        $linhas=$res->num_rows;
                    
                        for($j=0; $j<$linhas; ++$j){
                            $res->data_seek($j);
                            $linha=$res->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $linha['id_candidato']?></td>
                        <td><?php echo $linha['nome_completo']?></td>
                        <td><?php echo $linha['regime']?></td>
                        <td><?php echo $linha['classe_matricular']?></td>
                    </tr>
                    <?php 
                        } 
                        $stmt->close();
                        $conexao->close();
                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="graficos">
        <div class="mt-5 col-12 ">
            <h3 class="text-center">Graficos Estatisticos</h3>
            <hr>
        </div>

        <div class="col-md-6">
            <div id="containerP" class="contaGrafico">
            </div>
        </div>
        <div class="col-md-6">
            <div id="containerB" class="contaGrafico">
            </div>
        </div>
    </div>
</div>

<div class="">
    <nav class="menu-small menu-md">
        <ul>
            <li>
                <a href="#top">
                <span class="i-color-white  ">
                    <i class="fa fa-table fa-2x i-tamanho"></i>
                    </span>
               
                </a>
            </li>
            <li>
                <a href="#containerP">
                <span class="i-color-white">
                    <i class="fa fa-chart-bar fa-2x i-tamanho"></i>
                    </span>
                </a>
            </li>

            <li>
                <a href="#containerB">
                <span class="i-color-white  ">
                    <i class="fa fa-chart-pie fa-2x i-tamanho"></i>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<div>
    <div id="containerB" style=""></div>
    
</div>

</div>

<script src="_js/Grafico_Barras.js"></script>

<script src="_js/Grafico_Pizza.js"></script>

<script src="_js/Grafico_Barras.js"></script>
