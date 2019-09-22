<<?php 
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
                        $query="SELECT id_candidato,concat(Nome,' ',Apelido)  as nome_completo,regime,classe_matricular from candidatos where ano=year(curdate()) and id_escola=?";
                        
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
                <?php/*        <td><?php echo $linha['id_candidato']?></td>
                        <td><?php echo $linha['nome_completo']?></td>
                        <td><?php echo $linha['regime']?></td>
                        <td><?php echo $linha['classe_matricular']?></td>
                    </tr>*/
                    ?>