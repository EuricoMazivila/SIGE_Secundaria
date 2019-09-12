<?php

function Aceder(){
    session_start();
    $statuss=isset($_SESSION['id_User']);
    if($statuss){
        $idUser= $_SESSION['id_User'];    
    }else{
        header('Location: ../Escola/LoginGeral.php');
    }
    return $statuss;
}

function AcederDistrito(){
        $statuss=$_SESSION['Acesso_Distrital']=='S';
 
        if($statuss){
            $mensagem= 'Acessando Distrito '.$_SESSION['Acesso_Distrital'].$_SESSION['nome_usuario'];
            $_SESSION['FALHA']=$mensagem;
        }else{
            $mensagem ='NAO TEM PERMISSOES PARA ACEDER ESTA PAGINA';
            $_SESSION['FALHA']=$mensagem;
            header('Location: ../falha.php');
         }
     return $statuss; 
}

function AcederEnsino(){
    $statuss=$_SESSION['Acesso_Escola']=='S';

    $_SESSION['FALHA'];
    if($statuss){
        $mensagem= 'Acessando Escola '.$_SESSION['Acesso_Escola'].$_SESSION['nome_usuario'];
        $_SESSION['FALHA']=$mensagem;
    }else{
        $mensagem ='Falha no Acessando Escola';
        $_SESSION['FALHA']=$mensagem;
        header('Location: ../falha.php');
        
    }



return $statuss; 
}

function AcederRegistoEscola(){
   
        include_once('../Dao/processa_autenticar.php');
        NivelAcessoUserDistrital();
        $statuss=$_SESSION['Acesso_Escola']=='S';
    
    return $statuss; 
}
function Sair(){
    session_start();
    session_destroy();
    /*header('Location: NivelAcesso.php');
    $statuss=!isset($_SESSION['id_usuario']);
    if($statuss){
        header('Location: NivelAcesso.php');
    }
    return $statuss;*/
}

?>