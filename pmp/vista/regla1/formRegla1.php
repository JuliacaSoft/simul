
<!DOCTYPE html>
<?php


?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Formulario de registro de Reglas</title>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
    </head>
    <body>

        <div id="stylized" class="myform">
            <form id="form" name="formInsert" method="post" action="_proxy.php">
                <h1>Formulario de registro de Reglas</h1>
                <p>Por favor complete los campos que se requiere </p>


                <label>Nombre
                    <span class="small"></span>
                </label>
                <input type="text" name="nombre" id="nombre" required="required" />
                <div class="spacer"></div>
                             
                <label>Ensayo
                    <span class="small">Seleccione Tipo Ensayo</span>
                </label>
                <select  name="ensayo_id" id="ensayo_id">
                <?php
                $i=0;
                foreach($ensayo as $item )
                {
                ?>                    
                    <option value="<?php echo $item->getEnsayo_id()?>"><?php echo $item->getNombre()?> </option>
                    
                <?php } ?>     
                </select>
                
                <label>Grupo de Procesos
                    <span class="small">Seleccione Grupo de Procesos</span>
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
                
                <label>Area de Conocimiento
                    <span class="small">Seleccione Area de Conocimiento</span>
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
                
                
                <label>Estado
                    <span class="small">Seleccione un estado</span>
                </label>
                <select name="estado" id="estado">
                    <option value="1">Activo </option>
                    <option value="0">Desactivo</option>
                </select>                              
                <div class="spacer"></div>  

                <div class="spacer"></div>
                <input type="hidden" name="controlador" id="controlador" value="Regla"/>
                <input type="hidden" name="accion" id="accion" value="insertarRegla"/>
                <button type="submit">Guardar</button>
            </form>
        </div>
    </body>
</html>
