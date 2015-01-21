
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/simulador.js"></script>
        
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/> 
</head>
        
<body>  
  
<table id="table" class="formTable" width="100%">
	<tr>
		
                <th>#</th>
                <th>Curso</th>
                <th>Nombre test</th>
                <th>Tiempo</th>
                <th>Cant. Pregunta</th>
                <th>Cant. Intento</th>
                <th>Opciones</th>

        </tr>
	<?php
        $r=0;
	for ($i = 0; $i < count($cursos); $i++) {
	
	?>
	<tr>
		<td><?php  echo ++$r;?></td>
		<td><?php  echo $cursos[$i]['curso'] ?></td>
		<td><?php  echo $cursos[$i]['nombre'] ?></td>
		<td><?php  echo $cursos[$i]['tiempo'] ?> Min.</td>
		<td><?php  echo $cursos[$i]['cant_preg'] ?></td>
		<td><?php  echo $cursos[$i]['intento'] ?></td>
                <td><?php  echo $cursos[$i]['simulacion_id'] ?></td>
		<td>  
                
                    <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=listarPreguntasTer&simulacion_id='+<?php  echo $cursos[$i]['simulacion_id'] ?>">Ver Examen </button>               
                    <!--<a href="../web/report/alumno/mainAlumnoPregTerm.php"> Ver Prueba</a>-->
                </td>
		
           
	</tr>
	<?php
	}
	?>
        

        
</table>    
    
 
</body>
</html>