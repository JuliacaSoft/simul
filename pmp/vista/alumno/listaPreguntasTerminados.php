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



<?php

if(count($pregunta)!=0){       
         
for ($i = 0; $i < count($pregunta); $i++) {   
?>
<h2 align="center">Simulador Online PMP - Atenos</h2>
</br> 

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
            </div>
        </td>
    </tr>

    <?php //Ordenar alternativas segun examen

        //$plantilla=range(0,3);
        //shuffle($plantilla);
        //foreach ($plantilla as $c => $v) {
        //    echo "$c: $v<br>";
        //}
    $alt = str_split($pregunta[$i]['ordalt']);        
    if(!$pregunta[$i]['estado']==0){
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
    }

        $alternativas_es=array($pregunta[$i]['opcion_aes'],$pregunta[$i]['opcion_bes'],$pregunta[$i]['opcion_ces'],$pregunta[$i]['opcion_des']);
        $alternativas_us=array($pregunta[$i]['opcion_aus'],$pregunta[$i]['opcion_bus'],$pregunta[$i]['opcion_cus'],$pregunta[$i]['opcion_dus']);
        
        $alternativas_sort_es=array();
        $alternativas_sort_us=array();
     
    if(!$pregunta[$i]['estado']==0){     // tienen RESPUESTA o estén en estado REVISIÓN  
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
    }else{   // No tienen RESPUESTA y están en ESTADO CERO "0"  
        for($j=0;$j<count($alternativas_es);$j++){
            $alternativas_sort_es[$j]=$alternativas_es[$j];
            $alternativas_sort_us[$j]=$alternativas_us[$j];
        }

        for($x=0;$x<count($alt);$x++){ //convertir las letras a numeros
            // switch ($pregunta[$i]['marcado']) {
            //     case 'A': $pregunta[$i]['marcado'] = 1; break;
            //     case 'B': $pregunta[$i]['marcado'] = 2; break;
            //     case 'C': $pregunta[$i]['marcado'] = 3; break;
            //     case 'D': $pregunta[$i]['marcado'] = 4; break;
            // }
      

            if($alt[$x]==$pregunta[$i]['respuesta']){
                $ide=$x+1;
            }else{
                switch ($pregunta[$i]['respuesta']) {
                    case 'A': $pregunta[$i]['respuesta'] = 1; break;
                    case 'B': $pregunta[$i]['respuesta'] = 2; break;
                    case 'C': $pregunta[$i]['respuesta'] = 3; break;
                    case 'D': $pregunta[$i]['respuesta'] = 4; break;
                }
                $ide=$pregunta[$i]['respuesta'];
            }
        }   
    }
         //echo "p real ".$alt[$pregunta[$i]['marcado']-1]."<br>";
         //echo "ide ".$ide."<br>";
    

        
        
    ?>



    <tr <?=($pregunta[$i]['marcado']=="1")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?> <?=($ide==1)?" class='alert alert-success'":""?>>
        <td width="20">a)<input name="respuestae" type="radio" disabled value="1" <?=($pregunta[$i]['marcado']=="1")?"checked":""?> >
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[0]?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="2")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?><?=($ide==2)?" class='alert alert-success'":""?>>
        <td>b)<input type="radio" name="respuestae" disabled value="2" <?=($pregunta[$i]['marcado']=="2")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[1]?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="3")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?><?=($ide==3)?" class='alert alert-success'":""?>> 
        <td>c)<input type="radio" name="respuestae" disabled value="3" <?=($pregunta[$i]['marcado']=="3")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_es[2]?> </font>
    </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="4")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?><?=($ide==4)?" class='alert alert-success'":""?>>
        <td>d)<input type="radio" name="respuestae" disabled value="4" <?=($pregunta[$i]['marcado']=="4")?"checked":""?>/></td>
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
    <tr <?=($pregunta[$i]['marcado']=="1")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?> <?=($ide==1)?" class='alert alert-success'":""?>>
        <td width="20">a)<input name="respuesta" type="radio" value="1" <?=($pregunta[$i]['marcado']=="1")?"checked":""?> >
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php echo $alternativas_sort_us[0] ?></font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="2")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?> <?=($ide==2)?" class='alert alert-success'":""?>>
        <td>b)<input type="radio" name="respuesta" value="B" <?=($pregunta[$i]['marcado']=="2")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[1] ?>
            </font>
        </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="3")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?> <?=($ide==3)?" class='alert alert-success'":""?>> 
        <td>c)<input type="radio" name="respuesta" value="C" <?=($pregunta[$i]['marcado']=="3")?"checked":""?>/></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $alternativas_sort_us[2] ?> </font>
    </td>
    </tr>
    <tr <?=($pregunta[$i]['marcado']=="4")? ($res)?" class='alert alert-success'":" class='alert alert-danger'":""?> <?=($ide==4)?" class='alert alert-success'":""?>>
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
    <span class="badge"><?php echo $restante ?></span>
    Restantes
  </li>
</ul>

</div><!--Fin columna resultados-->
</div><!--Fin div row preguntas-->

<div class="row"><!--Div botonos finales-->

    <div class="col-md-9 col-md-push-4">
    <?php 
        if($pregunta[$i]['revision']==1 && $pregunta[$i]['marcado']==0){
            echo "Ud. Dejo esta pregunta en revisión sin respuesta...";
        }
        if($pregunta[$i]['estado']==0){
            echo "Ud. no marcó ninguna respuesta...";
        }

    ?>

    <?php  echo "<br>Aqui sacar comentario...." ?>
          
</form>
   
   </div>  
</div><!--Fin div botones finales-->

<div class="row text-center">
    <div class="col-md-9 col-md-push-3">
        <ul class="pagination">
        <?php if($ini>=1){ ?>
          <li><a href="_proxy.php?controlador=Alumno&accion=listarPreguntasTer&simulacion_id=<?=$pregunta[$i]['simulacion_id'] ?>&ini=<?=$ini-1?>">&laquo;</a></li>
        <?php }else{ ?>
          <li class="disabled"><a href="#">&laquo;</a></li>
        <?php }?>
          <?php
          for($k=0; $k<$totals; $k++) {?>
            <li <?=($k==$ini)?'class="active"':''?>><a href="_proxy.php?controlador=Alumno&accion=listarPreguntasTer&simulacion_id=<?=$pregunta[$i]['simulacion_id'] ?>&ini=<?=$k?>"><?=$k+1?></a></li>
          <?php } ?>
        <?php if($ini<$totals-1){ ?>
          <li><a href="_proxy.php?controlador=Alumno&accion=listarPreguntasTer&simulacion_id=<?=$pregunta[$i]['simulacion_id'] ?>&ini=<?=$ini+1?>">&raquo;</a></li>
        <?php }else{ ?>
          <li class="disabled"><a href="#">&raquo;</a></li>
        <?php }?>
        </ul>
    </div>
</div>
<?php   } //fin for?> 
<?php } //fin if?> 
</div> 

</body>
</html>
