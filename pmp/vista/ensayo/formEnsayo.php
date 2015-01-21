<!DOCTYPE html>
<?php
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Ensayo</title>

        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>               
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>        
        
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/ensayo.js"></script>

    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Ensayo</h1>
                <p>Por favor complete los campos que se requiere </p>


                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" required="required" />
                <div class="spacer"></div>
                
                <label>Descripción
                    <span class="small">Coloque descripción</span>
                </label>
                <textarea name="descripcion" rows="5" cols="40" id="descripcion" required="required"/>
                <div class="spacer"></div>
                
                <label>Tipo Ensayo
                    <span class="small">Seleccione un tipo</span>
                </label>
                <select name="tipo" id="tipo" onchange="validarTipoEnsayo()">
                    <option value="1">Global</option>
                    <option value="2">Área de Conocimiento</option>
                    <option value="3">Grupo de Procesos</option>
                </select>  
                
                <label>Tipo Dependencia
                    <span class="small"></span>
                </label>
                
                <!--caso 1-->
                <select name="t_dependencia" id="t_dependencia">                                 
                </select>
                <div class="spacer"></div>
                
               
                <label>Cantidad Preguntas
                    <span class="small">Seleccione Cantidad Preguntas</span>
                </label>
                <select  name="cant_preg" id="cant_preg" onchange="cambiartiempo();"  > 
                    <option value="200">200</option>
                    <option value="100">100</option>
                    <option value="50">50</option>
                    <option value="20">20</option>
                    <option value="20">10</option>
                    <option value="5" selected="selected">5</option>
                </select>
                
                               
                 <label>Tiempo
                    <span class="small">Tiempo</span>
                </label>
                <input type="text"  name="tiempo" value="30" id="tiempo" readonly required="required"/>
                <div class="spacer"></div>
                
                <label>% de Aprobación
                    <span class="small">Coloque % Aprob.</span>
                </label>
                <input type="number" name="porc_aprobacion" id="porc_aprobacion" required="required"/>
                
                <label>Límite de intentos
                    <span class="small">Coloque Intento</span>
                </label>
                <input type="number" name="intento" id="intento" required="required"/>
                <div class="spacer"></div>
                
                <label>Curso
                    <span class="small">Seleccione un curso</span>
                </label>
                <select  name="curso_id" id="curso_id">
                <?php
                $i=0;
                foreach($curso as $item )
                {
                ?>                    
                    <option value="<?php echo $item->getCurso_id()?>"><?php echo $item->getNombre()?> </option>
                    
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
                <input type="hidden" name="controlador" id="controlador" value="Ensayo"/>
                <input type="hidden" name="accion" id="accion" value="insertarEnsayo"/>
                <button type="submit">Guardar</button>
            </form>
        </div>
        
    </body>
    <script>
    function cambiartiempo(){
        dato=$("#cant_preg").val();
        if(dato==200){
            $("#tiempo").val(240);
        }
        if(dato==100){
            $("#tiempo").val(120);
        }
        if(dato==50){
            $("#tiempo").val(60);
        }
        if(dato==20){
            $("#tiempo").val(30);
        }
        if(dato==10){
            $("#tiempo").val(15);
        }
        if(dato==5){
            $("#tiempo").val(30);
        }
    }
    </script>
</html>
