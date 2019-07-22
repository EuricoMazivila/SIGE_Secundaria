<?php 
	require_once("conexao.php");

	// Chamada do procedimento contar
	
	//Estágio 1: Preparação
	$query="Call contar()";
	$stmt=$conexao->prepare($query);
	if(!$stmt){
		echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
	}

	// Estágio 2: execução
	if(!$stmt->execute()){
		echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
	}

	// Estágio 3: Obtenção de dados
	$res=$stmt->get_result();
	if(!$res){
		echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
	}
	$json = [];

	$linhas=$res->num_rows;
	for($j=0; $j<$linhas; ++$j){
		$res->data_seek($j);
		$linha=$res->fetch_assoc();
		echo "Usuario : ". $linha['numero'] . '<br><br>'; //Resultado do procedimento
		
	}

	$stmt->close();
	$conexao->close();


	//Busca de Todos os dados da tabela Alunos
	function alunos(){
		//Estágio 1: Preparação
		$query="SELECT * from alunos";
		$stmt=$conexao->prepare($query);
		if(!$stmt){
			echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
		}

		// Estágio 2: execução
		if(!$stmt->execute()){
			echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
		}

		// Estágio 3: Obtenção de dados
		$res=$stmt->get_result();
		if(!$res){
			echo "A Obtenção do conjunto de resultados falhou: (" . $stmt->errno . ")" . $stmt->error;
		}

		$linhas=$res->num_rows;
		for($j=0; $j<$linhas; ++$j){
			$res->data_seek($j);
			$linha=$res->fetch_assoc();
			echo "Usuario : ". $linha['nome'] . '<br><br>';
			echo "Email : ". $linha['sexo'] . '<br><br>';
			echo "Senha : ". $linha['classe'] . '<br><br>';
		}

		$stmt->close();
		$conexao->close();
	}	


	

