<?php
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

    function buscaUsuario(){
        function autenticarUser(){
        //require_once("conexao.php");
        $hostname="localhost";
        $user="root";
        $password="";
        $database="SIGES";
        
        $conexao=new mysqli($hostname,$user,$password,$database);
    
        if($conexao->connect_errno){
            echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
        }       
        //Estágio 1: Preparação
        $query="SELECT * FROM `usuario` WHERE username=? or email_instituconal=?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        //Estágio 2: Parametros
        $Username= filtraEntrada($conexao,$_POST['username']);
        
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
            echo "Encontro";
          //  header('Location: ../../Autenticacao/Login/Login_Principal.php');
            /*for($j=0; $j<$linhas; ++$j){
                $res->data_seek($j);
                $linha=$res->fetch_assoc();
            session_start();
            $_SESSION['id_User']=$linha['id_User'];
            $_SESSION['id_Pessoa']=$linha['id_Pessoa'];
            $_SESSION['nome_usuario']=$linha['NomeCompleto'];
            $_SESSION['Acesso_Distrital']=$linha['Acesso_Distrital'];
            $_SESSION['Acesso_Escola']=$linha['Acesso_Escola'];
            $_SESSION['Estado']=$linha['Estado'];
          */  
        }else{
           echo "nao encontrou";
           // header('Location: ../../Autenticacao/Login/Login_Principal.php');
        }
        
        $stmt->close();
        $conexao->close();
        
    }
    }
      
?>