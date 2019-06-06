<?php

    if(isset($_POST['login'])){
        iniciarSessao();
    }

    if(isset($_POST['terminar'])){
        terminarSessao();
    }

    function iniciarSessao(){
        include_once("conexao.php");
        $usuario=$_POST['inputUsuario'];
        $senha=$_POST['inputSenha'];
        $query="SELECT tipo FROM user WHERE usuario='$usuario' AND senha='$senha'";
        $resultado=$conexao->query($query);
        
        //Para aluno, professor e director;
        if(!$resultado){
            die($conexao->error);
        }else{
            $linhas=$resultado->num_rows;
            if($linhas==0){
                header("location: ../Login_Principal.php");
            }else{
                $linha=$resultado->fetch_array(MYSQLI_ASSOC);
                $tipo=$linha['tipo'];
                if($tipo=="aluno"){
                    header("location: ../ "); //Adicionar Pagina Inicial do Aluno
                }elseif($tipo=="professor"){
                    header("location: ../ "); //Adiciona Pagina Inicial do Professor 
                }elseif($tipo=="director"){
                    header("location: ../ "); //Adiciona Pagina Inicial do Director
                }
            }
        }
    }
    
    function terminarSessao(){
        session_start();
        session_destroy();
        header("location: ../Login_Principal.php");
    }
        
    $resultado->close();
    $conexao->close();
    

?>