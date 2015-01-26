
<!DOCTYPE html>
<?php


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Ensayo</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Ensayo</h1>
                <p>Por favor complete los campos que se requiere </p>

                <?php foreach($ensayo as $u ) {?>
                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" required="required" value="<?php echo $u->getNombre() ?>" />
                <div class="spacer"></div>
                <label>Descripcion
                    <span class="small">Coloque Descripcion</span>
                </label>
                <textarea name="descripcion" id="descripcion" rows="5" cols="40" ><?php echo $u->getDescripcion(); ?></textarea>
                <div class="spacer"></div>
                
                <label>Tipo Ensayo
                    <span class="small">Seleccione un tipo</span>
                </label>
                <select name="tipo" id="tipo" onchange="validarTipoEnsayo()">
                    <option value="1" <?php if($u->getTipo()=="1") echo 'selected="selected"'; ?> >Global </option>
                    <option value="2" <?php if($u->getTipo()=="2") echo 'selected="selected"'; ?> >Área de Conocimiento</option>
                    <option value="3" <?php if($u->getTipo()=="3") echo 'selected="selected"'; ?> >Grupo de Procesos</option>
                </select>   

                <label>Tipo Dependencia
                    <span class="small"></span>
                </label>
                
                
                <select name="t_dependencia" id="t_dependencia">  
                    <?php
                    if($Tipo==1){
                       
                  ?>
                    
                    <option value="A" <?php if("A"==$u->getT_dependencia()) echo 'selected="selected"'; ?> >Area de Conocimiento</option>
                    <option value="G" <?php if("G"==$u->getT_dependencia()) echo 'selected="selected"'; ?>>Grupo de Procesos</option>
                    <?php } ?>
                    
                  <?php
                    if($Tipo==2){
                        foreach ($depend as $ar){
                  ?>
                    
                    <option value="<?php echo $ar->getArea_id() ?>"   <?php if($ar->getArea_id()==$u->getT_dependencia()) echo 'selected="selected"'; ?> ><?php echo $ar->getNombre() ?></option>
                    
                    <?php }} ?>
                    
                    <?php
                    if($Tipo==3){
                        foreach ($depend as $gr){
                  ?>
                    
                    <option value="<?php echo $gr->getGrupo_id() ?>" <?php if($gr->getGrupo_id()==$u->getT_dependencia()) echo 'selected="selected"'; ?> ><?php echo $gr->getNombre() ?></option>
                    <?php }} ?>
                    
                    
                    
                    
                </select>
                <div class="spacer"></div>
                

                <label>Cantidad Preguntas
                    <span class="small">Seleccione Cantidad Preguntas</span>
                </label>
                <select  name="cant_preg" id="cant_preg" onchange="cambiartiempo();"  > 
                    <option value="200" <?php if($u->getCant_preg()=="200") echo 'selected="selected"'; ?> >200</option>
                    <option value="100" <?php if($u->getCant_preg()=="100") echo 'selected="selected"'; ?> >100</option>
                    <option value="50" <?php if($u->getCant_preg()=="50") echo 'selected="selected"'; ?> >50</option>
                    <option value="20" <?php if($u->getCant_preg()=="20") echo 'selected="selected"'; ?> >20</option>
                    <option value="10" <?php if($u->getCant_preg()=="10") echo 'selected="selected"'; ?> >10</option>
                    <option value="5" <?php if($u->getCant_preg()=="5") echo 'selected="selected"'; ?> >5</option>
                </select>



                <label>Tiempo
                    <span class="small">Tiempo</span>
                </label>
                <input type="text" name="tiempo" id="tiempo" required="required" value="<?php echo $u->getTiempo() ?>"/>
                <div class="spacer"></div>
                
                <label>% de Aprobación
                    <span class="small">Coloque % Aprob.</span>
                </label>
                <input type="text" name="porc_aprobacion" id="porc_aprobacion" required="required" value="<?php echo $u->getPorc_aprobacion() ?>"/>

                <label>Límite de intentos
                    <span class="small">Coloque Intento</span>
                </label>
                <input type="text" name="intento" id="intento" required="required" value="<?php echo $u->getIntento() ?>"/>
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
                    <option value="<?php echo $item->getCurso_id()?>" <?php if($item->getCurso_id()==$u->getCurso_id()) echo 'selected="selected"'; ?> ><?php echo $item->getNombre()?> </option>
                <?php } ?>     
                </select>

                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    <option value="1" <?php if($u->getEstado()=="1") echo 'selected="selected"'; ?> >Activo</option>
                    <option value="0" <?php if($u->getEstado()=="0") echo 'selected="selected"'; ?> >Desactivo</option>
                </select>                              
                <div class="spacer"></div>  

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Ensayo"/>
                <input type="hidden" name="accion" id="accion" value="actualizaEnsayo"/>
                <input type="hidden" name="ensayoid" id="ensayoid" value="<?php echo $u->getEnsayo_id() ?>"/>
                <button type="submit">Guardar</button>
                <?php }?>
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