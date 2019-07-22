
<?php
 include_once('DAO/conexao.php');

	//atualizado por candido
$executar= mysqli_query($conexao, "SELECT * FROM `estatistica_alunos`");
$json = [];
if($executar->num_rows>0){ //verifica o numero de linhas
	while($linha=mysqli_fetch_array($executar)){
		$json[]= [(int)$linha['classe'],(int)$linha['Total_Alunos']];
	}}

/*===codigo do exemplo=======

$stmt = $dbcon->prepare("SELECT * from alunos");    		
$stmt->execute();
$json = [];

while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	extract($row);
	$json[]= [(int)$classe,(int)50];                 		
}*/
echo json_encode($json);
 


/*===Meu codigo====

$stmt = $dbcon->prepare("select conta()");                 chama funcao
$stmt->execute();
$json = [];

while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	extract($row);
	$json[]= [(int)$conta(),(int)50];                    quero que apareca o retorno da funcao ai no $conta
}
echo json_encode($json);*/

//por continuar
