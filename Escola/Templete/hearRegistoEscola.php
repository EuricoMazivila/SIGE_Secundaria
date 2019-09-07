<?php
       session_start();
       if(!isset($_SESSION['id_usuario'])){
           header('Location: LoginGeral.php');
       }else{
         include_once('../Dao/processa_autenticar.php');
         NivelAcessoUserDistrital();
         echo $_SESSION['Acesso_Escola'];
         if($_SESSION['Acesso_Escola']='S'){
          echo "Acesso Permitido";
         } else{
          echo "Acesso Negado";
          header('Location: acessoNegado.php');
         }
         
       }
       
    
    
?>