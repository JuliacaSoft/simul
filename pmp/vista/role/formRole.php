<!DOCTYPE html>
<?php


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Áreas de Conocimientos</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Áreas de Conocimientos</h1>
                <p>Por favor complete los campos que se requiere </p>

                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" required="required" />
                <div class="spacer"></div>
                <label>Descripción
                    <span class="small">Ingrese una descripción</span>
                </label>
                <input type="text" size=33 name="descripcion" id="descripcion" required="required"/>
                <div class="spacer"></div>
                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    <option value="1">Activo </option>
                    <option value="0">Desactivo</option>
                </select>                              
                <div class="spacer"></div>  

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Role"/>
                <input type="hidden" name="accion" id="accion" value="insertarRole"/>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </body>
</html>
