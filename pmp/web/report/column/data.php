<?php
require_once "../../../util/sql/SqlQuery.php";
require_once "../../../util/sql/QueryExecutor.php";

	$sql = "SELECT nombre, cant_preg FROM ensayo";
    $sqlQuery=new SqlQuery($sql);
    $respuesta=QueryExecutor::execute($sqlQuery);

 
$category = array();
$category['name'] = 'nombre';

$series1 = array();
$series1['name'] = 'cantidad';


for($i=0;$i<count($respuesta);$i++){
   	$category['data'][]=$respuesta[$i]['nombre'];
   	$series1['data'][]=$respuesta[$i]['cant_preg'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);

print json_encode($result, JSON_NUMERIC_CHECK);

?> 