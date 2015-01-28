
<!DOCTYPE html>
<?php


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de campañas</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="formUsuario" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Usuarios</h1>
                <p>Por favor complete los campos que se requiere </p>
                <label for="nombre">Nombre: 
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre"  />
                <div class="spacer"></div>
                <label for="apellidos">Apellidos
                    <span class="small">Coloque ambos apellidos</span>
                </label>
                <input type="text" name="apellidos" id="apellidos" />
                <div class="spacer"></div>
                <label for="usuario">Username
                    <span class="small">Coloque su usuario</span>
                </label>
                <input type="text" name="usuario" id="usuario" />
                <div class="spacer"></div>
                <label>Clave
                    <span class="small">Coloque su clave de acceso al sistema</span>
                </label>
                <input type="password" name="clave" id="clave" />
                
                <label for="newclave">Nuevamente Clave
                    <span class="small">Coloque su clave anterior</span>
                </label>
                <input type="password" name="newclave" id="newclave"/>                                
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
                <input type="hidden" name="accion" id="accion" value="insertarUseuario"/>
                <button type="submit">Guardar</button>
            </form>
        </div>
        
         <script src="../../recursos/js/jquery_validate.js"></script>
        <script>
         $(function(){
       $('#formUsuario').validate({
           rules: {
           'nombre': 'required',
           'apellidos': 'required',
           'usuario': 'required',
           'clave': 'required',
           'newclave': 'required',
           
           
           },
       messages: {
          'nombre': 'wewew',
           'apellidos': 'reqwewuired',
           'usuario': 'wew',
           'clave': 'wew',
           'newclave': 'rwwewequired',     
       },
       debug: true,
       /*errorElement: 'div',*/
       //errorContainer: $('#errores'),
       submitHandler: function(form){
           form.submit();
       }
    });
});
    </body>
</html>
