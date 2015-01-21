<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
        <META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache"/>
        <title>COINTEM &reg; </title>
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/js/vanadium.js"></script>
         <script type="text/javascript" src="../../recursos/ajax/inscripcion.js"></script>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formVanadium.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
        <link href="../../recursos/css/estilo.css" rel="stylesheet" type="text/css" />  


      
        
</head>
    
<body>
    <?php
    $nombre="";
    $idInscrito="";
    foreach($data as $to){
      $nombre=$to['nombres']." ".$to['apell_paterno']." ".$to['apell_materno'];   
      $idInscrito=$to['id_inscripcion'];
    }
    ?>
    <div >
<!--        <form name="insForm" action="javascript:newConfirm()">-->
            <table border="0">
                <thead>
                    <tr>
                        <th colspan="4">Confirmar la participaci&oacute;n en el Evento </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                   
                        <td colspan="4">Nombre :  <?php echo $nombre;?></td>
                    </tr>                    
<!--                    <tr>
                        <td>Número de Deposito:</td>
                        <td colspan="3"><input type="text" class=":required" id="numdep" name="numdep" value="" size="40" /></td>
                    </tr>                    
                    <tr>
                        <td colspan="4">
                        <input type="hidden"  id="idInscrito" name="idInscrito" value="<?php echo $idInscrito; ?>" />
                        <input type="submit" value="Confirmar" name="enviar" />&emsp;
                        <input type="button" value="Mas Tarde" name="enviar" />
                        
                        </td>
                    </tr>-->
                    <tr>
                        <td class="text">Por favor seleccione el archivo (Voucher de Pago- Scaneado):</td>
                    </tr>                    
                    <tr>
                                    <td class="text">
                                    <form action="_proxy.php" method="post" enctype="multipart/form-data">   
                                    <input name="archivo" type="file" class="casilla" id="archivo"  size="35" />
                                    <input type="hidden"  id="idInscrito" name="idInscrito" value="<?php echo $idInscrito; ?>" />
                                    
                                    <input name="controlador" type="hidden" value="Confirmacion" />	  	
                                    <input name="accion" type="hidden" value="confSave" />    
                                    <input name="enviar" type="submit" class="boton" id="enviar" value="Subir Archivo" />                                    
                                    </form>
                                    </td>
                    </tr>
                    <tr>
                        <td class="text" style="color:#990000"><?php echo $status; ?></td>
                    </tr>                    
                    
                </tbody>
            </table>

            
<!--        </form>               -->
    </div>    

</body>
</html>