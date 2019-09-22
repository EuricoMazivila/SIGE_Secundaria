<?php
session_start();
echo 'distrito';
if(isset($_SESSION['id_User'])){
    require_once('../Dao/Busca_Pesquisa/busca_distrital.php');
    busca_distrito_Acesso_User();
    

    if(isset($_SESSION['id_dir']) && isset($_SESSION['Designacao']) && isset($_SESSION['Gestao_Escolas']) && isset($_SESSION['Gestao_Operacoes']) && isset($_SESSION['Gestao_Usuarios']) ){
      
            $local='Servico Distrital de '.$_SESSION['Designacao'];
            $usuario=$_SESSION['nome_usuario'];
            $titulo='Servico Distrital'; //esse e o titulo
            $metadados='Configuracao\metadados_ExternoN1.php';//esse e o metadados
            $menu='main_menu_Secretaria.php';//esse e o menu
            $corpo='Corpo\Home_Page\ServicoDistrital.php';//esse e o corpo
            $navBar='Configuracao\navbar.php';//essa e o nav navbar.phpbar
            $rodape='footer.php';//especificar a url do footer
            $scriptAdd='Script/scripts_add_candidato.php';
            //Aqui pode ficar as dependencias de hader como verificar se ja fez login
            include('../Templete/Templete.php');  
        }
     
}else{
echo 'falha';
        //header('Location: ../Autenticacao/Login/Login_Principal.php');
}




?>