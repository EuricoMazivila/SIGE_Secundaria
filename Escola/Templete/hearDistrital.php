<?php
  
     session_start();
     if(!isset($_SESSION['id_usuario'])){
         header('Location: LoginGeral.php');
     }else{
       include_once('../Dao/processa_autenticar.php');
       NivelAcessoUserDistrital();
       if($_SESSION['acessoDistital']=0){
        header('Location: Templete\SemAcesso.php');
     }else{
       echo "Bem Vindo";
     }
    }
?>