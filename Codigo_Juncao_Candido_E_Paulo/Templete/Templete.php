﻿<?php
  /*  session_start();
    if(!isset($_SESSION['ususario']) && !isset($_SESSION['senha'])){
        header('Location: Login_Principal.php');
    }*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Aqui Fica o metadados-->
    <?php include_once($metadados);?>
</head>

<body>

    <!--Aqui Fica o nav Bar-->
    <div>
        <?php include_once($navBar); ?>
    </div>

    <!--Aqui Fica o Menu-->
    <div>
        <div class="top-margin">
            <div class="menuS collapse">
                <?php 
                    if($menu!='')
                        include_once($menu);
                ?>
            </div>

            <!--Aqui Fica o corpo da pagina-->
            <div class="menuT top-margin">
                <?php
                    if($corpo!=''){
                        include_once($corpo);
                    }
                    ?>
            </div>

            <!--Aqui Fica o rodape-->
            <div>
                <?php 
                    if($rodape!='')
                    include_once($rodape);?>
            </div>

            <script>
                $('.btn-menu').click(function () {
                    $('.menuS').fadeToggle(5);
                    $('.menuT').fadeToggle(4);
                });
            </script>

            <!--Aqui ficam os Script Adicionais-->
            <?php
                if($scriptAdd!='')
                    include_once($scriptAdd);         
            ?>

</body>

</html>