<?php
    //Marcar Matricula
    if(isset($_POST['marcar_matricula'])){
        marcar_matricula();
    }

    //Busca Matricula    
    if(isset($_POST['ano_m'])){
        busca_matricula();
    }

    if(isset($_POST['nome_aluno']) || isset($_POST['ano_mat']) || isset($_POST['classe'])){
       busca_alunos_matriculados();
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

    //Registar novo Periodo de Matricula
    function marcar_matricula(){
        require_once("conexao.php");
        
        //Estágio 1: Preparação
        $query="CALL addPriodo_Matricula(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $dataI=filtraEntrada($conexao,$_POST['dataInic']);    
        $dataF=filtraEntrada($conexao,$_POST['dataFim']); 
        $classe_oita=filtraEntrada($conexao,'8');//$_POST['']);s
        $total_vagas_oita_d=filtraEntrada($conexao,$_POST['tot_vagas_oita_d']);  
        $total_vagas_oita_n=filtraEntrada($conexao,$_POST['tot_vagas_oita_n']); 
        $classe_nona=filtraEntrada($conexao,'9');//$_POST['']);
        $total_vagas_nona_d=filtraEntrada($conexao,$_POST['tot_vagas_nona_d']);  
        $total_vagas_nona_n=filtraEntrada($conexao,$_POST['tot_vagas_nona_n']); 
        $classe_dec=filtraEntrada($conexao,'10');//$_POST['']); 
        $total_vagas_dec_d=filtraEntrada($conexao,$_POST['tot_vagas_dec_d']); 
        $total_vagas_dec_n=filtraEntrada($conexao,$_POST['tot_vagas_dec_n']); 
        $classe_decp=filtraEntrada($conexao,'11');//$_POST['']); 
        $total_vagas_decp_d=filtraEntrada($conexao,$_POST['tot_vagas_decp_d']);  
        $total_vagas_decp_n=filtraEntrada($conexao,$_POST['tot_vagas_decp_n']);
        $classe_decs=filtraEntrada($conexao,'12');//$_POST['']); 
        $total_vagas_decs_d=filtraEntrada($conexao,$_POST['tot_vagas_decs_d']);  
        $total_vagas_decs_n=filtraEntrada($conexao,$_POST['tot_vagas_decs_n']);
        
        $bind=$stmt->bind_param("sssiisiisiisiisii",$dataI,$dataF,$classe_oita,
        $total_vagas_oita_d,$total_vagas_oita_n,$classe_nona,$total_vagas_nona_d,
        $total_vagas_nona_n,$classe_dec,$total_vagas_dec_d,$total_vagas_dec_n,
        $classe_decp,$total_vagas_decp_d,$total_vagas_decp_n,$classe_decs,$total_vagas_decs_d,
        $total_vagas_decs_n);
        
        if(!$bind){
            echo "Parâmetros de ligação falhou: (" . $stmt->errno . ")" . $stmt->error;
        }

        // Estágio 3: execução
        if(!$stmt->execute()){
            echo "Execução falhou: (" . $stmt->errno . ")" . $stmt->error;
        }else{
            header("Location: ../Matriculas.php");
        }   

        $stmt->close();
        $conexao->close();
    }

    //Busca matriculas_marcadas
    function busca_matricula(){
        require_once("conexao.php");
        //Estágio 1: Preparação
        $query="SELECT classe,turno,total_vagas,total_vagas_preenchidas from matriculas_marcadas where ano like ?";
                                    
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $ano=filtraEntrada($conexao,$_POST['ano_m']);
        $ano="%{$ano}%";
        
        $bind=$stmt->bind_param("s",$ano);
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
        echo "<table class='table table-hover col-sm-10 mt-5'>
            <thead>
                <tr>
                    <th>Classe</th>
                    <th>Turno</th>
                    <th>Total de vagas</th>
                    <th>Vagas preenchidas</th>
                </tr>
            </thead>
            <tbody>";                       
                for($j=0; $j<$linhas; ++$j){
                    $res->data_seek($j);
                    $linha=$res->fetch_assoc();
                echo "<tr>";
                echo "<td>". $linha['classe']. "</td>";
                    echo "<td>". $linha['turno']. "</td>";
                    echo "<td>". $linha['total_vagas']. "</td>";
                    echo "<td>". $linha['total_vagas_preenchidas']. "</td>";
                    echo "</tr>";
                } 
            
            echo "</tbody>";
        echo "</table>";
        echo "</div></div>";

        $stmt->close();
        $conexao->close(); 
    }


    //Busca alunos matriculados
    function busca_alunos_matriculados(){
        require_once("conexao.php");

        //Estágio 1: Preparação
        $query="SELECT codal,nome,data from alunos_matriculados where nome like ? and year(data) like ? and classe like ? ";
        $stmt=$conexao->prepare($query);
        if(!$stmt){
            echo "Preparação Falhou: (" . $conexao->errno . ")" . $conexao->error;
        }

        // Estágio 2: Associação dos parâmetros (bind)
        $ano=filtraEntrada($conexao,$_POST['ano_mat']);
        $ano="%{$ano}%";
        
        $classe=filtraEntrada($conexao,$_POST['classe']);
        $classe="%{$classe}%";

        $nome=filtraEntrada($conexao,$_POST['nome_aluno']);
        $nome="%{$nome}%";
        
        $bind=$stmt->bind_param("sss",$nome,$ano,$classe);

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
        echo "<div class='row'> <div class='mt-3 table-responsive'>";
        echo "<table class='table table-hover'>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>";                       
                for($j=0; $j<$linhas; ++$j){
                    $res->data_seek($j);
                    $linha=$res->fetch_assoc();
                echo "<tr>";
                echo "<td>". $linha['codal']. "</td>";
                    echo "<td>". $linha['nome']. "</td>";
                    echo "<td>". $linha['data']. "</td>";
                    echo "</tr>";
                } 
            
            echo "</tbody>";
        echo "</table>";
        echo "</div></div>";

        $stmt->close();
        $conexao->close(); 
    }    
?>