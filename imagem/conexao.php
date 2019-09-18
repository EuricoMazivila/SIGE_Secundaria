<?php
$hostname="localhost";
$user="root";
$password="";
$database="feng";

$conexao=new mysqli($hostname,$user,$password,$database);
if($conexao->connect_error){
    die("Erro na conecao: ".$conexao->error);
}

?>