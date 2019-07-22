<?php
    $hostname="localhost";
    $user="root";
    $password="";
    $database="testegrafico";
    
    $conexao=new mysqli($hostname,$user,$password,$database);

    if($conexao->connect_errno){
        echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
    }

?>