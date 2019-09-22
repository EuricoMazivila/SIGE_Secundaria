<?php
session_start();
    session_destroy();
    $titulo='Login Principal'; //esse e o titulo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $corpo='Corpo/corpo_Login_Principal.php';//esse e o corpo
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='scripts_login.php';
    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Template_login.php');
    
?>
