<?php
$hostname="localhost";
$user="root";
$password="";
$database="sige_secundaria";
$conexao= new mysqli($hostname,$user,$password,$database);

if($conexao->connect_error)
    die("Ocorreu um erro na conexao com a base de dados");

?>