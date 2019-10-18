<?php
    session_start();
    if(!(isset($_SESSION['login']['id_User']))){
          header('Location: ../Autenticacao/Login/Login_Principal.php');
    }elseif($_SESSION['login']['Nivel_Acesso']=='Distrital' || $_SESSION['login']['Nivel_Acesso']=='Admin') {
        $local=$_SESSION['login']['Nome_Local'];
        $usuario=$_SESSION['login']['nome_usuario'];
        $id_local=$_SESSION['login']['id_Local'];

        $email=$_SESSION['login']['email_usuario'];
    $hear='';
    $titulo='Registo Escola'; //esse e o titulo
    $metadados='Configuracao\metadados_ExternoN1.php';//esse e o metadados
    $menu='';//esse e o menu
     $corpo='Corpo/addEscola.php';//esse e o corpo
     $navBar='Configuracao\navbar.php';//essa e o nav bar
   // $navBar='';
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='';//Script/script_distrital.php
   
    include('../Templete/Templete.php');
    
    
}else{
    echo 'Nao possui permissao para aceder '.$_SESSION['login']['Nivel_Acesso'];
   // header('Location: ../Autenticacao/Login/Login_Principal.php');
}
?>
