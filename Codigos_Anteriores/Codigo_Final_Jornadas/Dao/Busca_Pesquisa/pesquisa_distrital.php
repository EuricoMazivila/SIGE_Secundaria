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

function busca_escolas_distrito(){
    require_once("conexao.php");     
    //Estágio 1: Preparação
    $query="SELECT id_Escola,concat('Escola ',Nivel,' ',Nome) as 'Nome_Escola',Nivel,Pertenca FROM `escola` WHERE id_Dir=?";
    $stmt=$conexao->prepare($query);
    if(!$stmt){
        echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
    }
   
    //Estágio 2: Parametros
    $id_dir= filtraEntrada($conexao,$_SESSION['id_dir']);
    $bind=$stmt->bind_param("i",$id_dir);
    if(!$bind){
        echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
    }
    
    // Estágio 3: execução
    if(!$stmt->execute()){
        echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
    }

    // Estágio 4: Obtenção de dados    
    $res=$stmt->get_result();
    if(!$res){
        echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
    }

    $linhas=$res->num_rows;
   
    if($linhas>0){
        for($j=0; $j<$linhas; ++$j){
            $res->data_seek($j);
            $linha=$res->fetch_assoc();
       		echo '<tr>';
                echo    '<td>'.$linha['id_Escola'].'</td>';
          		echo    '<td>'.$linha['Nome_Escola'].'</td>';
                echo    '<td>'.$linha['Nivel'].'</td>';
                echo    '<td>'.$linha['Pertenca'].'</td>';
                echo    ' </tr>';
      }
    }
    
    $stmt->close();
    $conexao->close();
    
}




?>