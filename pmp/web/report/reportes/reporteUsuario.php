<!DOCTYPE HTML>



<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">

		</style>
		<script type="text/javascript">
<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'python');
define('DB_SERVER_PASSWORD', '123456');
define('DB_DATABASE', 'simulador');

$con = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE, $con);

?>
    
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Usuarios',
            data: [

                <?php $db=new $con ;
                $sql = "select * from persona";
                $que= $db->execute($sql);
                while($row=$db->fetch_row($que)){ ?>;
                    ['<?php echo $row['nombre'] ?>',   <?php echo $row['gasto'] ?>]
                <?php }  ?>
                    
            ]
        }]
    });
});
		</script>
	</head>
      
	<body>
              holas

<script src="../../recursosg/js/highcharts.js"></script>
<script src="../../recursosg/js/highcharts-3d.js"></script>
<script src="../../recursosg/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
	</body>
</html>
