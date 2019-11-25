
<script>
    // Aqui fica o codigo que busca e preenche os dados do grafico de Estatistica do Aluno
 <?php include_once('select.php');?>
            Highcharts.chart('container', {
                title: {
                    text: 'Combination chart'
                },
                xAxis: {
                    categories: <?php busca_Classe();?>
                },
                labels: {
                    items: [{
                        html: 'Estatistica dos Alunos da Escola',
                        style: {
                            left: '50px',
                            top: '18px',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
                        }
                    }]
                },
                series: [{
                    type: 'column',
                    name: 'Total Alunos',
                    data: <?php busca_Total_Aluno();?>
                }, {
                    type: 'column',
                    name: 'Total Masculino',
                    data: <?php busca_Total_Aluno_M();?>
                }, {
                    type: 'column',
                    name: 'Total Femenino',
                    data: <?php busca_Total_Aluno_F();?>
                }]
            });

</script>
    