<?php
    $hostname="localhost";
    $user="root";
    $password="";
    $database="Escola_Secundaria";
    
    $conexao=new mysqli($hostname,$user,$password,$database);

    if($conexao->connect_errno){
        echo "Falha na conecao com MySQL: (" .$conexao->connect_errno . ") " . $conexao->connect_error;
    }

    function filtraEntrada($conexao,$dado){
        //remove espacoes no inicio e
        //no final da string
        $dado=trim($dado);

        //remove contra barras:
        // "cobra d\'agua" vira "cobra d'agua"
        $dado= stripslashes($dado);
        $dado=htmlspecialchars($dado);
        
        //Remove caracteres que um hacker possa ter 
        //inserido para invadir ou alterar o banco de dados
        $dado=$conexao->real_escape_string($dado);

        return $dado;
    }


?>