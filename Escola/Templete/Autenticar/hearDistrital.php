<?php
  include_once('../Autenticacao/Acesso.php');
  
  if(Aceder() && AcederDistrito()){
    include_once('../Dao/processa_autenticar.php');
    NivelAcessoUserDistrital();
  }else{
    header('Location: ../');   
  }
    
?>