<?php


    if(isset($_POST['Entrar'])){
        autenticarUser();
     
        

    }
    if(isset($_POST['logout'])){
        echo "Ah";
       // session_abort();
       // header('Location: ../LoginGeral.php');
    }
    function autenticarUser(){
        require_once("conexao.php");
                        
        //Estágio 1: Preparação
        $query="SELECT * FROM `dados_user` WHERE Username=? and Senha=?";
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
            $_SESSION['id_User']=$linha['id_User'];
            $_SESSION['nome_usuario']=$linha['Nome']." ".$linha['Apelido'];
            $_SESSION['Acesso_Distrital']=$linha['Acesso_Distrital'];
            $_SESSION['Acesso_Escola']=$linha['Acesso_Escola'];
            $_SESSION['Acesso_Aluno']=$linha['Acesso_Aluno'];
            $_SESSION['Acesso_Professor']=$linha['Acesso_Professor'];
            $_SESSION['Acesso_Secretaria']=$linha['Acesso_Secretaria'];
            $_SESSION['Acesso_Convidado']=$linha['Acesso_Convidado'];
            $_SESSION['Acesso_Candidato']=$linha['Acesso_Candidato'];
            $_SESSION['Acesso_Adminastrivo']=$linha['Acesso_Adminastrivo'];
            $_SESSION['Estado']=$linha['Estado'];
            }
            $_SESSION['Falha_Log']='';
            header('Location: ../');
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
        $id_user= filtraEntrada($conexao,$_SESSION['id_User']);
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
            
            $_SESSION['nome_Distrito']='';
            $_SESSION['Acesso_Escola']='N';
            $_SESSION['Acesso_Operacoes']='N';
            $_SESSION['Acesso_Usuarios']='N';
           // header('Location: ../ServicosDistrital/Index.php');
        }
        
        $stmt->close();
        $conexao->close();
        
    }

    function NivelAcessoUserEscola(){
        require_once("conexao.php");
        $query="SELECT * FROM `dados_user_escola` WHERE id_user=? and Estado=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $id_user= filtraEntrada($conexao,$_SESSION['id_User']);
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
        $_SESSION['acessoEscolas']=$linhas;
        if($linhas>0){
            for($j=0; $j<$linhas; ++$j){
                $res->data_seek($j);
                $linha=$res->fetch_assoc();
           
            $_SESSION['id_Escola']= $linha['id_Escola'];
            $_SESSION['nome_Escola']="Escola ".$linha['Nivel'].' '.$linha['Nome'];
            $_SESSION['Acesso_Ensino']=$linha['Acesso_Ensino'];
            $_SESSION['Acesso_Avaliacoes']=$linha['Acesso_Avaliacoes'];
            $_SESSION['Acesso_Disciplina']=$linha['Acesso_Disciplina'];
            }
           
           // header('Location: ../ServicosDistrital/Index.php');
        }
        
        
        $stmt->close();
        $conexao->close();
    }
  ?>