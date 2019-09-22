<?php
session_start();
if(!(isset($_SESSION['id_User']) && isset($_SESSION['id_Escola']) 
&& isset($_SESSION['Tipo']) && isset($_SESSION['Nome_Escola']))){
     header('Location: ../');
}else{
    echo   'Acessando Escola '.$_SESSION['id_User'].' '.$_SESSION['id_Escola'].' '.$_SESSION['Tipo'];
    $local=$_SESSION['Nome_Escola'];
    $usuario=$_SESSION['nome_usuario'];
    $titulo='Aluno'; //esse e o titulo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $menu='main_menu_Secretaria.php';//esse e o menu
    $corpo='Corpo\Home_Page\Aluno.php';//esse e o corpo
    $navBar='Configuracao/navbar.php';//essa e o nav navbar.phpbar
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='scripts_add_candidato.php';
    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Templete.php');  
}

?>