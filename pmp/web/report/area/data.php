<?php
$con = mysql_connect("localhost","python","123456");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("simulador", $con);

$query = mysql_query("SELECT nombre, gasto FROM persona");

$category = array();
$category['name'] = 'Nombres';

$series1 = array();
$series1['name'] = 'Inicio';



while($r = mysql_fetch_array($query)) {
    $category['data'][] = $r['nombre'];
    $series1['data'][] = $r['gasto'];
    
}

$result = array();
array_push($result,$category);
array_push($result,$series1);

print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?> 
