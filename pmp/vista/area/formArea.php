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
                <textarea name="descripcion" rows="5" cols="40" id="descripcion" required="required"/>
                <div class="spacer"></div>
                <label>Peso
                    <span class="small">Coloque el peso en %</span>
                </label>
                <input type="text" name="peso" id="peso" onblur="validarPeso();" required="required"/>
                <label id="mensaje">

                </label>

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
                <button  id="enviars"  disabled type="submit">Guardar</button>
            </form>
        </div>
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
        </script>
    </body>
</html>
