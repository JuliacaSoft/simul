<?php
if(! empty($_REQUEST['opc'])){
if(($_REQUEST['opc'])=='E'){
setlocale(LC_TIME, 'spanish'); $variante=strftime("%d-%B-%Y");
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=Inscritos_COINTEM_".$variante.".xls");
header("Pragma: no-cache");
header("Expires: 0");
}
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <table   style="border-style: groove;border-color: black;">    
        <tr style="background-color: darkgray">
            <th colspan="13" style=""><?php echo $title ?>
            [<a href="_proxy.php?opc=E&opt=<?php echo $opt?>&controlador=Inscripcion&accion=excelExport">Excel</a>]
            </th>            
        </tr>
        <tr style="background-color: darkgray">
            
            <td><b>#</b></td>
            <td><b>Apell. Paterno</b></td>
            <td><b>Apell. Materno</b></td>
            <td><b>Nombre</b></td>
            <td><b>Sexo</b></td>
            <td><b>Documento</b></td>
            <td><b>Telefono</b></td>
            <td><b>E-Mail</b></td>
            <td><b>Institución</b></td>
            <td><b>Participacion</b></td>
            <td><b>Grado</b></td>
            <td><b>Especialidad</b></td>
           <td><b>Codigo</b></td>            
           
        </tr>
      <?php 
      $num=1;
      
      if(count($data)>0){
          foreach ($data as $da) {
      ?>                
        <tr>
            <td><?php echo $num;  ?></td>
            <td><?php echo $da['paterno']  ?></td>
            <td><?php echo $da['materno']  ?></td>
            <td><?php echo $da['nombre']  ?></td>
            <td><?php echo $da['sexo']  ?></td>
            <td><?php echo $da['documento']  ?></td>
            <td><?php echo $da['fono']  ?></td>
            <td><?php echo $da['email']  ?></td>
            <td><?php echo $da['institucion']  ?></td>
            <td><?php echo $da['participante']  ?></td>
            <td><?php echo $da['grado']  ?></td>
            <td><?php echo $da['especialidad']  ?></td>
            <td><?php echo $da['codigo']  ?></td>
        </tr>
        
      <?php $num++; }  } ?>    
        

    </table>
    </body>
</html>