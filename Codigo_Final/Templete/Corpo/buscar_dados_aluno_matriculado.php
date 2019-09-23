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
                        /*$query="SELECT pessoa.Nome,pessoa.Apelido,pessoa.Sexo,pessoa.Estado_Civil,pessoa.Data_Nascimento, 
                        filiacao_aluno_dados_nat.Distrito as 'Distrito_Nasc', filiacao_aluno_dados_nat.Provincia 
                        as 'Provincia_Nasc', filiacao_aluno_dados_nat.Pais as 'Pais_nasc', 
                        filiacao_aluno_dados_nat.nome_pai,filiacao_aluno_dados_nat.telefone_pai,
                        filiacao_aluno_dados_nat.local_trabalho_pai,filiacao_aluno_dados_nat.nome_mae,
                        filiacao_aluno_dados_nat.telefone_mae,filiacao_aluno_dados_nat.local_trabalho_mae, 
                        filiacao_aluno_dados_nat.profissao_mae FROM `pessoa`,filiacao_aluno_dados_nat WHERE filiacao_aluno_dados_nat.id_aluno=pessoa.id_Pessoa and pessoa.id_Pessoa=?  ";
                        */
                        
                        $query="SELECT pessoa.Nome,pessoa.Apelido,pessoa.Sexo,pessoa.Estado_Civil,pessoa.Data_Nascimento, 
                        filiacao_aluno_dados_nat.Distrito as 'Distrito_Nasc', filiacao_aluno_dados_nat.Provincia 
                        as 'Provincia_Nasc', filiacao_aluno_dados_nat.Pais as 'Pais_nasc'FROM `pessoa`,filiacao_aluno_dados_nat WHERE filiacao_aluno_dados_nat.id_aluno=pessoa.id_Pessoa and pessoa.id_Pessoa=?  ";
                        
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
               $distritoN= $linha['Distrito_Nasc'];
               $ProvinciaN= $linha['Provincia_Nasc'];
               $paisN= $linha['Pais_nasc'];
               $estadoC= $linha['Estado_Civil'];
         
           
            
        }
        }else{
            $nome= '';
            $apelido='';
            $sexo='';
            $datanasc='';
            $estadoC='';
       
            $distritoN= 'sfsf';
            $ProvinciaN='';
            $paisN= '';
 
    }
       
        $stmt->close();
          
        $conexao->close();
      
           