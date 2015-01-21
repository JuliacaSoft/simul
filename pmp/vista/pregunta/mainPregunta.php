<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Preguntas - Simulador PMP</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/pregunta.js"></script>
        
        <script type="text/javascript" src="../../recursos/js/jquery.autocomplete.js"></script> 
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/jquery.autocomplete.css" />
        
        <script type="text/javascript">

            $(function() {
            $("#datos").focus();
                $('#datos').autocomplete("_proxy.php?controlador=Pregunta&accion=formBuscarPreguntaAuto", {
                    width: "600px",
                    minChars: 2
                }).result(function(event,data) {        	
                });   
            });
 
	</script>
        
</head>
<body>

    <div class="myformBusqueda" id="stylizedBusqueda">
               
        <form id="form" name="form" method="get" action="_proxy.php">
            <h1>Registro y Administracion de Preguntas</h1>  
            <p> </p>
            <label for="busqueda">Nombre
                <span class="small"></span>
            </label>
            <input type="search" name="datos" id="datos" results="5"/>
            <input type="hidden" name="controlador" id="controlador" value="Pregunta"/>
            <input type="hidden" name="accion" id="accion" value="formBuscarPregunta"/>
            <button type="submit">Buscar</button>
            <div class="spacer" style="text-align: match-parent;">
                
                <button type="button" onclick="javascript:showFormPreguntax()">Nuevo</button>
                <button type="button" onclick="location.href='_proxy.php?controlador=Pregunta&accion=listarTwoU'">Listar</button>   
            </div>
        </form>
    </div>    
    
    
    
    <table id="table" class="formTable" width="100%">
	<tr>
		
                <th>#</th>
                
                <th>Id Excel</th>
                <th>Pregunta Español</th>
                <th>Nivel Dificultad</th>
                <th>Grupo de Proceso</th>
                <th>Área de Conocimiento</th>
                <th>Estado</th>
                <th>Opciones</th>

        </tr>
	<?php
        $i=0;
	foreach($pregunta as $item )
	{
	?>
	<tr>
		<td><?php  echo ++$i;?></td>
		
                <td><?php  echo $item['excel_id'] ?></td>
		        <td><?php  echo $item['pregunta_es'] ?></td>
		        <td><?php  echo $item['nivel_dificultad'] ?></td>
                <td><?php  echo $item['proceso'] ?></td>
                <td><?php  echo $item['nombre'] ?></td>
                <td><?php  echo $item['estado'] ?></td>
		<td>  
                
                        <button type="button" class="editar" onclick="javascript:showFormEditPregunta(<?php echo $item['pregunta_id']?>)">Editar</button>
                        <button type="button" class="eliminar"  onclick="location.href='_proxy.php?controlador=Pregunta&accion=eliminar&preguntaid=<?php echo $item['pregunta_id']?>'" >Eliminar</button>
                </td>
	
    </tr>
	<?php
	}
	?>
</table>
</body>
</html>
<script type="text/javascript">
    function showFormPreguntax(){    
     
        $.ajax({
            url: "pregunta/formPregunta.php",
            success: function(r){                 
                $("#table").html("");
                $("#table").html(r);
            }           
         });   
    }
</script>