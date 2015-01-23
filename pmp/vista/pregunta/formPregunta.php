<!DOCTYPE html>
<?php
header('Content-Type: text/html; charset=UTF-8'); 
?>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Formulario de registro de Preguntas</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" href="../web/recursosg/css/upload/bootstrap.min.css"/>
        <!-- Generic page styles -->
        <!-- <link rel="stylesheet" href="../web/recursosg/css/upload/style.css"/>-->
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <link rel="stylesheet" href="../web/recursosg/css/upload/jquery.fileupload.css"/>

    </head>
    <body>

        <div id="stylized" class="myform">
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
  
            <div class="spacer"></div>
            <form id="formInsert" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Preguntas</h1>
                <p>Por favor complete los campos que se requiere <span class="requerido">*</span> </p>

                <label>ID Excel
                    <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <input type="text" name="excel_id" id="excel_id"  />
                <div class="spacer"></div>
                
                <label>Pregunta Español<i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_es" rows="5" cols="50" id="pregunta_es"  ></textarea>
                
                <label>Pregunta Inglés<i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_us" rows="5" cols="50" id="pregunta_us"  ></textarea>
                <div class="spacer"></div>
                
                <label>Imagen Español
                    <span class="small"></span>
                </label>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                                <span>Seleccionar Archivo...</span>
                            <input id="fileupload" type="file" name="files[]" multiple>
                            </span>
                        </div>
                        <div id="progress" class="progress col-md-3">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="imagen_es" id="imagen_es"  />
                            <div class="spacer"></div> 
                        </div> 
                    </div>
                
              <!--  <label>Imagen Español
                    <span class="small"></span>
                </label>
                            <span>
                            <input id="fileupload" type="file" name="files[]" multiple>
                            </span>
                            <input type="text" name="imagen_es" id="imagen_es"  />
                            <div class="spacer"></div> 
                        
                  --> 
                <label>Imagen Inglés
                    <span class="small"></span>
                </label>
                    <div class="row">
                        <div class="col-md-3">
                            <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Seleccionar Archivo...</span>
                            <input id="fileuploadus" type="file" name="files[]" multiple>
                            </span>
                        </div>
                        <div id="progressus" class="progress col-md-3">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="imagen_us" id="imagen_us" />
                            <div class="spacer"></div>
                        </div>
                    </div>    

                  <label id="resid" >Respuesta <i class="requerido">*</i>
                    <span class="small">Seleccione Rpta Correcta</span>
                </label>
                <select name="respuesta" id="respuesta"  >
                    <option value><span>Selecione</span></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>  
                <div class="spacer"></div>
                
                <label>Alternativa A Es <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aes" id="opcion_aes"  ></textarea>
                <label>Alternativa A Us <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aus" id="opcion_aus"  ></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa B Es <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bes" id="opcion_bes"  ></textarea>
                <label>Alternativa B Us <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bus" id="opcion_bus"  ></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa C Es <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_ces" id="opcion_ces"  ></textarea>
                <label>Alternativa C Us <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_cus" id="opcion_cus"  ></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa D Es <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_des" id="opcion_des"  ></textarea>
                <label>Alternativa D Us <i class="requerido">*</i>
                    <span class="small"></span>
                </label>
                <textarea name="opcion_dus" id="opcion_dus"  ></textarea>
                <div class="spacer"></div>
                
                
                
                 <div class="spacer"></div>
                <label>Comentario A Es
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_aes" id="comentario_aes"  />
                <label>Comentario A Us
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_aus" id="comentario_aus" />
                <div class="spacer"></div>
                
                <label>Comentario B Es
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_bes" id="comentario_bes" />
                <label>Comentario B Us
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_bus" id="comentario_bus" />
                <div class="spacer"></div>
                
                <label>Comentario C Es
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_ces" id="comentario_ces" />
                <label>Comentario C Us
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_cus" id="comentario_cus" />
                <div class="spacer"></div>
                
                <label>Comentario D Es
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_des" id="comentario_des" />
                <label>Comentario D Us
                    <span class="small"></span>
                </label>
                <input type="text" name="comentario_dus" id="comentario_dus" />
                <div class="spacer"></div>
                
                <label>Nivel Dificultad
                    <span class="small">Nivel dificultad("1" o "0")</span>
                </label>
                <select name="nivel_dificultad" id=nivel_dificultad"">
                    <option value="">-</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    
                </select>
                <div class="spacer"></div>

                              
                <label>Area de <i class="requerido">*</i> Conocimiento 
                    <span class="small">Selecione</span>
                </label>
                <select  name="area_id" id="area_id"  >
                    <option value>-</option>
                <?php
                $i=0;
                foreach($area as $item )
                {
                ?>                    
                    <option value="<?php echo $item->getArea_id()?>"><?php echo $item->getNombre()?> </option>
                    
                <?php } ?>     
                </select>

                <label>Grupo de Procesos <i class="requerido">*</i>
                    <span class="small">Seleccione</span>
                </label>
                <select  name="grupo_id" id="grupo_id"  >
                    <option value="0">-</option>
                <?php
                $i=0;
                foreach($grupo as $item )
                {
                ?>
                    <option value="<?php echo $item->getGrupo_id()?>"><?php echo $item->getNombre()?> </option>
                    
                <?php } ?>     
                </select>
                
                <div class="spacer"></div> 

                <label>Estado <i class="requerido">*</i>
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado"  >
                    <option value="1">Activo </option>
                    <option value="0">Desactivo</option>
                </select>                              
                <div class="spacer"></div>  
                
                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Pregunta"/>
                <input type="hidden" name="accion" id="accion" value="insertarPregunta"/>
                <button type="submit">Guardar</button>
                <!--<button onclick="EnviarForm()">Guardasr</button>--> 
            </form>
            
            
            
        </div>
    </body>
</html>

<script src="../web/recursosg/js/upload/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="../web/recursosg/js/upload/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../web/recursosg/js/upload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../web/recursosg/js/upload/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="../web/recursosg/js/upload/bootstrap.min.js"></script>
<script src="../../recursos/js/jquery_validate.js"></script>
<script>
    
    $(function(){
       $('#formInsert').validate({
           rules: {
           'excel_id': 'required',
           'respuesta': 'required',
           'area_id': 'required',
           
           
           },
       messages: {
           'excel_id': 'Debe ingresar el id de exel',
           'respuesta': 'Debe seleccionar una opcion',
           'area_id': 'Debe seleccionar una Area',
           
           
       },
       debug: true,
       /*errorElement: 'div',*/
       //errorContainer: $('#errores'),
       submitHandler: function(form){
           form.submit();
       }
    });
});
    
    
    
    function EnviarForm(){
        var estado=validarSelect();
        if(estado){
            $("form").submit();
        }
        else{
            alert("saskask");
            }
    }
    
    function validarSelect(){
        var grupo_id=$("#grupo_id:required");
        var area_id=$("#area_id:required");
        var respuesta=$("#respuesta:required");
        var correcto =true;
        $(grupo_id).each(function (){
            if($(this).val()==0){
                correcto=false;
                $("#resid").addClass("erroneo")
                $(this).addClass('erroneo');
            }
        });
        $(area_id).each(function (){
            if($(this).val()==0){
                correcto=false;
                $(this).addClass('erroneo');
            }
        });
        $(respuesta).each(function (){
            if($(this).val()==0){
                correcto=false;
                $(this).addClass('erroneo');
            }
        });
        return correcto;
  }
    
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'file/';

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<p/>').text(file.name).appendTo('#files');
                $('#imagen_es').val(file.name);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');


    $('#fileuploadus').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<p/>').text(file.name).appendTo('#files');
                $('#imagen_us').val(file.name);
            });
        },
        progressall: function (e, data) {
            var progress2 = parseInt(data.loaded / data.total * 100, 10);
            $('#progressus .progress-bar').css(
                'width',
                progress2 + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>