<?php
$host_server="localhost"; //nome do servidor 127.0.0.1
$host_user="root";          //nome do usuario
$host_pass="";              //senha do usuario
$host_db="db_sige";            //base de dados
$conexao = mysqli_connect($host_server, $host_user , $host_pass, $host_db);

?>
<datalist id="Nacionalidade">
    <?php
        $executar= mysqli_query($conexao, "SELECT nome FROM `pais`");
        if($executar->num_rows>0){ //verifica o numero de linhas
        while($linha=mysqli_fetch_array($executar)){
    ?>
    <option value <?php echo " = ".$linha['nome'];?>></option>
    <?php
      }    }
    ?>
</datalist>

<datalist id="Provincia">
    <?php
        $executar= mysqli_query($conexao, "SELECT id_provincia,id_pais,Nome FROM `provincia` ORDER by id_pais");
        if($executar->num_rows>0){ //verifica o numero de linhas
        while($linha=mysqli_fetch_array($executar)){
    ?>
    <option ><?php echo $linha['Nome'];?></option>
    <?php
      }    }
    ?>
</datalist>
<datalist id="Distrito">
    <?php
        $executar= mysqli_query($conexao, "SELECT id_distrito,id_Provincia,nome FROM `distrito` ORDER BY id_provincia");
        if($executar->num_rows>0){ //verifica o numero de linhas
        while($linha=mysqli_fetch_array($executar)){
    ?>
    <option><?php echo $linha['nome'];?></option>
    <?php
      }    }
    ?>
</datalist>

<datalist id="Bairro">
    <?php
        $executar= mysqli_query($conexao, "SELECT nome FROM `bairro` ORDER by id_Provincia");
        if($executar->num_rows>0){ //verifica o numero de linhas
        while($linha=mysqli_fetch_array($executar)){
    ?>
    <option value <?php echo " = ".$linha['nome'];?>></option>
    <?php
      }    }
    ?>
</datalist>