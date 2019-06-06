<?php

    if(isset($_POST['entrar'])){
        iniciarSessao();
    }

    if(isset($_POST['terminar'])){
        terminarSessao();
    }

    //Login Para Pre-Matricula
    function iniciarSessao(){
        include_once("conexao.php");
        $codigo=$_POST["inputCod"];
        $query="SELECT *FROM candidato where codigo='$codigo'";
        $resultado=$conexao->query($query);

        if(!$resultado){
            die("Problemas de conexao com Base de Dados".$conexao->error);
        }else{
            if($resultado->num_rows==0){
                header("location:../Login_Pre_Matricula.php");
            }else{
                session_start();
                $_SESSION['inputCod']=$codigo;
                //Direcionamento para pagina de formularios 
                header('location: ../formulario_completo.php');
            }
        }
    }


    function terminarSessao(){
        session_start();
        session_destroy();
        header("location:../Login_Pre_Matricula.php");
    }


    $resultado->close();
    $conexao->close();

?>
