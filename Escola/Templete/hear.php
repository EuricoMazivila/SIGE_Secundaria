<?php
  
     session_start();
     if(!isset($_SESSION['id_usuario'])){
         header('Location: LoginGeral.php');
     }else{
       if($_SESSION['acessoGestao']=0){
        header('Location: Templete\SemAcesso.php');
     }
    }
?>