<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Matricula.php">Matriculas</a></li>
        <li><a href="ListaMatriculados.php">Lista de matriculados</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">
    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Lista de Matriculados</h3>
        <hr>
    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-md-1">
                    <label for="ano_mat">Ano </label>
                </div>
                <div class="col-4 col-md-3">
                    <select name="ano_mat" id="ano_mat" class="form-control">
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

                <div class="form-group col-2 col-md-1 offset-md-4">
                    <label for="classe">Classe </label>
                </div>
                <div class="col-4 col-md-3">
                    <select name="classe" id="classe" class="form-control">
                        <?php
                        //Completa as classe automaticamente
                        for ($i=8; $i <=12 ; $i++) {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                       ?>
                    </select>
                </div>
            </div>
            <div class="offset-sm-1 col-sm-10 mt-2">
                <div class="pesq form-row">
                    <i class="fa fa-search form-group col-1"></i>
                    <input class="form-group col-11 pesquisa" id="nome_aluno" name="nome_aluno" type="search" 
                        placeholder="Pesquise nome do aluno">
                </div>
            </div>
        </form>
        <div class="table-responsive mt-5" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                       include_once("../../Dao/conexao.php");
                                                function filtraEntrada($conexao,$dado){
                        //remove espacoes no inicio e
                        //no final da string
                        $dado=trim($dado);
                
                        //remove contra barras:
                        // "cobra d\'agua" vira "cobra d'agua"
                        $dado= stripslashes($dado);
                        $dado=htmlspecialchars($dado);
                        
                        //Remove caracteres que um hacker possa ter 
                        //inserido para invadir ou alterar o banco de dados
                        $dado=$conexao->real_escape_string($dado);
                
                        return $dado;
                    }
                        
                        //Estágio 1: Preparação
                        $query="SELECT aluno_matriculado.id_aluno,concat(pessoa.Nome,' ',pessoa.Apelido) as 'Nome_Completo',aluno_matriculado.Data as 'Data_R' FROM `aluno_matriculado`,pessoa WHERE aluno_matriculado.id_aluno=pessoa.id_Pessoa AND aluno_matriculado.id_escola=?";
                        
                        $stmt=$conexao->prepare($query);
                        if(!$stmt){
                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                        }
                        $Username= filtraEntrada($conexao,$id_local);
       
                        $bind=$stmt->bind_param("i", $Username);
                        if(!$bind){
                            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
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
                        <td><?php echo $linha['id_aluno']?></td>
                        <td><?php echo $linha['Nome_Completo']?></td>
                        <td><?php echo $linha['Data_R']?></td>
                    </tr>
                    <?php 
                        } 
                        $stmt->close();
                        $conexao->close();
                       

                   
                        
                    ?>
                         
                </tbody>
            </table>
        </div>
        <div class="row ">
            <div class="form-group col-6 col-sm-5 col-md-4 offset-md-1">
                <a class="btn btn-info text-left " href="Matricula.php">
                    <span class="i-color-white"> <i class="fas fa-arrow-left"></i>&nbsp; Voltar </span>
                </a>
            </div>
            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                <a class="btn btn-info text-left " href="MarcarMatricula.html">
                    <span class="i-color-white"><i class="fas fa-print"></i>&nbsp; Imprimir</span>
                </a>
            </div>
        </div>
    </div>

</div>
</div>