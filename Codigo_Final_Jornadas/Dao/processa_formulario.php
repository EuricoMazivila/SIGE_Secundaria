<?php
    //Busca provincia 
    if(isset($_POST['buscaprovincia'])){
        busca_provincia();
    } 

    //Busca distrito
    if(isset($_POST['buscadistrito'])){
        busca_distrito();
    }

    //Busca Bairro
    if(isset($_POST['buscabairro'])){
        busca_bairro();
    }

    //Busca provincia
    function busca_provincia(){
        require_once("conexao.php");
        $id_Pais = $_POST['buscaprovincia'];
        $result_sub_cat = "SELECT id_Prov,Nome FROM provincia WHERE id_Pais=$id_Pais ORDER BY Nome";
        $resultado_sub_cat = $conexao->query($result_sub_cat);
        echo'<option selected value="">Seleciona a provincia</option>';
        while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
            echo'<option value="'.$row_sub_cat['id_Prov'].'">'.utf8_encode($row_sub_cat['Nome']).'</option>';
        }
    }

    //Busca distrito
    function busca_distrito(){
        require_once("conexao.php");
        $id_Prov = $_POST['buscadistrito'];
        $result_sub_cat = "SELECT id_distrito,Nome FROM distrito WHERE id_Prov=$id_Prov ORDER BY Nome";
        $resultado_sub_cat = $conexao->query($result_sub_cat);
        echo'<option selected value="">Seleciona o distrito</option>';
        while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
            echo'<option value="'.$row_sub_cat['id_distrito'].'">'.utf8_encode($row_sub_cat['Nome']).'</option>';
        }
    }

    //Busca Bairro
    function busca_bairro(){
        require_once("conexao.php");
        $id_distrito = $_POST['buscabairro'];
        $result_sub_cat = "SELECT id_Bairro,Nome FROM bairro WHERE id_Distrito=$id_distrito ORDER BY Nome";
        $resultado_sub_cat = $conexao->query($result_sub_cat);
        echo'<option selected value="">Seleciona o Bairro</option>';
        while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
            echo'<option value="'.$row_sub_cat['id_Bairro'].'">'.utf8_encode($row_sub_cat['Nome']).'</option>';
        }
    }

?>