<?php
$con = mysql_connect("localhost","python","123456");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("simulador", $con);

$result = mysql_query("SELECT nombre, gasto FROM persona");

while($row = mysql_fetch_array($result)) {
  echo $row['nombre'] . "\t" . $row['gasto']. "\n";
}

mysql_close($con);
?> 