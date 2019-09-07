<?php
//Busca Bairros
if(isset($_POST['iddistrito'])){
    busca_bairro();
}
if(isset($_POST['buscaEscola'])){
    busca_Escola();
}
function busca_Escola(){
    include_once('conexao.php');
    
        //Estágio 1: Preparação
        $query="SELECT * FROM `escola`WHERE  (id_Escola=? or nome LIKE ? or Nivel  LIKE ?) and id_Escola in(SELECT id_Escola FROM escola WHERE id_dir=? )";
               $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        $id_user= filtraEntrada($conexao,$_POST['buscaEscola']);
        $id_nome= filtraEntrada($conexao,'%'.$_POST['buscaEscola'].'%');
       
        $id_dir= filtraEntrada($conexao,'10');
        
        $bind=$stmt->bind_param("issi",$id_user, $id_nome,$id_nome,$id_dir);
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
       <<td><?php echo $linha['id_Escola'];?></td>
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