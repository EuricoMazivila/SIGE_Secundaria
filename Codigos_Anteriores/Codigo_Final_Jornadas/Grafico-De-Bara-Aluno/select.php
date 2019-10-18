<?php 
function busca_Classe(){
    include('conexao.php');
        $query= 'SELECT classe FROM `estatistica_alunos` ORDER by classe ASC';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
           echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo	$linha['classe'];
                    $i++;
                }else{
                    echo	", ".$linha['classe'];
                }
                   
                }
                echo "]";
            }else{
            echo 'Dados nao encotrados';
    }
    
}

function busca_Total_Aluno(){
    include('conexao.php');
        $query= 'SELECT * FROM `estatistica_alunos`ORDER BY `classe` ASC';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
           echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo	$linha['Total_Alunos'];
                    $i++;
                }else{
                    echo	", ".$linha['Total_Alunos'];
                }
                   
                }
                echo "]";
            }else{
            echo 'Dados nao encotrados';
    }
    
}

function busca_Total_Aluno_M(){
    include('conexao.php');
        $query= 'SELECT Total_Masculino FROM `estatistica_alunos`  
        ORDER BY `classe` ASC';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
           echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo	$linha['Total_Masculino'];
                    $i++;
                }else{
                    echo	", ".$linha['Total_Masculino'];
                }
                   
                }
                echo "]";
            }else{
            echo 'Dados nao encotrados';
    }
    
}

function busca_Total_Aluno_F(){
    include('conexao.php');
        $query= 'SELECT Total_Femenino FROM `estatistica_alunos`  
        ORDER BY `classe` ASC';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
           echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo	$linha['Total_Femenino'];
                    $i++;
                }else{
                    echo	", ".$linha['Total_Femenino'];
                }
                   
                }
                echo "]";
            }else{
            echo 'Dados nao encotrados';
    }
    
}

function busca_Vinculo_Prof(){
    include('conexao.php');
        $query= 'SELECT vinculo FROM `estatitica_vnculo_professor` ORDER BY vinculo';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
           echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo	$linha['vinculo'];
                    $i++;
                }else{
                    echo	", ".$linha['vinculo'];
                }
                   
                }
                echo "]";
            }else{
            echo 'Dados nao encotrados';
    }
    
}

function busca_Vinculo_Prof_Total(){
    include('conexao.php');
        $query= 'SELECT vinculo, Total_Professores FROM `estatitica_vnculo_professor` ORDER BY vinculo';
        $executar= mysqli_query($conexao, $query);
        $num= mysqli_num_rows($executar);
        $i=0;
        if($num>0){
            echo "[";
            while($linha=mysqli_fetch_assoc($executar)){
                if($i==0){
                    echo "{ name: ".$linha['vinculo']." ,";
                    echo "y: ".$linha['Total_Professores']." ,";
                    echo "   color: Highcharts.getOptions().colors[$i] }";
                    $i++;
                } else{
                    echo ", { name: ".$linha['vinculo']." ,";
                    echo "y: ".$linha['Total_Professores']." ,";
                    echo "color: Highcharts.getOptions().colors[$i] }";
                    $i++;
                }
            }
            echo "]";
            }else{
            echo '[Dados nao encotrados]';
   
    }
    
}
?>

