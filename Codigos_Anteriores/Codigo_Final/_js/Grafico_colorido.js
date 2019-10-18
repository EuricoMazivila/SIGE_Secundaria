var chart = Highcharts.chart('containerCol', {

    title: {
        text: 'Quantidade de alunos por anos'
    },

    subtitle: {
        text: 'Plain'
    },

    xAxis: {
        categories: ['2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019']
    },

    series: [{
        type: 'column',
        colorByPoint: true,
        data: [3000, 3000, 2500, 8000, 5000, 6000, 4000, 5500, 3000, 6200, 9000, 2900],
        showInLegend: false
    }]

});


$('#plain').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: false
        },
        subtitle: {
            text: 'Plain'
        }
    });
});

$('#inverted').click(function () {
    chart.update({
        chart: {
            inverted: true,
            polar: false
        },
        subtitle: {
            text: 'Inverted'
        }
    });
});

$('#polar').click(function () {
    chart.update({
        chart: {
            inverted: false,
            polar: true
        },
        subtitle: {
            text: 'Polar'
        }
    });
});
