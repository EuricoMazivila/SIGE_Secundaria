<?php
  include_once('../Autenticacao/Acesso.php');
  
  if(!(Aceder() && AcederDistrito() && AcederRegistoEscola())){
        header('Location: ../ServicosDistrital/');  
    } //else{
     // echo "<br>Acesso Permitido";  
 // }
    
?>