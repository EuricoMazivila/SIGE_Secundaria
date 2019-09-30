<div class="row">
    <ol class="breadcrumb col-12">
        <li class="offset-sm-1"><a href="#">Home</a></li>
        <li><a href="Matricular_Step 0.php">Matricular aluno</a></li>
        <small id="lect">Ano lectivo <?php echo date('Y');?></small>
    </ol>
</div>

<div class="container">

    <div class="page-header" id="top">
        <h3 class="mt-2 offset-sm-1">Matrícula de aluno</h3>
        <hr>
    </div>
    <form>
        <div class="form-row">
            <div class="pesq row offset-sm-1 col-sm-6 mt-2">
                <i class="fa fa-search form-group col-1"></i>
                <input class="form-group col-11 pesquisa" id="nome_candidato" name="nome_candidato_m" type="search" required placeholder="Pesquise nome do pré-matriculado">
            </div>
            <input type="hidden" name="id_escola" value=<?php echo $id_local;?>>

            <a class="btn btn-primary offset-sm-3 col-sm-1 mt-2" href="">
                <span class="i-color-white"> <i class="fas fa-print "></i>
                    Imprimir
                </span>
            </a>
        </div>
    </form>    

    <div class="form-row mt-5">

    	<div class="table-responsive" id="resultado">
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
                    <?php   
                        require_once("../../Dao/conexao.php");
                        
                        //Estágio 1: Preparação
                      //  $query="SELECT id_candidato,nome_completo,regime,classe_matricular from candidatos_cadastrados";
                        $query="SELECT id_candidato, concat(Nome,' ',Apelido) as nome_completo,estado,regime,classe_matricular from candidatos where id_escola=? and estado='cadastrado'";
                        $stmt=$conexao->prepare($query);
                        if(!$stmt){
                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                        }

                        $id_escola=$id_local;
                        $bind=$stmt->bind_param("i",$id_escola);
                
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

    <div class="size offset-6">
        <ul class="listaa">
           <li role="button" id="myBtn"><a href="Matricular_Step_1.php"><i class="fa fa-eraser fa-2x"></i><span>Matricular aluno</span></a> </li> 
        </ul>
    </div>
</div>