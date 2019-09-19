<?php
session_start();

if(isset($_SESSION['id_User'])){
    require_once('../Dao/Busca_Pesquisa/busca_escola.php');
    busca_escola_Acesso_User();
    if(isset($_SESSION['id_Escola']) && isset($_SESSION['Tipo']) && isset($_SESSION['Nome_Escola']) ){
        switch ($_SESSION['Tipo']) {
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
    }
}else{
        header('Location: ../Autenticacao/Login/Login_Principal.php');
}



?>