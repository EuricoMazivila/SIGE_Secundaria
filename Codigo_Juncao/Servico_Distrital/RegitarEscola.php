<?php
session_start();
    $local='Servico Distrital de '.$_SESSION['Designacao'];
    $usuario=$_SESSION['nome_usuario'];
    $hear='';
    $titulo='Registo Escola'; //esse e o titulo
    $metadados='Configuracao\metadados_ExternoN1.php';//esse e o metadados
    $menu='';//esse e o menu
     $corpo='Corpo/addEscola.php';//esse e o corpo
     $navBar='Configuracao\navbar.php';//essa e o nav bar
   // $navBar='';
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='Script\scripts_add_candidato.php';
   
    include('../Templete/Templete.php');
?>
