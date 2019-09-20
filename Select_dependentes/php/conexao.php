<?php
    $user="root";
    $senha="";
    $hostname="localhost";
    $database="sige_final";
    $conexao= mysqli_connect($hostname,$user,$senha,$database);

    if($conexao->connect_error)
        die("Ocorreu um erro na conexao com a base de dados");
?>