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
    //Registar novo Candidato
    function registar_candidato(){
        require_once("conexao.php");
        //Estágio 1: Preparação
        $query="CALL addCandidato(?,?,?,?,?,?,?,?,?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        // Estágio 2: Associação dos parâmetros (bind)
        $codCand=14;
        $nome=filtraEntrada($conexao,$_POST['nome']);
        $classe_anter=filtraEntrada($conexao,$_POST['classe_anter']);
        $classe_matr=filtraEntrada($conexao,$_POST['classe_matr']);
        $provincia=filtraEntrada($conexao,$_POST['provincia']);
        $distrito=filtraEntrada($conexao,$_POST['distrito']);
        $escola=filtraEntrada($conexao,$_POST['escola']);
        $regime=filtraEntrada($conexao,$_POST['regime']);
        $senha="Euro";    

        $bind=$stmt->bind_param("issssssss",$codCand,$nome,$classe_anter,$classe_matr,$provincia,$distrito,$escola,$regime,$senha);

        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            header("Location: ../Candidato.php");
        }   

        $stmt->close();
        $conexao->close();
    }    

    //Busca matriculas_candidatos
    function busca_candidato(){
        require_once("conexao.php");

        //Estágio 1: Preparação
        $query="SELECT codCand,nome_completo,classe_matricular,turno from candidato_aluno where nome_completo like ? and ano like ?";                           
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $nome=filtraEntrada($conexao,$_POST['nome_candidato']);
        $nome="%{$nome}%";
        
        $ano=filtraEntrada($conexao,$_POST['ano']);
        $ano="%{$ano}%";
        
        $bind=$stmt->bind_param("ss",$nome,$ano);

        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
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
        echo "<div class='row'> <div class='table-responsive offset-md-1'>";
        echo "<table class='table table-hover col-sm-8 col-md-10'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Turno</th>
                    <th>Classe</th>
                </tr>
            </thead>
            <tbody>";                       
                for($j=0; $j<$linhas; ++$j){
                    $res->data_seek($j);
                    $linha=$res->fetch_assoc();
                echo "<tr>";
                echo "<td>". $linha['codCand']. "</td>";
                    echo "<td>". $linha['nome_completo']. "</td>";
                    echo "<td>". $linha['turno']. "</td>";
                    echo "<td>". $linha['classe_matricular']. "</td>";
                    echo "</tr>";
                } 
            
            echo "</tbody>";
        echo "</table>";
        echo "</div></div>";

        $stmt->close();
        $conexao->close(); 
    }

?>