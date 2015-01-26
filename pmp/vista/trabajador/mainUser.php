<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="../../recursos/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/usuario.js"></script>
        
	<script type="text/javascript" src="../../recursos/js/jquery.autocomplete.js"></script>        
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/> 
        <link rel="stylesheet" type="text/css" href="../../recursos/css/jquery.autocomplete.css" />
        <link rel="stylesheet" type="text/css" href="../../recursos/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/bootstrap-dialog.min.css"></link>
        <script type="text/javascript" src="../../recursos/js/bootstrap-dialog.min.js"></script>
	<script type="text/javascript">

            $(function() {
            $("#datos").focus();
                $('#datos').autocomplete("_proxy.php?controlador=Usuario&accion=formBuscarUserAuto", {
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
            <h1>Registro y Administracion de Usuarios</h1>  
            <p> </p>
            <label for="busqueda">Nombre
                <span class="small"></span>
            </label>
            <input type="search" name="datos" id="datos" results="5"/>
            <input type="hidden" name="controlador" id="controlador" value="Usuario"/>
            <input type="hidden" name="accion" id="accion" value="formBuscarUser"/>
            <button type="submit">Buscar</button>
            <div class="spacer" style="text-align: match-parent;">
                <button type="button" onclick="javascript:showFormUser()">Nuevo</button>
                <button type="button" onclick="location.href='_proxy.php?controlador=Usuario&accion=listarTwoU'">Listar</button>   
            </div>
        </form>
    </div>    
    
    
    
    <table id="table" class="formTable" width="100%">
	<tr>
		
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Opciones</th>

        </tr>
	<?php
        $i=0;
	foreach($usuario as $item )
	{
	?>
	<tr>
		<td><?php  echo ++$i;?></td>
		<td><?php  echo $item->getNombre() ?></td>
		<td><?php  echo $item->getApellidos() ?></td>
		<td>  
                
                        <button type="button" class="editar" onclick="javascript:showFormEditUser(<?php echo $item->getUsuario_id()?>)">Editar</button>
                        <button class="eliminar" onclick="eliminar(<?php echo $item->getUsuario_id()?>)" >Eliminar</button>
                        <!-- <button type="button" class="eliminar"  onclick="pregunta()">Eliminar</button> -->
                        
                </td>
		
           
	</tr>
	<?php
	}
	?>

<script language="JavaScript"> 
function pregunta(){ 
    if (confirm('¿Estas seguro de Eliminar el Registro?')){ 
       location.href='_proxy.php?controlador=Usuario&accion=eliminar&usuarioid=<?php echo $item->getUsuario_id()?>';
    }
    return false;
} 


</script>
<script type="text/javascript">
    function eliminar(id_usuario){
          BootstrapDialog.show({
            message: '<h4>¿Esta seguro que desea eliminar?</h4>',
            buttons: [   
             {
                
                label: 'Aceptar',
                cssClass: 'btn-primary',
                icon:'glyphicon glyphicon-ok',
                action:function(dialogItself){
                    location.href='_proxy.php?controlador=Usuario&accion=eliminar&usuarioid='+id_usuario;
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