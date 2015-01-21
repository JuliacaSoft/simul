<?php
 
function conectarBD(){
            $server = "localhost";
            $usuario = "python";
            $pass = "123456";
            $BD = "simulador";
            //variable que guarda la conexión de la base de datos
            $conexion = mysqli_connect($server, $usuario, $pass, $BD);
            //Comprobamos si la conexión ha tenido exito
            if(!$conexion){
               echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>';
            }
            //devolvemos el objeto de conexión para usarlo en las consultas  
            return $conexion;
    }  
    /*Desconectar la conexion a la base de datos*/
    function desconectarBD($conexion){
            //Cierra la conexión y guarda el estado de la operación en una variable
            $close = mysqli_close($conexion);
            //Comprobamos si se ha cerrado la conexión correctamente
            if(!$close){  
               echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
            }    
            //devuelve el estado del cierre de conexión
            return $close;        
    }
 
    //Devuelve un array multidimensional con el resultado de la consulta
    function getArraySQL($sql){
        //Creamos la conexión
        $conexion = conectarBD();
        //generamos la consulta
        if(!$result = mysqli_query($conexion, $sql)) die();
 
        $rawdata = array();
        //guardamos en un array multidimensional todos los datos de la consulta
        $i=0;
        while($row = mysqli_fetch_array($result))
        {  
            //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
            $rawdata[$i] = $row;
            $i++;
        }
        //Cerramos la base de datos
        desconectarBD($conexion);
        //devolvemos rawdata
        return $rawdata;
    }
 
    //Sentencia SQL
$sql = "SELECT energy,water,temperature,time from tabla;";
//Array Multidimensional
$rawdata = getArraySQL($sql);
 
//Adaptar el tiempo
for($i=0;$i<count($rawdata);$i++){
    $time = $rawdata[$i]["time"];
    $date = new DateTime($time);
    $rawdata[$i]["time"]=$date->getTimestamp()*1000;
}
 
?>