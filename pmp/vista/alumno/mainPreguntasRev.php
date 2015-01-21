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
        
</head>
        
<body>  

    
    <div id="central">
<?php

 
 $cond=0;

  if(count($pregunta)!=0){
                
            
 for ($i = 0; $i < count($pregunta); $i++) {
 
     if($cond==0){
 
     

?>
    
 
    
<form name="form" method="post" action="_proxy.php">
    
<h1 align="center">Simulador Online PMP - Atenos</h1> 
            

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
    <tr>
        <td width="20">a) <input name="respuesta" type="radio" disabled value="1" checked="checked" />
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php echo $pregunta[$i]['opcion_aes']?></font>
        </td>
    </tr>
    <tr>
        <td>b)<input type="radio" name="respuesta" disabled value="2" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $pregunta[$i]['opcion_bes'] ?>
            </font>
        </td>
    </tr>
    <tr> 
        <td>c)<input type="radio" name="respuesta" disabled value="3" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $pregunta[$i]['opcion_ces']?> </font>
    </td>
    </tr>
    <tr>
        <td>d)<input type="radio" name="respuesta" disabled value="4" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $pregunta[$i]['opcion_des']?> </font>
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
        <td width="20">a) <input name="respuesta" type="radio" value="a" checked="checked" />
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php echo $pregunta[$i]['opcion_aus'] ?></font>
        </td>
    </tr>
    <tr>
        <td>b)<input type="radio" name="respuesta" value="b" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $pregunta[$i]['opcion_bus'] ?>
            </font>
        </td>
    </tr>
    <tr> 
        <td>c)<input type="radio" name="respuesta" value="c" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $pregunta[$i]['opcion_cus'] ?> </font>
    </td>
    </tr>
    <tr>
        <td>d)<input type="radio" name="respuesta" value="d" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php  echo $pregunta[$i]['opcion_dus'] ?> </font>
        </td>
    </tr>
   
    </div>
 </table>
 
 <table width="50%" border="0" align="center" cellpadding="3" cellspacing="" >
   
        <tr><div align="center">

            <td>r)<input type="radio" name="respuesta" value="r" />
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                <?php  echo "Revision" ?> </font>
            </td>
                           
        <td>
                <input type=hidden name="pregunta_id" value="<?php echo $pregunta[$i]['pregunta_id'] ?>"/>
                <input type=hidden name="simulacion_id" value="<?php echo $pregunta[$i]['simulacion_id'] ?>"/>
                <input type="hidden" name="controlador" id="controlador" value="Alumno" />
                <input type="hidden" name="accion" id="accion" value="cambiarCondicionPregunta" />
            <input type="submit" name="Submit" value="Siguiente" />
            
          
        </td>
    </tr>
    
    
    </table>
</form>
    <div class="resultados">
    <table>
    <thead>
        <th>Resulstados</th>
    </thead>
    <tbody>
        <tr>
            <th>Tiempo</th>
            <td> <input type="text"> </td>
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
            <th>Restantes</th>
            <td>  <?php echo $restante ?> </td>
        </tr>
        
    </tbody>
</table>
</div>
    
<?php 
    $cond=1;
    break;
        }    


     }
     
     }else{
         
         if($datos==0){
             ?>
             
             Final
    <?php
         }else{
?>    
    
    
    <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=listarPreguntasRev&simulacion_id='+<?php echo $simulacion_id ?>">Ver Revisiones</button> 
    
    
    
     <?php 
     
         } 
     
         }?>    
</body>
</html>