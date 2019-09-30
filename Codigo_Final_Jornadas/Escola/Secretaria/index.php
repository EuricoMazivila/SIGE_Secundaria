<?php
    session_start();
    if(!(isset($_SESSION['login']['id_User']))){
         header('Location: ../');
    }elseif($_SESSION['login']['Nivel_Acesso']=='Secretaria') {
        $local=$_SESSION['login']['Nome_Local'];
        $usuario=$_SESSION['login']['nome_usuario'];
        $id_local=$_SESSION['login']['id_Local'];

        $email=$_SESSION['login']['email_usuario'];

    $titulo='Home Page Secretaria'; //esse e o titulo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $menu='main_menu_Secretaria.php';//esse e o menu
    $corpo='Corpo/Home_Page/Secretaria.php';//esse e o corpo
    $navBar='Configuracao\navbar.php';//essa e o nav bar
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='';

    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Templete.php'); 
}else{
    echo 'Nao Tem permissao Para aceder essa Funcionalidade';
}  
?>
