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
    </head>
    <body>

        <div id="stylized" class="myform">
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <!--
            <form action="uploader.php" method="POST" enctype="multipart/form-data">
                <label for="imagen">Imagen:
                    <span class="small"></span>
                </label>
                    <input type="file" name="imagen_es" id="imagen_es" />
                    <input type="submit" name="subir" value="Subir"/>
            </form>
            -->
            <div class="spacer"></div>
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Preguntas</h1>
                <p>Por favor complete los campos que se requiere </p>

                <label>ID Excel
                    <span class="small"></span>
                </label>
                <input type="text" name="excel_id" id="excel_id" required="required" />
                <div class="spacer"></div>
                
                <label>Pregunta Español
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_es" rows="5" cols="50" id="pregunta_es" required="required"/>
                
                <label>Pregunta Inglés
                    <span class="small"></span>
                </label>
                <textarea name="pregunta_us" rows="5" cols="50" id="pregunta_us" required="required"/>
                <div class="spacer"></div>
                
                <label>Imagen Español
                    <span class="small"></span>
                </label>
                <input type="text" name="imagen_es" id="imagen_es"  />
                <label>Imagen Inglés
                    <span class="small"></span>
                </label>
                <input type="text" name="imagen_us" id="imagen_us" />
                <div class="spacer"></div>
                
                <label>Respuesta
                    <span class="small">Seleccione Rpta Correcta</span>
                </label>
                <select name="respuesta" id="respuesta">
                    <option value="0"></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>  
                <div class="spacer"></div>
                
                <label>Alternativa A Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aes" id="opcion_aes" required="required"/>
                <label>Alternativa A Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_aus" id="opcion_aus" required="required"/>
                <div class="spacer"></div>
                
                <label>Alternativa B Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bes" id="opcion_bes" required="required"/>
                <label>Alternativa B Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_bus" id="opcion_bus" required="required"/>
                <div class="spacer"></div>
                
                <label>Alternativa C Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_ces" id="opcion_ces" required="required"/>
                <label>Alternativa C Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_cus" id="opcion_cus" required="required"/>
                <div class="spacer"></div>
                
                <label>Alternativa D Es
                    <span class="small"></span>
                </label>
                <textarea name="opcion_des" id="opcion_des" required="required"/>
                <label>Alternativa D Us
                    <span class="small"></span>
                </label>
                <textarea name="opcion_dus" id="opcion_dus" required="required"/>
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
                <input type="text" name="nivel_dificultad" id="nivel_dificultad" />
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
                    <option value="<?php echo $item->getArea_id()?>"><?php echo $item->getNombre()?> </option>
                    
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
                    <option value="<?php echo $item->getGrupo_id()?>"><?php echo $item->getNombre()?> </option>
                    
                <?php } ?>     
                </select>
                
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
                <input type="hidden" name="controlador" id="controlador" value="Pregunta"/>
                <input type="hidden" name="accion" id="accion" value="insertarPregunta"/>
                <button type="submit">Guardar</button>
            </form>
            
            
            
            
        </div>
    </body>
</html>
