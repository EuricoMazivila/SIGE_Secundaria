<?php
    /*
    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header('Location: LoginGeral.php');
    } */
    
    $titulo='Sige Moz'; //esse e o titulo
    $metadados='metadados_externo.php';//esse e o metadados
    $menu='';//esse e o menu
    $corpo='Corpo/inicial.php';//esse e o corpo
    $navBar='navbar.php';//essa e o nav bar
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='scripts_add_candidato.php';
    include('Templete/Templete.php');
?>
