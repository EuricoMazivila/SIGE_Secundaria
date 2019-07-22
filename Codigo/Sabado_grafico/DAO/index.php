<?php 
include ('conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="estado">estatistica_alunos</label>
            <table>
            <thead>
            <tr>
                <th>Classe</th>
                <th>Total_Alunos</th>
                <th>Total_Masculino</th>
                <th>Total_Femenino</th>
            </tr>
            </thead>

            <tbody>
                <?php
                    $executar= mysqli_query($conexao, "SELECT * FROM `estatistica_alunos`");
                    if($executar->num_rows>0){ //verifica o numero de linhas
                    while($linha=mysqli_fetch_array($executar)){
                                    //$lnha['coluna'] referencia a coluna em sql 
                    echo "<tr> <td>".$linha['classe']."</td> <td>".$linha['Total_Alunos']."</td> 
                    <td>".$linha['Total_Masculino']."</td> <td>".$linha['Total_Femenino']."</td> </tr>";
                }    
            }
                ?>
                </tbody>
                </table>
                

    </form>
</br>
</br>
    <form action="" method="post">
        <label for="estado">estatitica_vnculo_professor</label>
            <table>
            <thead>
            <tr>
                <th>Vinculo</th>
                <th>Total Professores</th>
                
            </tr>
            </thead>

            <tbody>
                <?php
                    $executar= mysqli_query($conexao, "SELECT * FROM `estatitica_vnculo_professor`");
                    if($executar->num_rows>0){ //verifica o numero de linhas
                    while($linha=mysqli_fetch_array($executar)){
                                    //$lnha['vin] referencia a coluna em sql  vinculo Total_Professores
                    echo "<tr> 
                        <td>".  $linha['vinculo']."</td>
                        <td>".$linha['Total_Professores']."</td> 
                    </tr>";
                }    
            }
                ?>
                </tbody>
                </table>
                

    </form>
    


</body>

</html>