<?php
  /*  session_start();
    if(!isset($_SESSION['ususario']) && !isset($_SESSION['senha'])){
        header('Location: Login_Principal.php');
    }*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Aqui Fica o metadados-->
    <?php 
        if($metadados!='')
        include_once($metadados);
    ?>
</head>

<body>

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

            <!--Aqui ficam os Script Adicionais-->
            <?php
                if($scriptAdd!='')
                    include_once($scriptAdd);         
            ?>

</body>

</html>