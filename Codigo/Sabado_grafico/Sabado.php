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

	<div id="centro" style="width: 100%;height: 400px;"></div>

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
</body>
</html>