Highcharts.chart('containerP', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },

    title: {
        text: 'Situação de professores'
    },

 
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Em falta',
            y: 15,
            sliced: true,
            selected: true
        }, {
            name: 'Efectivos',
            y:20
        }, {
            name: 'Contratados',
            y: 10
        }]
    }]
});