<?php
  include_once('Acesso.php');
  if(Aceder()){
      echo 'Acesso Negado';
  }

?>
  <a href="sair.php">Sair</a>