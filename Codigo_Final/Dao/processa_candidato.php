<?php
    //Insercao de Novo Candidato    
    if(isset($_POST['registar'])){
        if(($_POST['nome']) && ($_POST['apelido']) && 
            ($_POST['datanasc']) && ($_POST['sexo']) 
            && ($_POST['classe_matr']) && ($_POST['regime']) && 
            ($_POST['escola']) && ($_POST['distrito'])){
                registar_candidato();
            }
    }

    //Busca de Candidato com ano 
    if(isset($_POST['nome_candidato'])){
        if(isset($_POST['ano'])){
            busca_candidato('s'); 
        }else{
            busca_candidato('n');
        }
    }
    
    //Validacao dos dados Preenchidos em Campos de formulario 
    function filtraEntrada($conexao,$dado){
        //remove espacoes no inicio e
        //no final da string
        $dado=trim($dado);

        //remove contra barras:
        // "cobra d\'agua" vira "cobra d'agua"
        $dado= stripslashes($dado);
        $dado=htmlspecialchars($dado);
        
        //Remove caracteres que um hacker possa ter 
        //inserido para invadir ou alterar o banco de dados
        $dado=$conexao->real_escape_string($dado);

        return $dado;
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
        $id_candidato=3;
        $nome=filtraEntrada($conexao,$_POST['nome']);
        $apelido=filtraEntrada($conexao,$_POST['apelido']);
        $data_nasc=filtraEntrada($conexao,$_POST['datanasc']);
        $sexo=filtraEntrada($conexao,$_POST['sexo']);
        $classe_matr=filtraEntrada($conexao,$_POST['classe_matr']);
        $regime=filtraEntrada($conexao,$_POST['regime']);
        $escola=filtraEntrada($conexao,$_POST['escola']);
        $distrito=filtraEntrada($conexao,$_POST['distrito']);
        //$senha="Euro";    

        $bind=$stmt->bind_param("issssssss",$id_candidato,$nome,$apelido,$data_nasc,$sexo,$classe_matr,$regime,$escola,$distrito);

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
    function busca_candidato($comAno){
        require_once("conexao.php");

        //Estágio 1: Preparação
      //  $query="SELECT codCand,nome_completo,classe_matricular,turno from candidato_aluno where nome_completo like ? and ano like ?";                           
        $query="SELECT id_candidato, CONCAT(nome,' ',apelido) as nome_completo,regime,classe_matricular from candidato_aluno where CONCAT(nome,' ',apelido) like ? and ano like ?";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $nome=filtraEntrada($conexao,$_POST['nome_candidato']);
        $nome="%{$nome}%";
        
        if($comAno=='s'){
            $ano=filtraEntrada($conexao,$_POST['ano']);
            $ano="%{$ano}%";
        }else{
            $ano="%2019%";
        }
    
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
                echo "<td>". $linha['id_candidato']. "</td>";
                    echo "<td>". $linha['nome_completo']. "</td>";
                    echo "<td>". $linha['regime']. "</td>";
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