
Highcharts.chart('containerB', {
          chart: {
            type: 'column'
          },

          title: {
            text: 'Distribuição de alunos por classe'
          },

          xAxis: {
            categories: [
              '8a',
              '9a',
              '10a',
              '11a',
              '12a',
            ],

            crosshair: true
          },

          yAxis: {
            min: 0,
            title: {
              text: 'Número de alunos'
            }
          },

          tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
          },

          plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
            }
          },

          series: [
            {name: 'Masculino',
            data: [490, 717, 406, 529, 644]
            },

            {name: 'Feminino',
            data: [873, 784, 908, 953, 806]
            }
          ]
        });


