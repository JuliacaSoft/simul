<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Áreas de Conocimientos</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>

    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="formArea" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Áreas de Conocimientos</h1>
                <p>Por favor complete los campos que se requiere </p>

                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre"  />
                <div class="spacer"></div>
                <label>Descripción
                    <span class="small">Ingrese una descripción</span>
                </label>
                <textarea name="descripcion" rows="5" cols="40" id="descripcion" ></textarea>
                <div class="spacer"></div>
                <label>Peso
                    <span class="small">Coloque el peso en %</span>
                </label>
                <input type="text" name="peso" id="peso" onkeyup="validarPeso()"/>
               
                <div id="mensaje" class="mensaje-peso error"></div>
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
                <input type="hidden" name="controlador" id="controlador" value="Area"/>
                <input type="hidden" name="accion" id="accion" value="insertarArea"/>
                <button  id="enviars" type="submit">Guardar</button>
            </form>
        </div>
        <script src="../../recursos/js/jquery_validate.js"></script>
        <script>

    function validarPeso() {
        $.ajax({
            url: "_proxy.php",
            type: "GET",
            data: "controlador=Area&accion=validarAreaPeso&peso=" + $("#peso").val(),
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
       $('#formArea').validate({
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
