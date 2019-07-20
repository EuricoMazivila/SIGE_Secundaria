
<?php 

$dbhost = 'localhost';
$dbname = 'testegrafico';
$dbuser = 'root';
$dbpass = '';

try {

	$dbcon = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
	$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $ex) {
	dle($ex->getMessage());
}



//===codigo do exemplo=======

$stmt = $dbcon->prepare("SELECT * from alunos");    		
$stmt->execute();
$json = [];

while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
	extract($row);
	$json[]= [(int)$classe,(int)50];                 		
}
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