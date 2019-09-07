<?php
echo $_SESSION['id_usuario'];

verFicaAcesso();

    function verFicaAcesso(){
        require_once("../Dao/conexao.php");
        $query="SELECT * FROM `dados_escola_user` WHERE id_user=? and NivelAcesso=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
        echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        $id_user= filtraEntrada($conexao,$_SESSION['id_usuario']);
        $acesso1= filtraEntrada($conexao,'Secretaria');
        
        $bind=$stmt->bind_param("is",$id_user, $acesso1);
        if(!$bind){
           echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }
                
         if(!$stmt->execute()){
              echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
          }
                
                        // Estágio 3: Obtenção de dados    
        $res=$stmt->get_result();
                        if(!$res){
                            echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
                        }
            
                        $linhas=$res->num_rows;
                        $_SESSION['acessoGestao']=$linhas;
                        if($linhas>0){
                            for($j=0; $j<$linhas; ++$j){
                                $res->data_seek($j);
                                $linha=$res->fetch_assoc();
                                $_SESSION['nome_Escola']= "Escola ".$linha['Nivel']." ".$linha['Nome'];
                                echo $_SESSION['nome_Escola']."<br>";
                             }
                             echo $_SESSION['nome_Escola']."<br>";
                             header('Location: Ensino\Index.php');
                             echo "Acesso Permitido".$_SESSION['acessoGestao']; 
                        }else{
                            header('Location: ../../');
                            echo "Acesso nao Permitido".$_SESSION['acessoGestao'];
                        }

                        
                        $stmt->close();
                        $conexao->close();                
                    }
                    ?>