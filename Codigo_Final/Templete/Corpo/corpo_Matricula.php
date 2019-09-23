<!--Aqui e continuacao do menuT-->
<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Matricula.php">Matriculas</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrículas</h3>
        <hr>

    </div>
    <!--Deve-se Organizar este codigo -->
    <div class="offset-md-1 col-md-10">
        <form>
            <div class="form-row">
                <div class="form-group col-2 col-sm-1">
                    <label for="selecAnoo">Ano </label>
                </div>
                <div class="col-4 col-sm-3">
                    <select name="ano" id="selecAnoo" class="form-control">
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

                <div class="form-group offset-sm-2 offset-md-5  col-6 col-sm-5 col-md-3">
                    <a class="btn btn-default text-left btn-block   btn-primary" href="ListaMatriculados.php">
                        <span class="i-color-white">
                            <i class="fas fa-list-alt"></i>
                            Listar matriculados
                        </span>
                    </a>
                </div>
            </div>

        </form>
        <div class="table-responsive" id="resultado">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Seccao</th>
                        <th>Turno</th>
                        <th>Total de vagas</th>
                        <th>Vagas preenchidas</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
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
                        require_once("../../Dao/conexao.php");
                        
                        //Estágio 1: Preparação
                        $query="SELECT classe,seccao,turno,total_vagas,vagas_preenchidas from periodo_matricula where ano=year(curdate()) and id_escola=?";
                        
                        $stmt=$conexao->prepare($query);
                        if(!$stmt){
                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                        }
                        $Username= filtraEntrada($conexao,$id_local);
       
                        $bind=$stmt->bind_param("i", $id_local);
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
                        <td><?php echo $linha['classe']?></td>
                        <td><?php echo $linha['seccao']?></td>
                        <td><?php echo $linha['turno']?></td>
                        <td><?php echo $linha['total_vagas']?></td>
                        <td><?php echo $linha['vagas_preenchidas']?></td>
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
                <a class="btn btn-info text-left btn-block" href="MarcarMatricula.php">
                <span class="i-color-white"> <i class="fas fa-marker"></i>&nbsp; Editar Matricula</span>
                </a>
            </div>
            <div class="form-group col-6 col-sm-5 offset-sm-2 col-md-4">
                <a class="btn btn-info text-left btn-block" href="MarcarMatricula.php">
                <span class="i-color-white"><i class="fas fa-highlighter"></i>&nbsp;Marcar Matricula</span>
                </a>
            </div>
        </div>
    </div>
    <!--
    <div class="row" id="graficos">
        <div class="mt-5 col-12 ">
            <h3 class="text-center">Graficos Estatisticos</h3>
            <hr>
        </div>

        <div class="col-md-6">
            <div id="containerP" class="contaGrafico">
                <script src="_js/Grafico_Pizza.js"></script>
            </div>
        </div>
        <div class="col-md-6">
            <div id="containerB" class="contaGrafico">
                <script src="_js/Grafico_Barras.js"></script>
            </div>
        </div>
    </div>
    -->
</div>
<!--
<div class="">
   
<nav class="menu-small menu-md">
        <ul>
            <li>
                <a href="#top">
                    <span class="i-color-white">
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
    <script src="_js/Grafico_Barras.js"></script>
</div>
-->
</div>
<script >
        $(function(){
            $('.size').styleddropdown();
        });
    </script>