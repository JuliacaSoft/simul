<?php
$con = mysql_connect("localhost","python","123456");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("simulador", $con);

$result = mysql_query("SELECT nombre, gasto FROM persona");

$rows = array();
while($r = mysql_fetch_array($result)) {
	$row[0] = $r[0];
	$row[1] = $r[1];
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);

mysql_close($con);
?> 
