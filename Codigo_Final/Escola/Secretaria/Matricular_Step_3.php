<?php
	session_start();
if(!(isset($_SESSION['id_User']) && isset($_SESSION['id_Escola']) 
&& isset($_SESSION['Tipo']) && isset($_SESSION['Nome_Escola']))){
     header('Location: ../');
}else{
   
    $local=$_SESSION['Nome_Escola'];
    $usuario=$_SESSION['nome_usuario'];
    $titulo='Matricula_Step 3'; //esse e o titulo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $menu='main_menu_Secretaria.php';//esse e o menu
    $corpo='Corpo/corpo_Matricula_Step 3.php';//esse e o corpo
    $navBar='Configuracao\navbar.php';//essa e o nav bar
    $rodape='footer.php';//especificar a url do footer
    $scriptAdd='scripts_add_Matricula3.php';
    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Templete.php'); 
}
?>
