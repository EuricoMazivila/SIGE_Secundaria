<?php
    session_start();
    if(!(isset($_SESSION['login']['id_User']))){
         header('Location: ../');
    }elseif($_SESSION['login']['Nivel_Acesso']=='Candidato') {
        $local=$_SESSION['login']['Nome_Local'];
        $usuario=$_SESSION['login']['nome_usuario'];
        $id_local=$_SESSION['login']['id_Local'];
        $id_user=$_SESSION['login']['id_User'];
        $titulo='Formulario do Aluno'; //esse e o titulo
    $menu='';//esse e o menu
    $corpo='Corpo/corpo_formulario.php';//esse e o corpo
    $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
    $navBar='Configuracao\navbar_login.php';//essa e o nav bar
    $rodape='';//especificar a url do footer
    $scriptAdd='scripts_formulario.php';
    //Aqui pode ficar as dependencias de hader como verificar se ja fez login
    include('../../Templete/Templete.php'); 
}else{
    echo 'Nao Tem permissao Para aceder essa Funcionalidade';
}

?>