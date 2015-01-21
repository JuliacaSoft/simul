<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>How to add min and max thresholds in Highcharts</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Nivel de aprendizaje en Área de Conocimiento',
            },
            subtitle: {
                text: 'Rangos de aceptación',
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Simulación'
                },
                plotLines: [{
                    id: 'limit-min',
                    color: '#FF0000',
                    dashStyle: 'ShortDash',
                    width: 2,
                    value: 22000,
                    zIndex: 0,
                    label : {
						text : 'Control - Mínimo'
					}
                }, {
                    id: 'limit-max',
                    color: '#008000',
                    dashStyle: 'ShortDash',
                    width: 2,
                    value: 30000,
                    zIndex: 0,
                    label : {
						text : 'Control - Máximo'
					}
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': $'+ this.y;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Revenue',
                data: [21000, 24000, 27500, 33000, 29000, 26000, 19000, 21000, 25000, 29000, 23000, 18000]
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
