
    Highcharts.chart('containerT', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Distribuicao de Alunos por turno'
    },
    subtitle: {
        text: null
    },
    xAxis: {
        categories: ['12a', '11a', '10a', '9a', '8a'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Alunos',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: null
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Diurno',
        data: [1707, 1516, 1935, 1003, 900]
    },  {
        name: 'Noturno',
        data: [121, 300, 436, 338, 240]
    }]
});