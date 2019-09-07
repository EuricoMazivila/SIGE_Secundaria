<?php
    //Insercao de Novo Candidato
    if(isset($_POST['RegistarEscola'])){
        echo "Estou aqui";
        registar_Escola();
    }

    function registar_Escola(){
        require_once("conexao.php");
        //Estágio 1: Preparação
        $query="INSERT INTO `escola` ( `id_dir`, `Nome`, `Nivel`, `Pertenca`) VALUES (?,?,?,?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        
        $codDistrito=filtraEntrada($conexao,$_POST['idDir']); //filtraEntrada($conexao,$_SESSION['id_dir']);
        $NomeEscola =filtraEntrada($conexao,$_POST['NomeEscola']);
        $NivelEscola=filtraEntrada($conexao,$_POST['NivelEscola']);
        $PertencaEscola=filtraEntrada($conexao,$_POST['PertencaEscola']);

        $bind=$stmt->bind_param("isss",$codDistrito, $NomeEscola, $NivelEscola, $PertencaEscola);
        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            header("Location: ../ServicosDistrital\Index.php");
            
          
        }   

        $stmt->close();
        $conexao->close();
    }
 

?>