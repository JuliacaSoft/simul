<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador</title>
            
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>    
        <link rel="stylesheet" type="text/css" href="../../recursos/css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="../../recursos/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/bootstrap-dialog.min.css"></link>
        <script type="text/javascript" src="../../recursos/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="../../recursos/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../recursos/js/bootstrap-dialog.min.js"></script>
        
        <script type="text/javascript" src="../../recursos/ajax/area.js"></script>
        
        <script type="text/javascript" src="../../recursos/js/jquery.autocomplete.js"></script>
        <script type="text/javascript">

            $(function() {
            $("#datos").focus();
                $('#datos').autocomplete("_proxy.php?controlador=Area&accion=formBuscarAreaAuto", {
                    width: "500px",
                    minChars: 2
                }).result(function(event,data) {        	
                });   
            });
 
	</script>
</head>
<body>

    <div class="myformBusqueda" id="stylizedBusqueda">
               
        <form id="form" name="form" method="get" action="_proxy.php">
            <h1>Registro y Administracion de Área de Conocimientos</h1>  
            <p> </p>
            <label for="busqueda">Nombre Área
                <span class="small"></span>
            </label>
            <input type="search" name="datos" id="datos" results="5"/>
            <input type="hidden" name="controlador" id="controlador" value="Area"/>
            <input type="hidden" name="accion" id="accion" value="formBuscarArea"/>
            <button type="submit">Buscar</button>
            <div class="spacer" style="text-align: match-parent;">
                <button type="button" onclick="javascript:showFormArea()">Nuevo</button>
                <button type="button" onclick="location.href='_proxy.php?controlador=Area&accion=listarTwoU'">Listar</button>   
            </div>
        </form>
    </div>    
    
    
    
    <table id="table" class="formTable" width="100%">
	<tr>
		
                <th>#</th>
                
                <th>Nombre</th>
                <th>Peso</th>
                <th>Estado</th>
                <th>Opciones</th>

        </tr>
	<?php
        $i=0;
	foreach($area as $item )
	{
	?>
	<tr>
		<td><?php  echo ++$i;?></td>
		
		<td><?php  echo $item->getNombre() ?></td>
		<td><?php  echo $item->getPeso() ?> %</td>
                <td><?php  echo $item->getEstado() ?></td>
		<td>  
                
                        <button type="button" class="editar" onclick="javascript:showFormEditArea(<?php echo $item->getArea_id()?>)">Editar</button>
                        <button type="button" class="eliminar"  onclick="eliminar(<?php echo $item->getArea_id()?>)" >Eliminar</button>
                        <!-- <button type="button" class="eliminar"  onclick="location.href='_proxy.php?controlador=Area&accion=eliminar&areaid=<?php echo $item->getArea_id()?>'" >Eliminar</button> -->
                        
                </td>
		
           
	</tr>
	<?php
	}
	?>

<script type="text/javascript">
    function eliminar(idArea){
          BootstrapDialog.show({
            message: '<h3>Esta seguro que quiere elimninar el Area! </h3>',
            buttons: [   
             {
                
                label: 'Aceptar',
                cssClass: 'btn-primary',
                icon:'glyphicon glyphicon-ok',
                action:function(dialogItself){
                    location.href='_proxy.php?controlador=Area&accion=eliminar&areaid='+idArea;
                    dialogItself.close();
                }
            }, {
                label: 'Cancelar',
                cssClass:'btn-danger',
                icon: 'glyphicon glyphicon-ban-circle',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
        
    }
  </script>

</table>
</body>
</html>