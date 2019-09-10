<?php
     session_start();
     if(!isset($_SESSION['id_User'])){
         header('Location: ../../LoginGeral.php');
     }
?>