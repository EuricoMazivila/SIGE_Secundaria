<?php
session_start();

if(isset($_SESSION['login']['id_User'])){
    echo 'login';
    echo  $_SESSION['login']['id_User'].' '.$_SESSION['login']['nome_usuario'].' '. $_SESSION['login']['Nivel_Acesso'].' '.$_SESSION['login']['Local'].' '.$_SESSION['login']['id_Local'].' '.$_SESSION['login']['Nome_Local'].' '.$_SESSION['login']['Estado'];
  // /* if(isset($_SESSION['id_User']) && isset($_SESSION['Tipo']) && isset($_SESSION['Nome_Escola']) ){
        switch ($_SESSION['login']['Nivel_Acesso']) {
            case 'Aluno':
                header('Location: Aluno/');
            break;
            case 'Secretaria':
                header('Location: Secretaria/');
            break;
            case 'Candidato':
                header('Location: Candidato/');
            break;
            case 'Professor':
                header('Location: Professor/');
            break;
            case 'Directoria':
                header('Location: Directoria/');
            break;
            case 'Admin':
                header('Location: Admin/');
            break;
            
            default:
                echo 'NAO POSSUI PERMICAO';
            break;
        }
   // }
}else{
    
   header('Location: ../Autenticacao/Login/Login_Principal.php');
}



?>