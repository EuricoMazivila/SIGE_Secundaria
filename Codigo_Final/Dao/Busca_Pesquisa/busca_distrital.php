<?php

function busca_distrito_Acesso_User(){
    require_once("conexao.php");
    
    
    $conexao=new mysqli($hostname,$user,$password,$database);

    if($conexao->connect_errno){
        echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
    }       
    //Estágio 1: Preparação
    $query="SELECT user_distrital.id_user,user_distrital.Estado,user_distrital.Gestao_Escolas,user_distrital.Gestao_Operacoes,user_distrital.Gestao_Usuarios,direcao_distrital.id_Dir,direcao_distrital.Designacao,direcao_distrital.Total_Escola FROM `user_distrital`,direcao_distrital WHERE user_distrital.id_Dir=direcao_distrital.id_Dir and user_distrital.id_user=? and user_distrital.Estado=? ";
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
        $_SESSION['id_dir']=$linha['id_Dir'];
        $_SESSION['Designacao']=$linha['Designacao'];
       
        $_SESSION['Gestao_Escolas']=$linha['Gestao_Escolas'];
        $_SESSION['Gestao_Operacoes']=$linha['Gestao_Operacoes'];
        $_SESSION['Gestao_Usuarios']=$linha['Gestao_Usuarios'];
      }
    }
    
    $stmt->close();
    $conexao->close();
    
}

function busca_Escola_Distrital(){
       
    //include_once('conexao.php');
      
            //Estágio 1: Preparação
    $query="SELECT * FROM `escola`WHERE  (id_Escola like ? or nome LIKE ? or Nivel  LIKE ? or Pertenca LIKE ?  ) and id_Escola in(SELECT id_Escola FROM escola WHERE id_dir=? )";
        $stmt=$conexao->prepare($query);
    if(!$stmt){
         echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
    $id_user= filtraEntrada($conexao,'%'.$_POST['buscaEscola'].'%');

   
    $id_dir= filtraEntrada($conexao,$_SESSION['id_dira']);
    
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