<?php
    session_start();
    $_SESSION['FalhaLogin']="";
	if(!isset($_SESSION['Tipo'])){
		header('Location: login.php');
    }
    
?>

<?php
if($_SESSION['Tipo']=="Aluno"){
    header('Location: Aluno');
}
if($_SESSION['Tipo']=="Director"){
    header('Location: Directoria');
}
if($_SESSION['Tipo']=="Secretaria"){
    header('Location: Secretaria');
}
if($_SESSION['Tipo']=="Professor"){
    header('Location: Professor');
}
?>

<form action="DAO/processamento.php" method="post">
    <input type="submit" value="Teminar Sessao" name="fecharSecao">;
</form>