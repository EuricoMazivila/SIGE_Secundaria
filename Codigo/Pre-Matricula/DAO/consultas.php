<?php


function busca($query){
    include('conexao.php');
   // echo $query;
    $executar= mysqli_query($conexao, $query);
    if ($executar  === TRUE) {
        echo "Executado com sucesso";
    }else{
        echo "".mysqli_error($conexao);
    }
    return $executar;
}
?>