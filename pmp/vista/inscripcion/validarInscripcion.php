<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
    <div>

        <form id="valid" action="" >
        <table border="0">
            <thead>
                <tr>
                    <th colspan="4">Validar Confirmaci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <tr>                    
                    <td>Nombre</td>
                    <td>Nº Voucher</td>
                    <td>Equivalencia</td>
                    <td>Validar</td>
                </tr>
                
                <?php if(count($data)>0){
                    foreach ($data as $valor) {
                    $selectValue=$valor['id_confirmacion']."|".$valor['desicion']."|".$valor['id_inscripcion']."|".$valor['num_deposito'];
                    ?>                
                <tr>
                    <td><?php echo $valor['nombre']; ?></td>
                    <td>
                    <a href="#" style="font-size: 8pt" onclick="foto('viewFoto','<?php echo $valor['num_deposito']?>', event)" >Voucher</a>                     
                    
                    
                    </td>
                    <td><?php echo $valor['desicion']; ?></td>                    
                    <td>                        
                        <input type="checkbox" name="vloar[]"   value="<?php echo $selectValue; ?>" />
                    </td>
                </tr>
                <?php } } ?>
                <tr>                    
                    <td colspan="4">
                        <input type="hidden" name="controlador" value="Confirmacion" />
                        <input type="hidden" name="accion" value="validaUpdate" />
                        <input type="button" value="Validar" onclick="javascript:enviar()" name="validar" />
                    </td>

                </tr>                
            </tbody>
        </table>            
        </form>

        
    </div>
    <div id="viewFoto" style="position:absolute; z-index:9999; padding:5px; border-color:#D5BF7E;border-style:solid; border-width:2px; background-color:white;width: 60%; display:none;">
        <a href="#" onclick="closeX('viewFoto')">X</a>
        <img id="fotoview" width="100%" height="80%" border="0" />
    </div>
</body>
</html>