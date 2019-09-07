<?php
session_start();
if($_SESSION['Acesso_Escola']='N'){
    echo "Nao Tem Acesso";
}else{
    echo "Bem Vindo";
}
    
    



?>