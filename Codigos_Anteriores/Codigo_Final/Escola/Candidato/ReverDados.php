<?php
	session_start();
    if(!(isset($_SESSION['login']['id_User']))){
         header('Location: ../');
    }elseif($_SESSION['login']['Nivel_Acesso']=='Candidato') {
        $local=$_SESSION['login']['Nome_Local'];
        $usuario=$_SESSION['login']['nome_usuario'];
        $id_local=$_SESSION['login']['id_Local'];
        $id_usuario=$_SESSION['login']['id_User'];
        $titulo='Formulario do Aluno';
    $titulo='Rever Dados'; //esse e o titulo
    $menu='';//esse e o menu
    $corpo='Corpo/corpo_ReverDados.php';//esse e o corpo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $navBar='Configuracao\navbar.php';//essa e o nav bar
    $rodape='';//especificar a url do footer
    $scriptAdd='scripts_add_Matricula3.php';
    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Templete.php'); 
}else{
    echo 'Nao Tem permissao Para aceder essa Funcionalidade';
}
?>