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
    $cantidad=0;
    $mensaje="";
    if(count($data)>0){
        foreach ($data as $valor) {
            $cantidad=$valor[0]['cantidad'];
            $mensaje="Asistentes COINTEM";
        }
    }
    ?>
    
    
    <div>

        <table border="0">
            <thead>
                <tr>
                    <th colspan="3">Cerrar Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Participacion</td>
                    <td>Cantidad</td>
                    <td>Opcion</td>
                </tr>
                <?php if($cantidad!=0){ ?>
                
                <tr>
                    <td><?php echo $mensaje; ?></td>
                    <td><?php echo $cantidad?></td>
                    <td><a href="_proxy.php?controlador=Asistencia&accion=asisClose">Cerrar</a></td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>

        
    </div>    

</body>
</html>