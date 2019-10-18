Highcharts.chart('containerD', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Progresso Trimestral do aluno'
    },
    subtitle: {
        text: null
    },
    xAxis: {
        categories: [
            'Matematica',
            'Portugues',
            'Ingles',
            'Fisica',
            'Quimica',
            'Historia',
            'Biologia',
            'Geografia',
            'Ed. Visual',
            'DGD',
            'Frances',
            'Tics',
            'Ed. Fisica'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0, max: 20,
        title: {
            text: 'Notas (0-20)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.1,
            borderWidth: 0
        }
    },
    series: [{
        name: '1a Trimestre',
        data: [4, 1.5, 10.4, 12.2, 14.0, 17.0, 13.6, 14.5, 16.4, 19.1, 5.6, 14.4, 11]

    }, {
        name: '2a Trimestre',
        data: [13.6, 7.8, 9.5, 9.4, 6.0, 8.5, 10.0, 10.3, 9.2, 8.5, 10.6, 12.3]

    }, {
        name: '3a Trimestre',
        data: [0.9, 3.8, 9.3, 11.4, 17.0, 18.3, 9.0, 9.6, 12.4, 15.2, 5.3, 11.2, 14]

    }]
});