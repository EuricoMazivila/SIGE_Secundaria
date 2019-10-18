Highcharts.chart('containerG', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Estatistica de Alunos Matriculados e em falta'
    },
    xAxis: {
        categories: ['12a', '11a', '10a', '9a', '8a']
    },
    yAxis: {
        min: 0, max: 315,
        title: {
            text: 'Total de vagas disponivel'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [{
        name: 'Alunos Matriculados',
        data: [225, 123, 314, 127, 315]
    }, {
        name: 'Vagas disponiveis',
        data: [12, 5, 10, 4, 1]
    }]
});