<?php
    session_start();
    //Login Principal
    if(isset($_POST['login']) && isset($_POST['inputUsuario']) && isset($_POST['inputSenha'])){
        iniciarSessao_principal();
    }
    if(isset($_POST['SalvarRecuperacao']) ){
        echo 'Chegou salvar';
    }
    if(isset($_POST['loginPrincipal']) ){
        autenticarUser();
    }
    
    

    //Login Candidato
    if(isset($_POST['entrar']) && isset($_POST['nome_cand']) && isset($_POST['senha_cand'])){
        iniciarSessao_candidato();
    }

    //Busca de Candidato
    if((isset($_POST['nome_candidato'])) && (isset($_POST['ano']))){
        busca_candidato();
    }

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


    //Essa funcao Ajuda a processar o acesso do Usuario;
    function autenticarUser(){
        //require_once("conexao.php");
        require_once("conexao.php");      
        //Estágio 1: Preparação
        //SELECT * FROM `usuario`,pessoa WHERE usuario.id_User=pessoa.id_Pessoa
        $query="SELECT pessoa.id_Pessoa, concat(pessoa.Nome,' ',pessoa.Apelido) as 'Nome_Completo',usuario.id_User,usuario.Username,usuario.Senha,usuario.Estado,usuario.Nivel_Acesso,usuario.Local,usuario.id_Local,usuario.Nome_Local, contacto.Email FROM pessoa,`usuario`,contacto WHERE pessoa.id_Pessoa=usuario.id_User and usuario.Username=? and usuario.Senha=?;";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $Username= filtraEntrada($conexao,$_POST['user']);
        $Senha= filtraEntrada($conexao,$_POST['senha']);
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
            
            $_SESSION['login']['id_User']=$linha['id_User'];
            $_SESSION['login']['id_Pessoa']=$linha['id_Pessoa'];
            $_SESSION['login']['nome_usuario']=$linha['Nome_Completo'];
            $_SESSION['login']['Nivel_Acesso']=$linha['Nivel_Acesso'];
            $_SESSION['login']['Local']=$linha['Local'];
            $_SESSION['login']['id_Local']=$linha['id_Local'];
            $_SESSION['login']['Nome_Local']=$linha['Nome_Local'];
            $_SESSION['login']['Estado']=$linha['Estado'];
            $_SESSION['login']['email_usuario']=$linha['Email'];
            
        }
       
            if($_SESSION['login']['Local']=='Distrito'){
                echo 'Bem Vindo ao Direcao do '.$_SESSION['Nome_Local'];
               
            
            }elseif($_SESSION['login']['Local']=='Escola'){
                header('Location: ../../Escola/');
                echo 'Bem Vindo a escola '.$_SESSION['Nome_Local'];
               
            }
        }else{
           
            session_destroy();
           
            header('Location: ../../Autenticacao/Login/Login_Principal.php');
        }
        
        $stmt->close();
        $conexao->close();
        
    }



    
    //Login Principal
    function iniciarSessao_principal(){
        require_once("conexao.php");
        
        //Estágio 1: Preparação
        $query="SELECT usuario,AES_DECRYPT(senha,'senha') as senha,tipo from usuario where usuario=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $usuario=filtraEntrada($conexao,$_POST['inputUsuario']);
        $senha=filtraEntrada($conexao,$_POST['inputSenha']);
        
        $bind=$stmt->bind_param("s",$usuario);
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

        if($res->num_rows){
            $linha=$res->fetch_assoc();
            if($linha['senha']==$senha){
                session_start();
                $_SESSION['usuario']=$linha['usuario'];
                $_SESSION['senha']=$linha['senha'];
                $_SESSION['tipo']=$linha['tipo'];
                
                if($linha['tipo']=="aluno"){
                    header('Location: ../Candidato.php');
                }/*elseif($linha['tipo']=="Funcionario"){
                    header('Location: ');
                }elseif(($linha['tipo']=="Director"){
                    header('Location: ');
                }  */
            }else{
                header('Location: ../Login_Principal.php');
            }
        }    
        $stmt->close();
        $conexao->close();
    }

     //Login candidato 
     function iniciarSessao_candidato(){
        require_once("conexao.php");
        
        //Estágio 1: Preparação
        $query="SELECT AES_DECRYPT(senha,'senha') as senha from candidato_aluno where nome_completo=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $nome_cand=filtraEntrada($conexao,$_POST['nome_cand']);
        $senha_cand=filtraEntrada($conexao,$_POST['senha_cand']);
        
        $bind=$stmt->bind_param("s",$nome_cand);
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

        if($res->num_rows){
            $linha=$res->fetch_assoc();
            if($linha['senha']==$senha_cand){
                session_start();
                $_SESSION['nome_cand']=$linha['nome_completo'];
                $_SESSION['senha_cand']=$linha['senha'];
            
                header('Location: ../formulario_completo.php');
            }
        }else{
            /*Senha ou Login invalido*/
            header('Location: ../Login_Pre_Matricula.php');
        }

        $stmt->close();
        $conexao->close();
    }
?>