<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

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
    <div >
        <center>                               
            <form action="_proxy.php" target="barra">
                <table border="0"  width="100%">
                    <thead>
                        <tr>
                            <th>Generar Codigo de Barra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">
                                C&oacute;digo: 
                                <input type="text" name="codIni" size="10" value="" /> a 
                                <input type="text" name="codFin" size="10" value="" />                               
                                <input type="hidden" name="controlador" value="Inscripcion" />
                                <input type="hidden" name="accion" value="impriBarr" />
                                <input type="submit" value="Mostrar" name="mostrar" />
                            </td>
                        </tr>
                    </tbody>
                </table>

            </form>
            <br/>
            <iframe scrolling="si" name="barra" bordercolor="red"  frameborder="1" height="700px" width="100%" >
               
            </iframe>
        </center>
    </div>
   
    
</body>
</html>