<?php


    if(isset($_POST['Entrar'])){
        autenticarUser();
        NivelAcessoUserDistrital();
        

    }
    function autenticarUser(){
        require_once("conexao.php");
                        
        //Estágio 1: Preparação
        $query="SELECT * FROM `dadosusuairio` where Username= ? and senha=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $Username= filtraEntrada($conexao,$_POST['Username']);
        $Senha= filtraEntrada($conexao,$_POST['Senha']);
        $bind=$stmt->bind_param("ss", $Username, $Senha);
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
            $_SESSION['id_usuario']=$linha['id_User'];
            $_SESSION['nome_usuario']=$linha['Nome']." ".$linha['Apelido'];
            $_SESSION['email_usuario']=$linha['Email'];
            echo $linha['Email_Pessoal'];
       
            }
            
            /*$_SESSION['id_dira']=0;
            $_SESSION['acessoGestao']=0;
            $_SESSION['Secretaria']=0;
            $_SESSION['acessoDistital']=0;
            $_SESSION['acessoEscolar']=0;
            $_SESSION['nome_Escola']='';*/
            header('Location: ../index.php');
        }else{
            session_start();
            $_SESSION['Falha_Log']="Login Falhou Verifica seus dados";
            header('Location: ../LoginGeral.php');
        }
        
        $stmt->close();
        $conexao->close();
        
    }
    function NivelAcessoUserDistrital(){
        require_once("conexao.php");
      
        //Estágio 1: Preparação
        $query="SELECT id_Dir, Designacao, Estado,Gestao_Escolas,Gestao_Operacoes,Gestao_Usuarios FROM `dados_acesso_distrito` WHERE id_user=? and Estado=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $id_user= filtraEntrada($conexao,$_SESSION['id_usuario']);
        $Estado= filtraEntrada($conexao,'Ativo');
        $bind=$stmt->bind_param("is", $id_user, $Estado);
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
        $_SESSION['acessoDistital']=$linhas;
        if($linhas>0){
            for($j=0; $j<$linhas; ++$j){
                $res->data_seek($j);
                $linha=$res->fetch_assoc();
  
            $_SESSION['id_dira']= $linha['id_Dir'];
            $_SESSION['nome_Distrito']="Direcao Distrital de ".$linha['Designacao'];
            $_SESSION['Acesso_Escola']=$linha['Gestao_Escolas'];
            $_SESSION['Acesso_Operacoes']=$linha['Gestao_Operacoes'];
            $_SESSION['Acesso_Usuarios']=$linha['Gestao_Usuarios'];
            }
           
           // header('Location: ../ServicosDistrital/Index.php');
        }else{
            session_start();
            $_SESSION['nome_Distrito']='';
            $_SESSION['Acesso_Escola']='N';
            $_SESSION['Acesso_Operacoes']='N';
            $_SESSION['Acesso_Usuarios']='N';
           // header('Location: ../ServicosDistrital/Index.php');
        }
        
        $stmt->close();
        $conexao->close();
        
    }
  ?>