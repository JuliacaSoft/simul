<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
$msgdmp="";
?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache"/>
        <title>COINTEM &reg; </title>
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/js/vanadium.js"></script>
        <script type="text/javascript" src="../../recursos/ajax/inscripcion.js"></script>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formVanadium.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
        
</head>
    
<body>
<?php

?>
    <div>
        <form name="insForm" action="javascript:newForm()">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="4">Inscripci&oacute;n en el Evento </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre:</td>
                        <td colspan="3"><input type="text" class=":required" id="nombre" name="nombre" id="nombre" value="" size="40" /></td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno:</td>
                        <td colspan="3"><input type="text" class=":required" name="apellpaterno" id="apellpaterno" value="" size="40" /></td>
                    </tr>
                    <tr>
                        <td>Apellido Materno:</td>
                        <td colspan="3"><input type="text" class=":required" name="apellmaterno" id="apellmaterno" value="" size="40" /></td>
                    </tr>
                    <tr>
                        <td>sexo:</td>
                        <td colspan="3">
                            <select name="sexo" id="sexo" style="width: 100px">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>DNI/Cédula:</td>
                        <td colspan="3"><input type="text" class=":required :number" name="dnicedula" id="dnicedula" value="" /></td>
                    </tr>
                    <tr>
                        <td>E-Mail:</td>
                        <td colspan="3"><input type="text" class=":required :email" name="email" id="email" value="" size="50" /></td>
                    </tr>
                    <tr>
                        <td>Teléfono/Celular:</td>
                        <td colspan="3"><input type="text" class=":required :number" name="celular" id="celular" value="" /></td>
                    </tr>
                    <tr>
                        <td colspan="1">País:                                                
                        </td>                        
                        <td colspan="3">
                            <select name="pais" id="pais" onchange="regionMB()">
                                <?php if(count($dataPais)>0){ 
                                     foreach ($dataPais as $pa) {                                 
                                    ?>
                                <option value="<?php echo $pa['id_pais'];  ?>" <?php if($pa['id_pais']=='14'){ echo "selected";}  ?> > <?php echo $pa['nombre']; ?></option>
                                <?php } } ?>                                
                                <?php  ?>
                            </select>
                            &emsp;Region/Estado:   
                            <select name="region" id="region">

                            </select>                                                            
                        </td>                        
                    </tr>
                    <tr>
                        <td>Tipo Participante:</td>
                        <td colspan="3">
                            <select name="tipo" id="tipo">
                                <option value="I">Independiente</option>
                                <option value="D">Delegacion</option>                               
                            </select>
                        </td>          
                    </tr>
                    <tr>
                        <td>Institución:</td>
                        <td colspan="3">
<!--                            <input type="text" class=":required" name="institucion" id="institucion" value="" size="60" />-->
                            <select name="institucion" id="institucion">
                                <option value="1">UPeU</option>
                                <option value="2">UANCV</option>
                                <option value="3">UNA</option>
                                <option value="4">Ins. Tecnotronic</option>
                                <option value="5">UAP</option>
                                <option value="6">UPSC</option>
                                <option value="7">Otros</option>
                            </select>                            
                        </td>
                    </tr>
                    <tr>
                        <td>Aréa de Estudio:</td>
                        <td>
                            <select name="area" id="area">                            
                                <?php if(count($dataEspecialidad)>0){ 
                                     foreach ($dataEspecialidad as $es) {                                 
                                    ?>
                                <option value="<?php echo $es['id'];  ?>" <?php if($es['id']=='14'){ echo "selected";}  ?> > <?php echo $es['nombre']; ?></option>
                                <?php } } ?>                                  
                                              
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nivel de Estudio:</td>
                        <td>
                            <select name="nivel" id="nivel">
                                <option value="Posgrado">Posgrado</option>
                                <option value="Master">Master</option>
                                <option value="Universitario">Universitario</option>
                                <option value="Doctorado">Doctorado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" value="Registrarse" onclick="" name="enviar" />
                        
                        </td>
                    </tr>
                </tbody>
            </table>

            
        </form>  
        <br/>
        <div id="msg" style="display: none">
            
        </div>
        
        <div id="myDiv">
            <?php if(count($msgdmp)>0){echo $msgdmp;}?>
        </div>
    </div>    

</body>
</html>