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



function busca_escola_Acesso_User(){
    require_once("conexao.php");       
    //Estágio 1: Preparação
    $query="SELECT user_escola.id_User, user_escola.Tipo, user_escola.Estado, escola.id_Escola, concat('Escola ',Nivel,' ',Nome) as 'Nome_Escola' FROM `user_escola`,escola WHERE user_escola.id_Escola=escola.id_Escola and user_escola.id_User=? and user_escola.Estado=?;";
    $stmt=$conexao->prepare($query);
    if(!$stmt){
        echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
    }
    
    //Estágio 2: Parametros
    $id_User= filtraEntrada($conexao,$_SESSION['id_User']);
    $estado= filtraEntrada($conexao, 'Ativo');
    $bind=$stmt->bind_param("is", $id_User,$estado);
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
        $_SESSION['id_Escola']=$linha['id_Escola'];
        $_SESSION['Tipo']=$linha['Tipo'];
        $_SESSION['Nome_Escola']=$linha['Nome_Escola'];
      }
    }
    
    $stmt->close();
    $conexao->close();
    
}

function busca_EscolaS(){
    require_once("conexao.php");

    

    //Estágio 1: Preparação
    $query="SELECT id_Escola,Nome,Nivel,Pertenca FROM `escola` WHERE id_dir=?";
        $stmt=$conexao->prepare($query);
    if(!$stmt){
         echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
    

    //session_start();
    $id_dir= filtraEntrada($conexao,$_SESSION['login']['id_Local']);
    
    $bind=$stmt->bind_param("i",$id_dir);
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
        <td><?php echo $linha['id_Escola'];?></td>
        <td><?php echo "Escola ".$linha['Nivel']." ".$linha['Nome']?></td>
        <td><?php echo $linha['Pertenca']?></td>
        <td><?php echo $linha['Nivel']?></td>
    </tr>
    <?php 
        } 
    $stmt->close();
    $conexao->close();
}

function busca_Escola(){
       
    require_once("conexao.php");
      
            //Estágio 1: Preparação
    $query="SELECT * FROM `escola`WHERE  (id_Escola like ? or nome LIKE ? or Nivel  LIKE ? or Pertenca LIKE ?  ) and id_Escola in(SELECT id_Escola FROM escola WHERE id_dir=? )";
        $stmt=$conexao->prepare($query);
    if(!$stmt){
         echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
    $id_user= filtraEntrada($conexao,'%'.$_POST['buscaEscola'].'%');

    $id_dir= filtraEntrada($conexao,$_SESSION['id_dir']);
    
    $bind=$stmt->bind_param("ssssi",$id_user, $id_user,$id_user,$id_user,$id_dir);
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
        <td><?php echo $linha['id_Escola'];?></td>
        <td><?php echo "Escola ".$linha['Nivel']." ".$linha['Nome']?></td>
        <td><?php echo $linha['Pertenca']?></td>
        <td><?php echo $linha['Nivel']?></td>
    </tr>
    <?php 
        } 
    $stmt->close();
    $conexao->close();
} 



?>