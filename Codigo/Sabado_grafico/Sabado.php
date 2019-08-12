<!DOCTYPE html>
<html>
<head>
	<title>Quinta-feira</title>
	<meta charset="utf-8">

	<script src="_js/jquery.js"></script>
	<script src="_js/highcharts.js"></script>
  	<script src="_js/modules/exporting.js"></script>
  	<script src="_js/modules/export-data.js"></script>
</head>
<body>

	<div id="centro" style="width: 100%;height: 400px;">dgdg</div>

	<script type="text/javascript">
		
		$(document).ready(function(){
			var options = {
				chart: {
					renderTo: 'centro',
					type: 'column'
				},

				series:[{}]
			};

			$.getJSON('Saturday.php', function(data){ 
				options.series[0].data = data;
                
				var chart = new Highcharts.Chart(options);
			});
		}); 



	</script>


<!--Outros detalhes-->
<?php

include_once('DAO/conexao.php');
?>
	<div>
gdgdgd
	
        <h1>estatistica_alunos</h1>
            <table border="1">
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
                

 
	</div>

	<div>
 		<h1>estatitica_vnculo_professor </h1>
            <table border="1">
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
                

  
	</div>
</body>
</html>