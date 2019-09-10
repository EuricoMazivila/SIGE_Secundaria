<?php
include_once('Acesso.php');
if(Sair()){
    echo 'Acesso Negado';
}else{
  echo "Acesso Concedido ".$_SESSION['id_usuario'];
}
?>