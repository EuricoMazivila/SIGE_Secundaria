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
        <h3 class="mt-2 offset-sm-1">Gestão de Alunos</h3>
        <hr>

    </div>


    <div class="container mt-4">
    
        <div class="form-row mt-4">
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4 ">
                <a class="btn btn-primary btn-block" href="Ensino/Aluno">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Alunos</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-dark btn-block " href="Ensino">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Ensino</span></a>
                </a>
            </div>
            <div class="col-10 offset-1 offset-sm-0 col-sm-4 mt-4">
                <a class="btn btn-primary btn-block " href="Ensino/Professor">
                    <span class="i-color-white">
                        <i class="fa fa-window-close"></i>Professores</span></a>
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
                <tbody>
                    <?php   
                        require_once("../../Dao/conexao.php");
                        
                        //Estágio 1: Preparação
                        $query="SELECT id_Aluno,Nome, Apelido, ClasseIngresso, YEAR(Data_Ingresso) as 'Ano_I', ClasseSaida, YEAR(DataSaida) as 'Ano_S', Escola, Estado FROM `dadosalunoescola`";
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
                        <td><?php echo $linha['id_Aluno']?></td>
                        <td><?php echo $linha['Nome']." ".$linha['Apelido']?></td>
                        <td><?php echo $linha['Ano_I']?></td>
                        <td><?php echo $linha['ClasseIngresso']?></td>
                        <td><?php echo $linha['Ano_S']?></td>
                        <td><?php echo $linha['ClasseSaida']?></td>
                        <td><?php echo $linha['Estado']?></td>
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
</div>
<!--Deve-se Organizar este codigo -->


</div>