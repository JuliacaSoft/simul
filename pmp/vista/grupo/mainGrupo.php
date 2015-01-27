<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador</title>
            
        <link href="../../../recursos/confir/css/page.css" rel="stylesheet"/>
        <link href="../../../recursos/confir/alert/css/alert.css" rel="stylesheet"/> <!-- Estilo al popup-->
        <link href="../../../recursos/confir/alert/themes/default/theme.css" rel="stylesheet"/> <!-- No sale popup-->
        <script src="../../../recursos/confir/js/jqueryS.js"></script> 
        <!--<script src="js/jquery-ui.js"></script>-->
        <script src="../../../recursos/confir/alert/js/alert.js"></script>
        <script src="../../../recursos/confir/js/page.js"></script>
        
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/grupo.js"></script>
        <script type="text/javascript" src="../../recursos/js/jquery.autocomplete.js"></script> 

        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>    
        <link rel="stylesheet" type="text/css" href="../../recursos/css/jquery.autocomplete.css" />
        
	<script type="text/javascript">

            $(function() {
            $("#datos").focus();
                $('#datos').autocomplete("_proxy.php?controlador=Grupo&accion=formBuscarGrupoAuto", {
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
            <h1>Registro y Administracion de Grupos de Procesos</h1>  
            <p> </p>
            <label for="busqueda">Nombre
                <span class="small"></span>
            </label>
            <input type="search" name="datos" id="datos" results="5"/>
            <input type="hidden" name="controlador" id="controlador" value="Grupo"/>
            <input type="hidden" name="accion" id="accion" value="formBuscarGrupo"/>
            <button type="submit">Buscar</button>
            <div class="spacer" style="text-align: match-parent;">
                <button type="button" onclick="javascript:showFormGrupo()">Nuevo</button>
                <button type="button" onclick="location.href='_proxy.php?controlador=Grupo&accion=listarTwoU'">Listar</button>   
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
	foreach($grupo as $item )
	{
	?>
	<tr>
		<td><?php  echo ++$i;?></td>
		
		<td><?php  echo $item->getNombre() ?></td>
		<td><?php  echo $item->getPeso() ?> %</td>
                <td><?php  echo $item->getEstado() ?></td>
		<td>  
                
                        <button type="button" class="editar" onclick="javascript:showFormEditGrupo(<?php echo $item->getGrupo_id()?>)">Editar</button>
                        <button class="eliminar" onclick="eliminar(<?php echo $item->getGrupo_id()?>)" >Eliminar</button>
                        <!-- <button type="button" class="eliminar"  onclick="location.href='_proxy.php?controlador=Grupo&accion=eliminar&grupoid=<?php echo $item->getGrupo_id()?>'" >Eliminar</button> -->
                        
                </td>
		
           
	</tr>
        
                
	<?php
	}
	?>
</table>
</body>
    
<div id="page">

                <button onclick="eliminargrupo(1)" class="button blue">Eliminar</button>
                <button onclick="eliminargrupo(2)" class="button blue">Boton</button>
                <a href="#demo-callback_confirm" class="button blue">Ver</a>
                <button href="#demo-callback_confirm" class="button blue">Ver</button>
       
</div>
    
</html>  


<script type="text/javascript">
    function eliminar(id_grupo){
          BootstrapDialog.show({
            title: '¡Información!',
            message: '<h4>¿Esta seguro que desea eliminar?</h4>',
            buttons: [   
             {
                
                label: 'Aceptar',
                cssClass: 'btn-primary',
                icon:'glyphicon glyphicon-ok',
                action:function(dialogItself){
                    location.href='_proxy.php?controlador=Grupo&accion=eliminar&grupoid='+id_grupo;
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
<script>
    function eliminargrupo(dato){
        if(dato==1){
               // $.alert.open({ content: 'Lorem ipsum dolor sit amet' }); 
            $.alert.open('confirm', 'Lorem ipsum dolor sit amet?', function(button) {
                        if (button == 'yes')
                            $.alert.open('You pressed the "Yes" button.');
                        else if (button == 'no')
                            $.alert.open('You pressed the "No" button.');
                        else
                            $.alert.open('Alert was canceled.');
                    });

        }if (dato==2){
            alert("I am an alert box!");

        }
         
    }
    
</script>
        

