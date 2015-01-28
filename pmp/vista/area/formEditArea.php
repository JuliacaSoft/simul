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
            <form id="formEditArea" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Áreas de Conocimientos</h1>
                <p>Por favor complete los campos que se requiere </p>

                <?php foreach($area as $ar ) {?>
                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $ar->getNombre() ?>" />
                <div class="spacer"></div>
                <label>Descripción
                    <span class="small">Coloque una descripción</span>
                </label>
                <textarea name="descripcion" id="descripcion" rows="5" cols="40" ><?php echo $ar->getDescripcion(); ?></textarea>
                <div class="spacer"></div>
                
                <label>Peso
                    <span class="small">Coloque el peso en %</span>
                </label>
                <input type="text" name="peso" id="peso" onkeyup="validarPeso();"  value="<?php echo $ar->getPeso() ?>"/>
                <div id="mensaje" class="error">

                </div>
                <div class="spacer"></div>
                                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    
                    <option value="1" <?php if($ar->getEstado()=="1") echo 'selected="selected"'; ?> >Activo </option>
                    <option value="0" <?php if($ar->getEstado()=="0") echo 'selected="selected"'; ?> >Desactivo</option>
                </select>                              
                <div class="spacer"></div>  

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Area"/>
                <input type="hidden" name="accion" id="accion" value="actualizaArea"/>
                <input type="hidden" name="areaid" id="areaid" value="<?php echo $ar->getArea_id() ?>"/>
                <button  id="enviars"  type="submit">Guardar</button>
                <!--<button type="submit">Guardar</button>-->
               
                <?php }?>
                 
            </form>
        </div>
        <script src="../../recursos/js/jquery_validate.js"></script>
        <script>

            function validarPeso() {

                $.ajax({
                    url: "_proxy.php",
                    type: "GET",
                    data: "controlador=Area&accion=validarAreaPesoEdit&peso=" + $("#peso").val()+"&areaid="+$("#areaid").val(),
                    success: function(r) {
                        $("#mensaje").html(r);
                        dato = $("#correct").val();

                        if (dato == 1) {
                            $("#enviars").removeAttr("disabled");
                        }
                        if (dato == 0) {
                            $("#enviars").attr("disabled", "disabled");
                        }
                    }
                });
            }
            
            $(function(){
       $('#formEditArea').validate({
           rules: {
           'nombre': 'required',
           'descripcion': 'required',
           'peso': 'number required',
           
           
           
           },
       messages: {
           'nombre': 'Debe ingresar el Nombre',
           'descripcion': 'Debe seleccionar una opcion',
           'peso': 'Debe ser numero y este dato es requerido',
           
           
           
       },
       debug: true,
       /*errorElement: 'div',*/
       //errorContainer: $('#errores'),
       submitHandler: function(form){
           form.submit();
       }
    });
});
            
            
        </script>
    </body>
</html>