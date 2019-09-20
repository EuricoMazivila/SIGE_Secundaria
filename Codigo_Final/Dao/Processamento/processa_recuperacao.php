<?php
session_start();
        //Validacao dos dados Preenchidos em Campos de formulario 
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

    if(isset($_POST['recupera']) ){
       buscaUsuario();
    }
    if(isset($_POST['enviarCodigo']) ){
        eviarCodigoRecuperacao();
    }
    if(isset($_POST['validarCodigo']) ){
        validarCodigoRecuperacao();
     }

     if(isset($_POST['SalvarRecuperacao']) ){
        updateSenha();
     }

    function buscaUsuario(){
        require_once("conexao.php");      
        //Estágio 1: Preparação
        $query="SELECT usuario.id_User,usuario.Username,usuario.Senha,usuario.Email_Instituconal,pessoa.id_Pessoa,pessoa.Email,pessoa.Nr_tell FROM `usuario`,pessoa WHERE usuario.id_User=pessoa.id_Pessoa and (username=? or email_instituconal=?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $Username= filtraEntrada($conexao,$_POST['nomeUser']);
        
        $bind=$stmt->bind_param("ss", $Username, $Username);
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
                $_SESSION['email']=$linha['Email'];
                $_SESSION['nrTell']=$linha['Nr_tell'];
            }
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_1.php');
        }else{
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_0.php');
        }
        
        $stmt->close();
        $conexao->close();
      
   
    }

    function eviarCodigoRecuperacao(){
        
        

        if(!(isset($_POST['tell'])||isset($_POST['mailll']))){
            echo 'Sair'; 
        }else{
            
            if(isset($_POST['tell'])){
                $tipoEnvio='Telefone';
                $CampoEnvio=$_POST['tell'];
            }elseif(isset($_POST['mailll'])){
                $CampoEnvio=$_POST['mailll'];
                $tipoEnvio='Email';
            }
            
            require_once("conexao.php");      
            //Estágio 1: Preparação
            $query="SELECT RecuperaSenha(?,?,?) as idRec";
            $stmt=$conexao->prepare($query);
            if(!$stmt){
                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
        //Estágio 2: Parametros
        $idUser= filtraEntrada($conexao,$_SESSION['id_User']);
        $tipoEnvio= filtraEntrada($conexao,$tipoEnvio);
        $CampoEnvio= filtraEntrada($conexao,$CampoEnvio);
        
        $bind=$stmt->bind_param("iss", $idUser, $tipoEnvio, $CampoEnvio);
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
                $_SESSION['id_rec']=$linha['idRec'];
                
               // $_SESSION['email']=$linha['Email'];
               // $_SESSION['nrTell']=$linha['Nr_tell'];
            }
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_2.php');
        }else{
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_1.php');
        }
        
        $stmt->close();
        $conexao->close();
        }
        /**`*/
        //require_once("conexao.php");
        /*
      */
   
    }
    function updateSenha(){
        if(!($_POST['newSenha']==$_POST['senha2'])){
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_3.php');
            
        }else{
    
            require_once("conexao.php");       
            //Estágio 1: Preparação
            $query="SELECT `upDateSenha`(?, ?) as up";
            $stmt=$conexao->prepare($query);
            if(!$stmt){
                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
            //Estágio 2: Parametros
            $idUser= filtraEntrada($conexao,$_POST['newSenha']);
            $tipoEnvio= filtraEntrada($conexao,$_SESSION['id_rec']);
            
            
            $bind=$stmt->bind_param("is",$tipoEnvio,$idUser);
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
               $p=$linha['up'];
            }
            echo $p;
            if($p==1)
            header('Location: ../../Autenticacao\Login\Login_Principal.php');
            else
            echo 'Falho na actualizacao';
        }else{
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_3.php');
        }
        
        $stmt->close();
        $conexao->close();
        }
    }

    function validarCodigoRecuperacao(){
        require_once("conexao.php");      
            //Estágio 1: Preparação
            $query="SELECT * FROM `recupera_senha_usuario` WHERE id_Solicitacao=? and CodigoRecuperacao=?";
            $stmt=$conexao->prepare($query);
            if(!$stmt){
                echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
            }
        //Estágio 2: Parametros
        $idUser= filtraEntrada($conexao,$_SESSION['id_rec']);
        $tipoEnvio= filtraEntrada($conexao,$_POST['codigo']);
                
        $bind=$stmt->bind_param("ii", $idUser, $tipoEnvio);
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
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_3.php');
        }else{
            header('Location: ../../Autenticacao\Recuperacao\Recuperacao_Step_2.php');
        }
        
        $stmt->close();
        $conexao->close();
        }

        
   
      
?>