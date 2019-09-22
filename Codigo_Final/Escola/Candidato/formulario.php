<?php
    session_start();
    if(!(isset($_SESSION['id_User']) && isset($_SESSION['id_Escola']) 
    && isset($_SESSION['Tipo']) && isset($_SESSION['Nome_Escola']))){
        header('Location: ../');
    }else{
       // if($_SESSION['Tipo']=='Candidato'){
            $local=$_SESSION['Nome_Escola'];
            $usuario=$_SESSION['nome_usuario'];
            $titulo='Formulario do Aluno'; //esse e o titulo
            $menu='';//esse e o menu
            $corpo='Corpo/corpo_formulario.php';//esse e o corpo
            $metadados='Configuracao\metadados_Externo.php';//esse e o metadados
            $navBar='Configuracao\navbar_login.php';//essa e o nav bar
            $rodape='';//especificar a url do footer
            $scriptAdd='scripts_formulario.php';
            //Aqui pode ficar as dependencias de hader como verificar se ja fez login
            include('../../Templete/Templete.php');
      //  }else{
       //     header('Location: ../');
      //  }
    } 
?>