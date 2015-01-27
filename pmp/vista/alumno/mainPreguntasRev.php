<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
            
        <script type="text/javascript" src="../../recursos/js/jquery-1.9.1.min.js"></script>        
        <link rel="stylesheet" type="text/css" href="../../recursos/css/forms.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        
        
        <script type="text/javascript" src="../../recursos/js/bootstrap.min.js"></script>  
        <link type="text/css" href="../../recursos/css/bootstrap.css" rel="stylesheet" />
       <link type="text/css" href="../../recursos/css/styles.css" rel="stylesheet" />

</head>
        
<body> 

 <div id="" class="myform">
 <!-- <div id="central"> -->


<?php

 
 $condi=0;

  if(count($pregunta)!=0){
                
            
 for ($i = 0; $i < count($pregunta); $i++) {
 
     if($condi==0){
 
     
?>
<h2 align="center">Simulador Online PMP - Atenos</h2> 

<div class="row"><!--Div tiempo-->
    <div class="col-md-3">
        <form name="timeForm" role="form" class="form-inline"> 
        <div class="form-group text-center">
            <label>Tiempo: </label> <input name="tiempo" type="text" class="form-control" readonly="readonly" style="font-size:14"> 
            <?php 
                //echo $tiempofin;
                $f=explode("-",$tiempofin);
                //echo mesLetrasNum($f[1])." ".substr($f[2],0,2)." ".$f[0]." ".substr($f[2],-8);
            ?> 
        </div>
        </form>
    </div>

    <!-- <div class="col-md-1">
        <label>Tiempo: </label>
    </div>
    <div class="col-md-2">
        <form name="timeForm" role="form" class="form-inline">
        <input type="text" name="tiempo" class="form-control" readonly="readonly"> 
        <?php //echo $tiempofin;
            $f//=explode("-",$tiempofin);
            //echo mesLetrasNum($f[1])." ".substr($f[2],0,2)." ".$f[0]." ".substr($f[2],-8);
        ?>
        </form>
    </div> -->
    <div class="col-md-9">
        <h5 align="center"><strong><?php echo $intentos[0]['contar'] ?></strong> <em> intentos de </em><strong><?php echo $intentos[0]['intento'] ?></strong></h5> 
    </div>
</div><!--Fin div tiempo-->


<div class="row"><!--Inicio div preguntas-->
<div class="col-md-9 col-md-push-3"> <!--inicio columna preguntas-->
<form name="form" method="post" action="_proxy.php">
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
                <br />
                <br />
            </div>
        </td>
    </tr>

    <?php //desordenar aleatorialmente las alternativas
        //$plantilla=range(0,3);
        //shuffle($plantilla);
        //foreach ($plantilla as $c => $v) {
        //    echo "$c: $v<br>";
        //}
    
        $plantilla=array();
        $plantilla = str_split($pregunta[$i]['ordalt']);
        $alt = str_split($pregunta[$i]['ordalt']);
        for($x=0;$x<count($plantilla);$x++){ //convertir las letras a numeros
            switch ($plantilla[$x]) {
                case 'A': $plantilla[$x] = 0; break;
                case 'B': $plantilla[$x] = 1; break;
                case 'C': $plantilla[$x] = 2; break;
                case 'D': $plantilla[$x] = 3; break;
            }
        }
    

        $alternativas_es=array($pregunta[$i]['opcion_aes'],$pregunta[$i]['opcion_bes'],$pregunta[$i]['opcion_ces'],$pregunta[$i]['opcion_des']);
        $alternativas_us=array($pregunta[$i]['opcion_aus'],$pregunta[$i]['opcion_bus'],$pregunta[$i]['opcion_cus'],$pregunta[$i]['opcion_dus']);
        
        $alternativas_sort_es=array();
        $alternativas_sort_us=array();
    
    //if(!$pregunta[$i]['estado']==0){     // tienen RESPUESTA o estén en estado REVISIÓN    
        for($j=0;$j<count($alternativas_es);$j++){
            $alternativas_sort_es[$j]=$alternativas_es[$plantilla[$j]];
            $alternativas_sort_us[$j]=$alternativas_us[$plantilla[$j]];
        }

        //foreach ($alternativas_sort_es as $clave => $valor) {
        //    echo "$clave: $valor<br>";
        //}
        //echo "p marcado ".$pregunta[$i]['marcado']."<br>";
        //echo "p respuesta ".$pregunta[$i]['respuesta']."<br>";

        for($x=0;$x<count($alt);$x++){ //convertir las letras a numeros
            switch ($pregunta[$i]['marcado']) {
                case 'A': $pregunta[$i]['marcado'] = 1; break;
                case 'B': $pregunta[$i]['marcado'] = 2; break;
                case 'C': $pregunta[$i]['marcado'] = 3; break;
                case 'D': $pregunta[$i]['marcado'] = 4; break;
            }

            
            if (!$pregunta[$i]['marcado']==0) {
                if ($alt[$pregunta[$i]['marcado']-1] == $pregunta[$i]['respuesta']) {
                    $res=TRUE; //caso q la respuesta es correcta
                }else{
                    $res=FALSE;
                }
            }

            if($alt[$x]==$pregunta[$i]['respuesta']){
                $ide=$x+1;
            }
            
        }
    
        //echo "p real ".$alt[$pregunta[$i]['marcado']-1]."<br>";
         //echo "ide ".$ide."<br>";
        
    ?>

    <tr <?=($pregunta[$i]['marcado']=="1")?>>
        <td width="20">a)<input name="respuestae" type="radio" disabled value="1" <?=($pregunta[$i]['marcado']=="1")?"checked":""?> >
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[0]?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="2")?>>
        <td>b)<input type="radio" name="respuestae" disabled value="2" <?=($pregunta[$i]['marcado']=="2")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[1]?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="3")?>> 
        <td>c)<input type="radio" name="respuestae" disabled value="3" <?=($pregunta[$i]['marcado']=="3")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[2]?> </font>
    </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="4")?>>
        <td>d)<input type="radio" name="respuestae" disabled value="4" <?=($pregunta[$i]['marcado']=="4")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[3]?> </font>
        </td>
    </tr>

    
</div>

<div>
    <tr>
        <td colspan="2" bgcolor="#FFFFFF">
            <div align="center">
                <font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                .
                <br />
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
                <br />
                <br />
            </div>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="1")?>>
        <td width="20">a)<input name="respuesta" type="radio" value="A" <?=($pregunta[$i]['marcado']=="1")?"checked":""?> >
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php echo $alternativas_sort_us[0] ?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="2")?> >
        <td>b)<input type="radio" name="respuesta" value="B" <?=($pregunta[$i]['marcado']=="2")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[1] ?>
            </font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="3")?> > 
        <td>c)<input type="radio" name="respuesta" value="C" <?=($pregunta[$i]['marcado']=="3")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[2] ?> </font>
    </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="4")?> >
        <td>d)<input type="radio" name="respuesta" value="D" <?=($pregunta[$i]['marcado']=="4")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php  echo $alternativas_sort_us[3] ?> </font>
        </td>
    </tr>
   
    </div>
 </table>
</div><!--Fin de la columna preguntas-->

<div class="col-md-3 col-md-pull-9"><!--Inicio columna resultados-->
<ul class="list-group">
  <li class="list-group-item">
    <span class="badge"><?php echo $totals ?></span>
    Total Pregutas
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $totalcon ?></span>
    Respondidas
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $totalrev ?></span>
    Por revisar
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $perdidos ?></span>
    En blanco
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $restante ?></span>
    Restantes
  </li>


</ul>
<p align="center"><button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=finalizarSimul&simulacion_id='+<?php echo $simulacion_id ?>" class="btn btn-danger">Finalizar Simulación</button> </p>
</div><!--Fin columna resultados-->
</div><!--Fin div row preguntas-->

<div class="row"><!--Div botonos finales-->
    <div  class="col-md-3">
    </div>

    <div class="col-md-9">
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="" >
   
        <tr><div align="center">

            <td>r)<input type="checkbox" name="revision" value="R" />
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php  echo "Revision" ?> </font>
            </td>
                           
        <td>
            
                
                <input type="hidden" name="pregunta_id" value="<?php echo $pregunta[$i]['pregunta_id'] ?>"/>
                <input type="hidden" name="simulacion_id" value="<?php echo $pregunta[$i]['simulacion_id'] ?>"/>
                <input type="hidden" name="controlador" id="controlador" value="Alumno" />
                <input type="hidden" name="accion" id="accion" value="cambiarCondicionPreguntaRevision" />
                <input type="submit" name="Submit" value="Siguiente" class="btn btn-primary"/>        
            
            
          
        </td>
    </tr>
    
    
    </table>
</form>




<?php 
    $condi=1;
    break;
        }    


     }
     
     }else{
         echo '<h1> MainRev: '.count($pregunta2).'</h1>';
         if(count($pregunta2)!=0){
             ?>
             <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=listarPreguntasRevision&simulacion_id='+<?php echo $simulacion_id ?>+'&opc='+<?php echo 100 ?>">Ver Revisiones</button>   
    <?php
         }else{
?>    
         <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=finalizarSimul&simulacion_id='+<?php echo $simulacion_id ?>">Finalizar Simulación</button> 
     <?php 
     
         } 
        
         }?>    
   </div>  
</div><!--Fin div botones finales-->
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
    sec = (secondsRound == 1) ? " sec. " : " secs.";
    min = (minutesRound == 1) ? " min. " : " mins, ";
    hr = (hoursRound == 1) ? " hr. " : " hrs, ";
    dy = (daysRound == 1)  ? " day" : " day,";


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