<?php
    //Insercao de Novo Candidato
    if(isset($_POST['RegistarEscola'])){
        registar_Escola();
    }

    if(isset($_POST['buscaEscola'])){
        busca_Escola();
    }

    function registar_Escola(){
        require_once("conexao.php");
        //Estágio 1: Preparação
        $query="INSERT INTO `escola` ( `id_dir`, `Nome`, `Nivel`, `Pertenca`) VALUES (?,?,?,?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        session_start();
         
        $codDistrito=filtraEntrada($conexao,$_SESSION['id_dira']); //filtraEntrada($conexao,$_SESSION['id_dir']);
        $NomeEscola =filtraEntrada($conexao,$_POST['NomeEscola']);
        $NivelEscola=filtraEntrada($conexao,$_POST['NivelEscola']);
        $PertencaEscola=filtraEntrada($conexao,$_POST['PertencaEscola']);

        $bind=$stmt->bind_param("isss",$codDistrito, $NomeEscola, $NivelEscola, $PertencaEscola);
        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            header("Location: ../ServicosDistrital/");
            
          
        }   

        $stmt->close();
        $conexao->close();
        
    }

    function busca_Escola(){
       
        include_once('conexao.php');
          
                //Estágio 1: Preparação
        $query="SELECT * FROM `escola`WHERE  (id_Escola like ? or nome LIKE ? or Nivel  LIKE ? or Pertenca LIKE ?  ) and id_Escola in(SELECT id_Escola FROM escola WHERE id_dir=? )";
            $stmt=$conexao->prepare($query);
        if(!$stmt){
             echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
        $id_user= filtraEntrada($conexao,'%'.$_POST['buscaEscola'].'%');

        session_start();
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

    function busca_EscolaS(){
        $hostname="localhost";
        $user="root";
        $password="";
        $database="Escola_Secundaria";
        $conexao=new mysqli($hostname,$user,$password,$database);
        if($conexao->connect_errno){
            echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
        }

        //Estágio 1: Preparação
        $query="SELECT id_Escola,Nome,Nivel,Pertenca FROM `escola` WHERE id_dir=?";
            $stmt=$conexao->prepare($query);
        if(!$stmt){
             echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
        

        //session_start();
        $id_dir= filtraEntrada($conexao,$_SESSION['id_dira']);
        
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
    
    function busca_Alunos(){
        

    }
            

    
?>