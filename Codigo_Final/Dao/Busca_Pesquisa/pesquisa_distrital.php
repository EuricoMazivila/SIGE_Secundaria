<?php


function busca_escolas_distrito(){
        $hostname="localhost";
    $user="root";
    $password="";
    $database="SIGES";
    
    $conexao=new mysqli($hostname,$user,$password,$database);

    if($conexao->connect_errno){
        echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
    }     
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