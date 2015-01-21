<?php
 		session_start();
		$conexion = mysql_connect("localhost","python","123456");
		mysql_select_db("simulador",$conexion);

		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carga Masiva - Preguntas</title>
<script type="text/javascript" src="../../../recursos/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../../../recursos/css/forms.css"/>
<link rel="stylesheet" type="text/css" href="../../../recursos/css/formsSearch.css"/>
<link rel="stylesheet" type="text/css" href="../../../recursos/css/listas.css"/>  
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="myformBusqueda" id="stylizedBusqueda">  
    <table width="613" border="0" cellspacing="0" cellpadding="0">    
      <tr>
            <td class="text"><h1>Por favor seleccione el archivo a subir:</h1></td>
            <td>¿Desea Actualizar la DB?</td>
      </tr>
      <tr class="text">
          <form action="" method="post" enctype="multipart/form-data" name="form1"> 
                <td>
                    <input type="file" name="archivo" class="casilla" size="35" id="archivo">
                </td>
              <td >
                    <label><input type="radio" name="radio" value="s"  />SI</label> 
                    <label><input type="radio" name="radio" value="n" checked />NO</label>    
                </td>
              <td width="50">
                  <label></label>
                </td>
              <td>
                  <button name="button" class="btn" id="button"  type="submit">Actualizar DB</button>
              </td>
             </form>
      </tr>
  </table>   
    
</div> 
    
    
<?php
	if(isset($_POST['radio'])){
		//subir la imagen del articulo
		$nameEXCEL = $_FILES['archivo']['name'];
		$tmpEXCEL = $_FILES['archivo']['tmp_name'];
		$extEXCEL = pathinfo($nameEXCEL);
		$urlnueva = "xls/pmp.xls";			
		if(is_uploaded_file($tmpEXCEL)){
			copy($tmpEXCEL,$urlnueva);	
			echo '<div align="center"><strong>Datos Actualizados con Exito</strong></div>';
		}
		
	}
?>
    
<table id="table" class="formTable" width="100%">
	<thead>
    	<tr>
        	<th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>F</th>
                <th>G</th>
                <th>H</th>
                <th>I</th>
                <th>J</th>
                <th>K</th>
                <th>L</th>
                <th>M</th>
                <th>N</th>
                <th>O</th>
                <th>P</th>
                <th>Q</th>
                <th>R</th>
                <th>S</th>
                <th>T</th>
                <th>U</th>
                <th>V</th>
                <th>W</th>
                <th>X</th>
                <th>Y</th>
                <th>Z</th>
        </tr>
    	<tr>
        	<th>ID</th>
                <th>ES</th>
                <th>US</th>
                <th>URL ES</th>
                <th>URL US</th>
                <th>RPT</th>
                <th>Alt AES</th>
                <th>Alt BES</th>
                <th>Alt CES</th>
                <th>Alt DES</th>
                <th>Alt AUS</th>
                <th>Alt BUS</th>
                <th>Alt CUS</th>
                <th>Alt DUS</th>
                <th>Comt AES</th>
                <th>Comt BES</th>
                <th>Comt CES</th>
                <th>Comt DES</th>
                <th>Comt AUS</th>
                <th>Comt BUS</th>
                <th>Comt CUS</th>
                <th>Comt DUS</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th>Área</th>
                <th>Grupo</th>
        </tr>
	</thead>
    <tbody>
  	<?php

		if(isset($_POST['radio'])){
			require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
			
			$objPHPExcel = PHPExcel_IOFactory::load('xls/pmp.xls');
			$objHoja=$objPHPExcel->getActiveSheet()->toArray(true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true,true);
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
                                                                <td>'.$objCelda['H'].'</td>
                                                                <td>'.$objCelda['I'].'</td>
								<td>'.$objCelda['J'].'</td>
								<td>'.$objCelda['K'].'</td>
								<td>'.$objCelda['L'].'</td>
								<td>'.$objCelda['M'].'</td>
								<td>'.$objCelda['N'].'</td>
                                                                <td>'.$objCelda['O'].'</td>
								<td>'.$objCelda['P'].'</td>
								<td>'.$objCelda['Q'].'</td>
								<td>'.$objCelda['R'].'</td>
								<td>'.$objCelda['S'].'</td>
								<td>'.$objCelda['T'].'</td>
								<td>'.$objCelda['U'].'</td>
                                                                <td>'.$objCelda['V'].'</td>
								<td>'.$objCelda['W'].'</td>
								<td>'.$objCelda['X'].'</td>
								<td>'.$objCelda['Y'].'</td>
								<td>'.$objCelda['Z'].'</td>
							</tr>
						';
                                $excel_id=$objCelda['A'];			
                                $pregunta_es=$objCelda['B'];
				$pregunta_us=$objCelda['C'];	
                                $imagen_es=$objCelda['D'];
				$imagen_us=$objCelda['E'];	
                                $respuesta=$objCelda['F'];
				$opcion_aes=$objCelda['G'];	
                                $opcion_bes=$objCelda['H'];
                                $opcion_ces=$objCelda['I'];
				$opcion_des=$objCelda['J'];	
                                $opcion_aus=$objCelda['K'];
				$opcion_bus=$objCelda['L'];	
                                $opcion_cus=$objCelda['M'];
				$opcion_dus=$objCelda['N'];
                                $comentario_aes=$objCelda['O'];			
                                $comentario_bes=$objCelda['P'];
				$comentario_ces=$objCelda['Q'];	
                                $comentario_des=$objCelda['R'];
				$comentario_aus=$objCelda['S'];	
                                $comentario_bus=$objCelda['T'];
				$comentario_cus=$objCelda['U'];
                                $comentario_dus=$objCelda['V'];			
                                $nivel_dificultad=$objCelda['W'];
				$estado=$objCelda['X'];	
                                $area_id=$objCelda['Y'];
				$grupo_id=$objCelda['Z'];
                                               	
									
				if($_POST['radio']=='s'){
			    	$sql="INSERT INTO pregunta
					(excel_id, pregunta_es, pregunta_us, imagen_es, imagen_us, respuesta, opcion_aes, opcion_bes, opcion_ces, opcion_des, opcion_aus, opcion_bus, opcion_cus, opcion_dus, comentario_aes, comentario_bes, comentario_ces, comentario_des, comentario_aus, comentario_bus, comentario_cus, comentario_dus, nivel_dificultad, estado, area_id, grupo_id) 
	 					VALUES 	('$excel_id','$pregunta_es','$pregunta_us','$imagen_es','$imagen_us','$respuesta','$opcion_aes','$opcion_bes','$opcion_ces','$opcion_des','$opcion_aus','$opcion_bus','$opcion_cus','$opcion_dus','$comentario_aes','$comentario_bes','$comentario_ces','$comentario_des','$comentario_aus','$comentario_bus','$comentario_cus','$comentario_dus','$nivel_dificultad','$estado','$area_id','$grupo_id')";
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