<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>        
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/> 
        
        <link type="text/css" href="../../web/report/alumno/css/styles.css" rel="stylesheet" />
       
</head>
        
<body>  

    
    <div id="central">



<?php

 
 $condi=0;

  if(count($pregunta)!=0){
                
            
 for ($i = 0; $i < count($pregunta); $i++) {
 
     if($condi==0){
 
     
?>
    
    
<form name="form" method="post" action="_proxy.php">
    
<h1 align="center">Simulador Online PMP - Atenos</h1> 
<p><strong><?php echo $intentos[0]['contar'] ?></strong> <em> intentos de </em><?php echo $intentos[0]['intento'] ?></p> 
<br>  
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC">
<div>
    <tr>
        <td colspan="2" bgcolor="#3b5998">
            <div align="center">
                <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                Preguntas en Español
                </font> 
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <strong> <?php echo $pregunta[$i]['pregunta_es'] ?> </strong></font>
            </div>
        </td>
    </tr>

    <?php //desordenar aleatorialmente las alternativas
        $plantilla=range(0,3);
        shuffle($plantilla);
        //foreach ($plantilla as $c => $v) {
        //    echo "$c: $v<br>";
        //}


        $alternativas_es=array($pregunta[$i]['opcion_aes'],$pregunta[$i]['opcion_bes'],$pregunta[$i]['opcion_ces'],$pregunta[$i]['opcion_des']);
        $alternativas_us=array($pregunta[$i]['opcion_aus'],$pregunta[$i]['opcion_bus'],$pregunta[$i]['opcion_cus'],$pregunta[$i]['opcion_dus']);
        
        $alternativas_sort_es=array();
        $alternativas_sort_us=array();
        
        for($j=0;$j<count($alternativas_es);$j++){
            $alternativas_sort_es[$j]=$alternativas_es[$plantilla[$j]];
            $alternativas_sort_us[$j]=$alternativas_us[$plantilla[$j]];
        }

        //foreach ($alternativas_sort_es as $clave => $valor) {
        //    echo "$clave: $valor<br>";
        //}

        
    ?>



    <tr>
        <td width="20">a)<input name="respuesta" type="radio" disabled value="1"/>
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[0]?></font>
        </td>
    </tr>
    <tr>
        <td>b)<input type="radio" name="respuesta" disabled value="2" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[1]?></font>
        </td>
    </tr>
    <tr> 
        <td>c)<input type="radio" name="respuesta" disabled value="3" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[2]?> </font>
    </td>
    </tr>
    <tr>
        <td>d)<input type="radio" name="respuesta" disabled value="4" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[3]?> </font>
        </td>
    </tr>

    <tr>
        <td colspan="2" bgcolor="#FFFFFF">
            <div align="center">
                <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                English Questions
                </font> 
            </div>
        </td>
    </tr>
</div>
    
    
    
<div>
    <tr>
        <td colspan="2" bgcolor="#3b5998">
            <div align="center">
                <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                English Questions
                </font> 
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <strong> <?php echo $pregunta[$i]['pregunta_us']?> </strong></font>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20">a)<input name="respuesta" type="radio" value="A"/>
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php echo $alternativas_sort_us[0] ?></font>
        </td>
    </tr>
    <tr>
        <td>b)<input type="radio" name="respuesta" value="B" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[1] ?>
            </font>
        </td>
    </tr>
    <tr> 
        <td>c)<input type="radio" name="respuesta" value="C" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[2] ?> </font>
    </td>
    </tr>
    <tr>
        <td>d)<input type="radio" name="respuesta" value="D" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php  echo $alternativas_sort_us[3] ?> </font>
        </td>
    </tr>
   
    </div>
 </table>
 
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="" >
   
        <tr><div align="center">

            <td>r)<input type="checkbox" name="revision" value="R" />
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php  echo "Revision" ?> </font>
            </td>
                           
        <td>
            <?php 
                $salida="";

                for($x=0;$x<count($plantilla);$x++){
                    switch ($plantilla[$x]) {
                        case 0: $plantilla[$x]='A'; break;
                        case 1: $plantilla[$x]='B'; break;
                        case 2: $plantilla[$x]='C'; break;
                        case 3: $plantilla[$x]='D'; break;
                    }

                    $salida=$salida.$plantilla[$x];
                }
            ?>
                <input type="hidden" name="plantilla" value="<?php echo $salida ?>"/>
                <input type="hidden" name="pregunta_id" value="<?php echo $pregunta[$i]['pregunta_id'] ?>"/>
                <input type="hidden" name="simulacion_id" value="<?php echo $pregunta[$i]['simulacion_id'] ?>"/>
                <input type="hidden" name="controlador" id="controlador" value="Alumno" />
                <input type="hidden" name="accion" id="accion" value="cambiarCondicionPregunta" />
                <input type="submit" name="Submit" value="Siguiente" />
            
            
            
          
        </td>
    </tr>
    
    
    </table>
</form>
<form name="timeForm">
<div class="resultados">
    <table>
    <thead>
        <th>Resulstados</th>
    </thead>
    <tbody>
        <tr>
            <th>Tiempo</th>
            <td> <input type="text" name="tiempo"> <?php 
            echo $tiempofin;

            $f=explode("-",$tiempofin);
            echo mesLetrasNum($f[1])." ".substr($f[2],0,2)." ".$f[0]." ".substr($f[2],-8);

            ?> </td>
        </tr>
         <tr>
            <th>Total Pregutas</th>
            <td>  <?php echo $totals ?> </td>
        </tr>
         <tr>
            <th>Respondidas</th>
           <td>  <?php echo $totalcon ?> </td>
        </tr>
         <tr>
            <th>Por revisar</th>
              <td>  <?php echo $totalrev ?> </td>
        </tr>
        <tr>
            <th>En blanco</th>
            <td><?php echo $perdidos ?> </td>
        </tr>
         <tr>
            <th>Restantes</th>
            <td>  <?php echo $restante ?> </td>
        </tr>
        
        
        <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=finalizarSimul&simulacion_id='+<?php echo $simulacion_id ?>">Finalizar Simulación</button> 
        
    </tbody>
</table>
</div>
</form>
    
    
<?php 
    $condi=1;
    break;
        }    


     }
     
     }else{
         echo '<h1> Main'.count($pregunta2).'</h1>';
         if(count($pregunta2)!=0){
             ?>
             <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=listarPreguntasRev&simulacion_id='+<?php echo $simulacion_id ?>+'&opc='+<?php echo 100 ?>">Ver Revisiones</button>   
    <?php
         }else{
?>    
         <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=finalizarSimul&simulacion_id='+<?php echo $simulacion_id ?>">Finalizar Simulación</button> 
     <?php 
     
         } 
        
         }?>    
   </div>    
</body>
</html>

<script language="javascript" type="text/javascript">

function getTime() {
    

    now = new Date();
    y2k = new Date("<?php echo mesLetrasNum($f[1])." ".substr($f[2],0,2)." ".$f[0]." ".substr($f[2],-8)?>");
    days = (y2k - now) / 1000 / 60 / 60 / 24;
    daysRound = Math.floor(days);
    hours = (y2k - now) / 1000 / 60 / 60 - (24 * daysRound);
    hoursRound = Math.floor(hours);
    minutes = (y2k - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
    minutesRound = Math.floor(minutes);
    seconds = (y2k - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
    secondsRound = Math.round(seconds);
    sec = (secondsRound == 1) ? " sec." : " secs.";
    min = (minutesRound == 1) ? " min." : " mins, ";
    hr = (hoursRound == 1) ? " hr" : " hrs, ";
    dy = (daysRound == 1)  ? " day" : " days, ";


    document.timeForm.tiempo.value =hoursRound + hr + minutesRound + min + secondsRound + sec;
    
    if(secondsRound==1 && minutesRound==0 && hoursRound==0){
        alert("El tiempo de su examen a finalizado");
        //document.write("<meta http-equiv='refresh' content='1; url=_proxy.php?controlador=Alumno&accion=listarPreguntasRev&simulacion_id='+<?php echo $simulacion_id ?>'>");
        location.href='_proxy.php?controlador=Alumno&accion=finalizarSimul&simulacion_id='+<?php echo $simulacion_id ?>;
        return;
    }
    newtime = window.setTimeout("getTime();", 1000);
}
window.onload=getTime;
//  End -->
</script>

<?php 
function mesLetrasNum($m){
    switch($m){
        case 01: $mes="Jan"; break;
        case 02: $mes="Feb"; break;
        case 03: $mes="Mar"; break;
        case 04: $mes="Apr"; break;
        case 05: $mes="May"; break;
        case 06: $mes="Jun"; break;
        case 07: $mes="Jul"; break;
        case 08: $mes="Aug"; break;
        case 09: $mes="Sep"; break;
        case 10: $mes="Oct"; break;
        case 11: $mes="Nov"; break;
        case 12: $mes="Dec"; break;                 
    }
    return $mes;

}

 ?>