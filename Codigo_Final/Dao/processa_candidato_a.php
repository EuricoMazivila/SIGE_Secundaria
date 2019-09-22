<?php
session_start();
    //Para busca sem refresh da escola
    if(isset($_POST['buscaescola'])){
      busca();
    }
    
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

    //Busca de Candidato para matricular 
    if(isset($_POST['nome_candidato_m'])){
        busca_candidato_m();
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

    function busca(){
        require_once("conexao.php");
        $id_distrito = $_POST['buscaescola'];
        $result_sub_cat = "SELECT Nome FROM escola WHERE id_Dir=$id_distrito ORDER BY Nome";
        $resultado_sub_cat = $conexao->query($result_sub_cat);
        echo'<option selected value="">Seleciona a escola de origem</option>';
        while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
            echo'<option>'.utf8_encode($row_sub_cat['Nome']).'</option>';
        }
    }

    //Registar novo Candidato
    function registar_candidato(){
        require_once("conexao.php");
        //Estágio 1: Preparação
        $query="CALL addCandidato(?,?,?,?,?,?,?,?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }
        // Estágio 2: Associação dos parâmetros (bind)
        $nome=filtraEntrada($conexao,$_POST['nome']);
        $apelido=filtraEntrada($conexao,$_POST['apelido']);
        $data_nasc=filtraEntrada($conexao,$_POST['datanasc']);
        $sexo=filtraEntrada($conexao,$_POST['sexo']);
        $classe_matr=filtraEntrada($conexao,$_POST['classe_matr']);
        $regime=filtraEntrada($conexao,$_POST['regime']);
        $escola_origem=filtraEntrada($conexao,$_POST['escola']);
        $escola_destino=filtraEntrada($conexao, $_POST['id_Escola']);
        //$senha="Euro";    

        $bind=$stmt->bind_param("sssssssi",$nome,$apelido,$data_nasc,$sexo,$classe_matr,$regime,$escola_origem,$escola_destino);

        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            header("Location: ../escola/secretaria/candidato.php");
        }   

        $stmt->close();
        $conexao->close();
    }    

    //Busca matriculas_candidatos
    function busca_candidato($comAno){
        require_once("conexao.php");

        //Estágio 1: Preparação
      $query="SELECT id_candidato, concat(Nome,' ',Apelido) as nome_completo,regime,classe_matricular from candidatos where (Nome like ? or Apelido  like ?) and ano like ?";
        
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
    
        $bind=$stmt->bind_param("sss",$nome,$nome,$ano);

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

    //Busca matriculas_candidatos
    function busca_candidato_m(){
        require_once("conexao.php");

        //Estágio 1: Preparação
        $query="SELECT id_candidato, concat(Nome,' ',Apelido) as nome_completo,estado,regime,classe_matricular from candidatos where (Nome like ? or Apelido  like ?) and ano and id_escola=? and estado='cadastrado'";

        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $nome=filtraEntrada($conexao,$_POST['nome_candidato_m']);
        $nome="%{$nome}%";
        
        $id_escola=$_SESSION['id_Escola'];

        $bind=$stmt->bind_param("ssi",$nome,$nome,$id_escola);

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