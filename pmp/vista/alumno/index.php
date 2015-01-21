<html>  
<head>  
<TITLE>Muestra los resultados paginados de una consulta MySQL.</TITLE>  
</head>  

<body>  
<div align='center'>  
  <table border='1' cellpadding='0' cellspacing='0' width='600' bgcolor='#F6F6F6' bordercolor='#FFFFFF'>  
    <tr>  
      <td width='150' style='font-weight: bold'>ID</td>  
      <td width='150' style='font-weight: bold'>NOMBRE</td>  
      <td width='150' style='font-weight: bold'>E-MAIL.</td>  
      <td width='150' style='font-weight: bold'></td>  
    </tr>  
    

<?php 
//abre_conexion.php 
// Parametros a configurar para la conexion de la base de datos 

$hotsdb = "localhost";    // sera el valor de nuestra BD 
$basededatos = "simulador";    // sera el valor de nuestra BD 

$usuariodb = "python";    // sera el valor de nuestra BD 
$clavedb = "123456";    // sera el valor de nuestra BD 



// Fin de los parametros a configurar para la conexion de la base de datos 

$conexion_db = mysql_connect("$hotsdb","$usuariodb","$clavedb") 
    or die ("Conexión denegada, el Servidor de Base de datos que solicitas NO EXISTE"); 
    $db = mysql_select_db("$basededatos", $conexion_db) 
    or die ("La Base de Datos <b>$basededatos</b> NO EXISTE"); 
?> 



<?php 
//cierra_conexion.php 
mysql_close($conexion_db); 
?>
<?php  

$pagi = $_GET['pagi']; 

$contar_pagi = (strlen($pagi));    // Contamos el numero de caracteres 

// Numero de registros por pagina 

$numer_reg = 10; 

//include('abre_conexion.php');  

//$nombre_tabla = $tabla_db1; 

// Contamos los registros totales 

    $query0 = "select sim_resultado_id from sim_resultado where simulacion_id=13";     // Esta linea hace la consulta 
    $result0 = mysql_query($query0);  
    $numero_registros0 = mysql_num_rows($result0);  

   
############################################## 
// ----------------------------- Pagina anterior 
$prim_reg_an = $numer_reg - $pagi; 
$prim_reg_ant = abs($prim_reg_an);        // Tomamos el valor absoluto 

if ($pagi <> 0)  
{  
$pag_anterior = "<a href='index.php?pagi=$prim_reg_ant'>Pagina anterior</a>"; 
} 
// ----------------------------- Pagina siguiente 
$prim_reg_sigu = $numer_reg + $pagi; 

if ($pagi < $numero_registros0 - ($numer_reg - 1))  
{  
$pag_siguiente = "<a href='index.php?pagi=$prim_reg_sigu'>Pagina siguiente</a>"; 
} 
// ----------------------------- Separador 
if ($pagi <> 0 and $pagi < $numero_registros0 - ($numer_reg - 1))  
{  
$separador = "|"; 
} 
// Creamos la barra de navegacion 

$pagi_navegacion = "$pag_anterior $separador $pag_siguiente"; 

// ----------------------------- 
############################################## 

if ($contar_pagi > 0)  
{  
// Si recibimos un valor por la variable $page ejecutamos esta consulta 

    $query = "select * from sim_resultado where simulacion_id=13 LIMIT $pagi,$numer_reg"; 
}  
else  
{  
// Si NO recibimos un valor por la variable $page ejecutamos esta consulta 

    $query = "select * from sim_resultado where simulacion_id=13 LIMIT 0,$numer_reg"; 
}  

    $result = mysql_query($query);  
    $numero_registros = mysql_num_rows($result);  

    while ($registro = mysql_fetch_array($result)){  
echo "  
    <tr>  
      <td width='150'>".$registro['sim_resultado_id']."</td>  
      <td width='150'>".$registro['simulacion_id']."</td>  
      <td width='150'>".$registro['estado']."</td>  
      <td width='150'></td>  

    </tr>  
";  
}  
//include('cierra_conexion.php');  
echo " 
   </table>  
</div> 

<div align='center'>  
  <table border='0' cellpadding='0' cellspacing='0' width='600'> 
    <tr>  
      <td width='600' colspan='4'>&nbsp;</td>  
    </tr> 
    <tr>  
      <td width='600' colspan='4'><p align='right'>Registros: $numero_registros de un total de $numero_registros0</td>  
    </tr> 
   </table>  
</div> 

<p align='center'>$pagi_navegacion</p> 
"; 
?>  
</body>  

</html> 
