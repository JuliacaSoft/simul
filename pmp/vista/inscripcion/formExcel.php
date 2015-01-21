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
            <form action="_proxy.php" target="excel">
                <table border="0"  width="100%">
                    <thead>
                        <tr>
                            <th>Exportar Inscritos a Formato Excel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">

                                Todos Inscritos:<input type="radio" name="opt" checked value="0" />
                                Confirmados:<input type="radio" name="opt" value="1" />                               
                                <input type="hidden" name="controlador" value="Inscripcion" />
                                <input type="hidden" name="accion" value="excelExport" />
                                <input type="submit" value="Reportar" name="reportar" />
                            </td>
                        </tr>
                    </tbody>
                </table>

            </form>
            <br/>
            <iframe scrolling="auto" name="excel"  frameborder="0" height="700px" width="96%" >
               
            </iframe>
        </center>
    </div>
   
    
</body>
</html>