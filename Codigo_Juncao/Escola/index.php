<?php
 session_start();
 if(isset($_SESSION['id_User'])){
     echo '<br> Acesso a Escola <br>';
     echo  $_SESSION['id_User'].' Nome do usuario'. $_SESSION['nome_usuario'].' '.$_SESSION['Acesso_Distrital'].' '.$_SESSION['Acesso_Escola'].' '.$_SESSION['id_Pessoa'];
 }else{
     echo 'Sair';
 }?>