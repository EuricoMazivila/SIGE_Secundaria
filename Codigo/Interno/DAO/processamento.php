<?php
if(isset($_POST['entrar'])){
    loginPrematricula();
}

if(isset($_POST['login'])){
    loginPrincipal();
}
if(isset($_POST['fecharSecao'])){
    session_start();
        session_destroy();
        $loginFalhou="Falhou";
        header('Location: ../../index.php');
}

if(isset($_POST['AdicionaDisciplina'])){
    cadastroDisciplina();
}

    function filtraEntrada($dado){
        //remove espacoes no inicio e
        //no final da string
        $dado=trim($dado);

        //remove contra barras:
        // "cobra d\'agua" vira "cobra d'agua"
        $dado= stripslashes($dado);
        $dado=htmlspecialchars($dado);
    return $dado;
    }



    function loginPrematricula(){
        echo  "loginPrematricula";
        require_once('conexao.php');

        //prepara a declaracao 
        $query = "SELECT * FROM `candidato_matricula` where ref=?";
        
        $stmt=$conexao->prepare($query);
        
        if(!$stmt){
            echo "Erro de parametros: (" .$conexao->error . ")" . $conexao->error;
        }

        //Obtem-se os dados do formulario (Usuario e Senha)
        $codigo = filtraEntrada($_POST["inputCod"]);

        //Associacao dos parametros (bind)
        if(!$stmt->bind_param("s",$codigo)){
            echo "Erro de parametros: (" .$stmt->error . ")" . $stmt->error;
        }
        
        //Execucao
        if(!$stmt->execute()){
            echo "Erro de execucao: (" . $stmt->error . ") " . $stmt->error;
        }

        $res=$stmt->get_result();
        
        if(!$res){
            echo "Erro de obtencao de resultados: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if($res->num_rows > 0){
            session_start(); //Inicia-se a seccao
            $_SESSION['preMatricula'] = $codigo; 
            header('Location: ../'); //Redireciona para o pagina index
        }else{
            session_start();
            $_SESSION['FalhaLogin']="Login Falhou";
            header('Location: ../login.php');
        }

        $stmt->close();
        $conexao->close();
    }

    function loginPrincipal(){
       // echo  "loginPrematricula";
        require_once('conexao.php');
        $user = filtraEntrada($_POST["inputUsuario"]);
        $pass=filtraEntrada($_POST["inputSenha"]);
      

        //prepara a declaracao 
        $query = "SELECT Tipo, id_ref FROM `usuario` where username=? and `passWord`=?";
        
        $stmt=$conexao->prepare($query);

       
        
        if(!$stmt){
            echo "Erro de parametros: (" .$conexao->error . ")" . $conexao->error;
        }

        //Obtem-se os dados do formulario (Usuario e Senha)


        //Associacao dos parametros (bind)
        
       if(!$stmt->bind_param("ss",$user,$pass)){
            echo "Erro de parametros: (" .$stmt->error . ")" . $stmt->error;
        }

        
        
        //Execucao
        if(!$stmt->execute()){
            echo "Erro de execucao: (" . $stmt->error . ") " . $stmt->error;
        }

        //variavei que recebem resultado
      //  $stmt->store_result();
      $stmt->bind_result($tipo,$ref);

        $res=$stmt->get_result();
       
       
        if(!$res){
            echo "Erro de obtencao de resultados: (" . $stmt->errno . ") " . $stmt->error;
        }
        
        if($res->num_rows > 0){

            while($linha=mysqli_fetch_array($res)){
                session_start();
                $_SESSION['Tipo']=$linha['Tipo'];
                $_SESSION['ref']=$linha['id_ref'];
                header('Location: ../'); 
            }
        }else{
            session_start();
            $_SESSION['FalhaLogin']="Login Falhou";
            header('Location: ../login.php');
        }

        $stmt->close();
        $conexao->close();
     
    }


    
    function cadastroDisciplina(){
        require_once('conexao.php');
        $disc = filtraEntrada($_POST["nomeDisciplina"]);
        $tipoDisc = filtraEntrada($_POST["tipoDisciplina"]);
     
        $query = "INSERT INTO `disciplina` ( `Descricao`, `Tipo`) VALUES (?, ?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Erro de parametros: (" .$conexao->error . ")" . $conexao->error;
        }
        if(!$stmt->bind_param("ss",$disc, $tipoDisc)){
            echo "Erro de parametros: (" .$stmt->error . ")" . $stmt->error;
        }
        if(!$stmt->execute()){
            echo "Erro de execucao: (" . $stmt->error . ") " . $stmt->error;
        }else{
            header('Location: ../Directoria/Disciplina.php');
        }

    }
?>