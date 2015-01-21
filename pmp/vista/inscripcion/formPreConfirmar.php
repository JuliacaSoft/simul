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

        
        
</head>
    
<body>
    <center>
    <div style="width: 100%;">
        <form name="insForm" action="javascript:preConfirm()">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="4">Confirmar la participaci&oacute;n en el Evento </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>DNI/C&eacute;dula:</td>
                        <td colspan="3"><input type="text" class=":required" name="dni" id="dni" value="" /></td>
                    </tr>                    
                    <tr>
                        <td>Clave de Confirmaci&oacute;n:</td>
                        <td colspan="3"><input type="text" class=":required" id="clave" name="clave" value="" size="30" /></td>
                    </tr>                    
                    <tr>
                        <td colspan="4">
                        <input type="submit" value="Siguiente" name="enviar" />
                        
                        </td>
                    </tr>
                </tbody>
            </table>
        </form> 
        <br/>
        <div id="msg" style="display: none">
            
        </div>
    </div>    
</center>
</body>
</html>