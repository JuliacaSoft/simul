<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/ensayo.js"></script>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>          
        
</head>
<body>

    <div class="myformBusqueda" id="stylizedBusqueda">
        
         
        
        <form id="form" name="form" method="get" action="_proxy.php">
            <h1>Registro y Administracion de Ensayos</h1>  
            <p> </p>
            <label for="busqueda">Nombre
                <span class="small"></span>
            </label>
            <input type="search" name="datos" id="datos" results="5"/>
            <input type="hidden" name="controlador" id="controlador" value="Ensayo"/>
            <input type="hidden" name="accion" id="accion" value="formBuscarEnsayo"/>
            <button type="submit">Buscar</button>
            
            <div class="spacer" style="text-align: match-parent;">
                <button type="button" onclick="javascript:showFormEnsayo()">Nuevo</button>
                <button type="button" onclick="location.href='_proxy.php?controlador=Ensayo&accion=listarTwoU'">Listar</button>   
            </div>
        </form>
    </div>    
    
    
    
    <table id="table" class="formTable" width="100%">
	<tr>
		
                <th>#</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>T DepID</th>
                <th>Cantidad Preg</th>
                <th>% Aprob</th>
                <th>Intentos</th>
                <th>Tiempo</th>
                <th>Curso ID</th>
                <th>Opciones</th>

        </tr>
	<?php
        $i=0;
	foreach($ensayo as $item )
	{
	?>
	<tr>
		<td><?php  echo ++$i;?></td>
                
		<td><?php  echo $item['nombre'] ?></td>
		<td><?php  echo $item['tipo_nombre'] ?></td>
                <td><?php  echo $item['nombre_dependencia'] ?></td>
                <td><?php  echo $item['cant_preg'] ?></td>
                <td><?php  echo $item['porc_aprobacion'] ?> %</td>
                <td><?php  echo $item['intento'] ?></td>
                <td><?php  echo $item['tiempo'] ?></td>
                <td><?php  echo $item['nomcurso'] ?></td>
		<td>  
                
                        <button type="button" class="editar" onclick="javascript:showFormEditEnsayo(<?php echo $item['ensayo_id'] ?>,<?php  echo $item['tipo'] ?>)">Editar</button>
                        <button type="button" class="eliminar"  onclick="location.href='_proxy.php?controlador=Ensayo&accion=eliminar&ensayoid=<?php echo $item['ensayo_id']?>'" >Eliminar</button>
                        
                </td>
		
           
	</tr>
	<?php
	}
	?>
</table>
</body>
</html>