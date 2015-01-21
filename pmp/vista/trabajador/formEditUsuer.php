
<!DOCTYPE html>
<?php


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Usuarios</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Usuarios</h1>
                <p>Por favor complete los campos que se requiere </p>

                <?php foreach($usuario as $u ) {?>
                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" required="required" value="<?php echo $u->getNombre() ?>" />
                <div class="spacer"></div>
                <label>Apellidos
                    <span class="small">Coloque ambos apellidos</span>
                </label>
                <input type="text" name="apellidos" id="apellidos" required="required"  value="<?php echo $u->getApellidos() ?>"/>
                <div class="spacer"></div>
                <label>Username
                    <span class="small">Coloque su usuario</span>
                </label>
                <input type="text" name="usuario" id="usuario" required="required"/>
                <div class="spacer"></div>
                <label>Clave
                    <span class="small">Coloque su clave de acceso al sistema</span>
                </label>
                <input type="password" name="clave" id="clave" required="required"/>
                
                <label>Nuevamente Clave
                    <span class="small">Coloque su clave anterior</span>
                </label>
                <input type="password" name="newclave" id="newclave" required="required"/>                                
                <div class="spacer"></div>                
                
                <label>Rol
                    <span class="small">Seleccione un rol</span>
                </label>
                <select  name="role" id="role">
                <?php
                $i=0;
                foreach($roles as $item )
                {
                ?>                    
                    <option value="<?php echo $item->getRole()?>"><?php echo $item->getNombre()?> </option>
                    
                <?php } ?>     
                </select>
                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    <option value="1">Activo </option>
                    <option value="0">Desactivo</option>
                </select>                              
                <div class="spacer"></div>  

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Usuario"/>
                <input type="hidden" name="accion" id="accion" value="actualizaUsuario"/>
                <input type="hidden" name="usuarioid" id="usuarioid" value="<?php echo $u->getUsuario_id() ?>"/>
                <button type="submit">Guardar</button>
                <?php }?>
            </form>
        </div>
    </body>
</html>