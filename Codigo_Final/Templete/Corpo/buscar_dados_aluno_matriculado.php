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
                        $query="SELECT pessoa.Nome,pessoa.Apelido,pessoa.Sexo,pessoa.Estado_Civil,pessoa.Data_Nascimento FROM `pessoa` WHERE pessoa.id_Pessoa=? ";
                        
                        $stmt=$conexao->prepare($query);
                        if(!$stmt){
                            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
                        }
                        //$Username= filtraEntrada($conexao,$id_local);
                        
       
                        $bind=$stmt->bind_param("s",  $id_user);
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
       
                    if($linhas>0){
                    for($j=0; $j<$linhas; ++$j){
                $res->data_seek($j);
                $linha=$res->fetch_assoc();
               $nome= $linha['Nome'];
               $apelido= $linha['Apelido'];
               $sexo= $linha['Sexo'];
               $datanasc= $linha['Data_Nascimento'];
               $estadoC= $linha['Estado_Civil'];
           
            
        }
        }else{
            $nome= 'Nome';
    }
       
        $stmt->close();
          
        $conexao->close();
      
           