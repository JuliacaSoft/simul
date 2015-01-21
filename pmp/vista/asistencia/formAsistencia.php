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
         <script type="text/javascript" src="../../recursos/ajax/asistencia.js"></script>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formVanadium.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
        
</head>
    
<body>
    <?php 
    ?>
    
    
    <div>
        <form name="insForm" action="javascript:insAsis()">
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="4" >Confirmaci&oacute;n de Asistencia en el Evento </th>
                    </tr>
                </thead>
                <tbody>                
                    <tr>
                        <td>C&oacute;digo:</td>
                        <td colspan="3"><input type="text"  id="codigo" name="codigo" value="" size="30" />
                            <input type="submit" value="Registrar" name="registrar" />
                        </td>
                    </tr>
                </tbody>
            </table>           
        </form>  
        <br/>
        <div id="msg"  style="display: none">
             
        </div>
    </div>    

</body>
</html>