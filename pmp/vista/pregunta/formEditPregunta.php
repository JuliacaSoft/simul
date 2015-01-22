<!DOCTYPE html>
<?php
header('Content-Type: text/html; charset=UTF-8'); 

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Preguntas</h1>
                <p>Por favor complete los campos que se requiere </p>

                <?php foreach($pregunta as $pre ) {?>
                
                <label>ID Excel
                    <span class="small"></span>
                </label>
                <input type="text" name="excel_id" id="excel_id" required="required" value="<?php echo $pre->getExcel_id() ?>" />
                <div class="spacer"></div>
                
                <label>Pregunta Español
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_es" id="pregunta_es" rows="5" cols="40" required="required"><?php echo $pre->getPregunta_es() ?></textarea>
                
                
                <label>Pregunta Inglés
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_us" id="pregunta_us" rows="5" cols="40" required="required"><?php echo $pre->getPregunta_us() ?></textarea>
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
                            <input type="text" name="imagen_es" id="imagen_es" value="<?php echo $pre->getImagen_es() ?>"/>
                            <div class="spacer"></div> 
                        </div> 
                    </div>
                
                
                                
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
                            <input type="text" name="imagen_us" id="imagen_us" value="<?php echo $pre->getImagen_us() ?>"/>
                            <div class="spacer"></div>
                        </div>
                    </div>
                
                <label>Respuesta
                    <span class="small">Coloque Respuesta</span>
                </label>
                <select name="respuesta" id="respuesta" required="required">
                    <option value="A" <?php if($pre->getRespuesta()=="A") echo 'selected="selected"'; ?> >A</option>
                    <option value="B" <?php if($pre->getRespuesta()=="B") echo 'selected="selected"'; ?> >B</option>
                    <option value="C" <?php if($pre->getRespuesta()=="C") echo 'selected="selected"'; ?> >C</option>
                    <option value="D" <?php if($pre->getRespuesta()=="D") echo 'selected="selected"'; ?> >D</option>
                </select> 
                <div class="spacer"></div>
                
                                
                <label>Alternativa A Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aes" id="opcion_aes" required="required"><?php echo $pre->getOpcion_aes() ?></textarea>
                <label>Alternativa A Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aus" id="opcion_aus" required="required"><?php echo $pre->getOpcion_aus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa B Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bes" id="opcion_bes" required="required"><?php echo $pre->getOpcion_bes() ?></textarea>
                <label>Alternativa B Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bus" id="opcion_bus" required="required"><?php echo $pre->getOpcion_bus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa C Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_ces" id="opcion_ces" required="required"><?php echo $pre->getOpcion_ces() ?></textarea>
                <label>Alternativa C Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_cus" id="opcion_cus" required="required"><?php echo $pre->getOpcion_cus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Alternativa D Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_des" id="opcion_des" required="required"><?php echo $pre->getOpcion_des() ?></textarea>
                <label>Alternativa D Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_dus" id="opcion_dus" required="required"><?php echo $pre->getOpcion_dus() ?></textarea>
                <div class="spacer"></div>
                
                
                
                 <div class="spacer"></div>
                <label>Comentario A Es
                    <span class="small"></span>
                </label>
                <textarea name="comentario_aes" id="comentario_aes"><?php echo $pre->getComentario_aes() ?></textarea>
                <label>Comentario A Us
                    <span class="small"></span>
                </label>
                <textarea name="comentario_aus" id="comentario_aus"><?php echo $pre->getComentario_aus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Comentario B Es
                    <span class="small"></span>
                </label>
                <textarea name="comentario_bes" id="comentario_bes"><?php echo $pre->getComentario_bes() ?></textarea>
                <label>Comentario B Us
                    <span class="small"></span>
                </label>
                <textarea name="comentario_bus" id="comentario_bus"><?php echo $pre->getComentario_bus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Comentario C Es
                    <span class="small"></span>
                </label>
                <textarea name="comentario_ces" id="comentario_ces"><?php echo $pre->getComentario_ces() ?></textarea>
                <label>Comentario C Us
                    <span class="small"></span>
                </label>
                <textarea name="comentario_cus" id="comentario_cus"><?php echo $pre->getComentario_cus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Comentario D Es
                    <span class="small"></span>
                </label>
                <textarea name="comentario_des" id="comentario_des"><?php echo $pre->getComentario_des() ?></textarea>
                <label>Comentario D Us
                    <span class="small"></span>
                </label>
                <textarea name="comentario_dus" id="comentario_dus"><?php echo $pre->getComentario_dus() ?></textarea>
                <div class="spacer"></div>
                
                <label>Nivel Dificultad
                    <span class="small">Nivel dificultad("1" o "0")</span>
                </label>
                <input type="text" name="nivel_dificultad" id="nivel_dificultad" value="<?php echo $pre->getNivel_dificultad() ?>"/>
                <div class="spacer"></div>
                 
                
                <label>Area de Conocimiento
                    <span class="small">Seleccione</span>
                </label>
                <select  name="area_id" id="area_id">
                    <option value="0">-</option>
                <?php
                $i=0;
                foreach($area as $item )
                {
                ?>                    
                    <option value="<?php echo $item->getArea_id()?>" <?php if($item->getArea_id()==$pre->getArea_id()) echo 'selected="selected"'; ?> ><?php echo $item->getNombre()?> </option>
                <?php } ?>     
                </select>


                <label>Grupo de Procesos
                    <span class="small">Seleccione</span>
                </label>
                <select  name="grupo_id" id="grupo_id">
                    <option value="0">-</option>
                <?php
                $i=0;
                foreach($grupo as $item )
                {
                ?>   
                    <option value="<?php echo $item->getGrupo_id()?>" <?php if($item->getGrupo_id()==$pre->getGrupo_id()) echo 'selected="selected"'; ?> > <?php echo $item->getNombre()?> </option>
                <?php } ?>     
                </select>
                <div class="spacer"></div> 
                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    <option value="1" <?php if($pre->getEstado()=="1") echo 'selected="selected"'; ?> >Activo </option>
                    <option value="0" <?php if($pre->getEstado()=="0") echo 'selected="selected"'; ?> >Desactivo</option>
                </select>                              
                <div class="spacer"></div>  
                

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Pregunta"/>
                <input type="hidden" name="accion" id="accion" value="actualizaPregunta"/>
                <input type="hidden" name="preguntaid" id="preguntaid" value="<?php echo $pre->getPregunta_id() ?>"/>
                
                
                <button type="submit">Guardar</button>
               
                <?php }?>
                 
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

<script>
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