<?php
  include_once('../Autenticacao/Acesso.php');
  
  if(Aceder() && AcederEnsino()){
    include_once('../Dao/processa_autenticar.php');
    NivelAcessoUserEscola();
   
    if($_SESSION['acessoEscolas']=0){
      header('Location: ../');
    }else{
      
    }  
  }
    
?>