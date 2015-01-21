<?php
 		session_start();
		$conexion = mysql_connect("localhost","root","");
		mysql_select_db("tarea",$conexion);

		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Soft Unicorn</title>
</head>

<body>
<div align="center">
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="90%" border="0">
  <tr>
    <td>
      <strong>Agregar Archivo de Excel [Productos]</strong>
      
      <input type="file" name="archivo" id="archivo">
      <strong>Desea Actualizar la BD</strong>
      <label><input type="radio" name="radio" value="s" checked />SI</label>
      <label><input type="radio" name="radio" value="n" />NO</label>
      
<input type="submit" name="button" class="btn" id="button" value="Actualizar Base de Datos">
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?php
	if(isset($_POST['radio'])){
		//subir la imagen del articulo
		$nameEXCEL = $_FILES['archivo']['name'];
		$tmpEXCEL = $_FILES['archivo']['tmp_name'];
		$extEXCEL = pathinfo($nameEXCEL);
		$urlnueva = "xls/empleados.xls";			
		if(is_uploaded_file($tmpEXCEL)){
			copy($tmpEXCEL,$urlnueva);	
			echo '<div align="center"><strong>Datos Actualizados con Exito</strong></div>';
		}
		
	}
?>
<table border="1" width="100%">
	<thead>
    	<tr>
        	<th><center><strong>A</strong></center></th>
            <th><center><strong>B</strong></center></th>
            <th><center><strong>C</strong></center></th>
            <th><center><strong>D</strong></center></th>
			<th><center><strong>E</strong></center></th>
			<th><center><strong>F</strong></center></th>
            <th><center><strong>G</strong></center></th>
        </tr>
    	<tr>
        	<th>ID</th>
            <th>NOMBRE</th>
            <th>DIRECCION</th>
            <th>CORREO</th>
			<th>TELEFONO</th>
			<th>OCUPACION</th>
            <th>ESTADO</th>
        </tr>
	</thead>
    <tbody>
  	<?php

		if(isset($_POST['radio'])){
			require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
			
			$objPHPExcel = PHPExcel_IOFactory::load('xls/empleados.xls');
			$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true);
			foreach ($objHoja as $iIndice=>$objCelda) {
	
						echo '
							<tr>
								<td>'.$objCelda['A'].'</td>
								<td>'.$objCelda['B'].'</td>
								<td>'.$objCelda['C'].'</td>
								<td>'.$objCelda['D'].'</td>
								<td>'.$objCelda['E'].'</td>
								<td>'.$objCelda['F'].'</td>
								<td>'.$objCelda['G'].'</td>
							</tr>
						';
				$id=$objCelda['A'];			$nombre=$objCelda['B'];
				$direccion=$objCelda['C'];	$correo=$objCelda['D'];
				$telefono=$objCelda['E'];	$ocupacion=$objCelda['F'];
				$estado=$objCelda['G'];	
									
				if($_POST['radio']=='s'){
			    	$sql="INSERT INTO empleados 
					(id, nombre, direccion, correo, telefono, ocupacion, estado) 
	 					VALUES 													('$id','$nombre','$direccion','$correo','$telefono','$ocupacion','$estado')";
						mysql_query($sql);
				}
					}
			}
	?>
    
    </tbody>
</table>
</div>
</body>
</html>