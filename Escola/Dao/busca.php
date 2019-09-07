<?php

    function acessoDistrito(){
        require_once("conexao.php");
                        
        //Estágio 1: Preparação
        $query="SELECT id_dir, Estado FROM `user_distrital_admin` WHERE id_user=? and Estado =?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        
                  
        $idUser= filtraEntrada($conexao,$_SESSION['id_usuario']);
        $Estado= filtraEntrada($conexao,'Ativo');
        $bind=$stmt->bind_param("is", $idUser, $Estado);
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
            session_start();
            $_SESSION['id_dir']=$linha['id_dir'];
            }
            $_SESSION['acessoDistrito']="1";
            header('Location: acesso.php');
            //header('Location: RegitarEscola.php');
        }else{
            session_start();
            $_SESSION['acessoDistrito']= "0";
            header('Location: acesso.php');

           /* session_start();
            $_SESSION['Falha_Log']="Login Falhou Verifica seus dados";
            header('Location: ../LoginGeral.php');*/
        }
        
        $stmt->close();
        $conexao->close();
        
    }
    function dadosBairos($idDir){
        $hostname="localhost";
        $user="root";
        $password="";
        $database="Escola_Secundaria";
        
        $conexao=new mysqli($hostname,$user,$password,$database);
    
        if($conexao->connect_errno){
            echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
        }
            
            //Estágio 1: Preparação
            $query="SELECT id_Bairro,Nome FROM `bairro` WHERE id_Distriro=?";
            $stmt=$conexao->prepare($query);
            if(!$stmt){
                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
            $id_user= filtraEntrada($conexao,$idDir);
            $bind=$stmt->bind_param("i", $id_user);
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
                echo	'<option value="'.$linha['id_Bairro'].'">'.$linha['Nome'].'</option>';
      
            } 
            $stmt->close();
            $conexao->close();
        } 

    function dadosTabela($idDir){
        
      
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
            $id_user= filtraEntrada($conexao,$idDir);
            $bind=$stmt->bind_param("i", $id_user);
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
            <td><?php echo $linha['id_Escola']?></td>
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
   


