
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>MVC - Modelo, Vista, Controlador - Jourmoly</title>

        <link rel="stylesheet" href="../../recursos/css/jquery-ui.css"/>     
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formsSearch.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/listas.css"/>       

<style type="text/css"> 

html { 
      background: url(paisajes-playas-palmeras.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
}

body {
	font-family:Tahoma, Geneva, sans-serif;
}

.contenido {
	width:460px;
	margin:0 auto;
}



.boton:hover{color:#01DF01}

.ventana{

	display:none;      
	font-family:Arial, Helvetica, sans-serif;
	color:#808080;
	line-height:28px;
	font-size:15px;
	text-align:justify;


}



</style>
    </head>

    <body>  



        <?php
        if (count($pregunta) != 0) {


            for ($i = 0; $i < count($pregunta); $i++) {
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
                                    
                                    <td width="20"> a) <input type="button" onclick="mostrar()" value="ver" >
                                    </td>
                                    <td width="272">
                                        <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $pregunta[$i]['opcion_aes'] ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b)<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $pregunta[$i]['comentario_bes'] ?></font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                            <?php echo $pregunta[$i]['opcion_bes'] ?>
                                        </font>
                                    </td>
                                </tr>
                                <tr> 
                                    <td>c)<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $pregunta[$i]['comentario_ces'] ?></font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                            <?php echo $pregunta[$i]['opcion_ces'] ?> </font>
                                    </td>
                                </tr>
                                <tr>
                                    <td>d)<font size="2" face="Verdana, Arial, Helvetica, sans-serif">
        <?php echo $pregunta[$i]['comentario_des'] ?></font></td>
                                    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                            <?php echo $pregunta[$i]['opcion_des'] ?> </font>
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
                                                <strong> <?php echo $pregunta[$i]['pregunta_us'] ?> </strong></font>
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
        <?php echo $pregunta[$i]['opcion_dus'] ?> </font>
                                    </td>
                                </tr>

                            </div>
                        </table>

                        <table width="50%" border="0" align="center" cellpadding="3" cellspacing="" >

                            <tr><div align="center">



                                    <td>

                                        <input type=hidden name="simulacion_id" value="<?php echo $pregunta[$i]['simulacion_id'] ?>"/>
                                        <input type="hidden" name="controlador" id="controlador" value="Alumno" />
                                        <input type="hidden" name="accion" id="accion" value="siguientePreg" />
                                        <input type="button" name="respuesta" value="Atras" />
                                        <input type="submit" name="Submit" value="Siguiente" />


                                    </td>
                            </tr>
                        </table>
                </form>
              
		<div id="dialogo" class="ventana" title="Dialogo Modal">
			
			<p>Esto es un dialogo modal, por lo que la web queda bloqueada mientras esta abierta</p>
		
		</div>
        <?php
    }
}
?>  

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript"> 
	

        function mostrar(){
            
             var dialogo2="dialogo";
            $("#"+dialogo2).dialog({ <!--  ------> muestra la ventana  -->
			width: 590,  <!-- -------------> ancho de la ventana -->
			height: 350,<!--  -------------> altura de la ventana -->
			show: "scale", <!-- -----------> animación de la ventana al aparecer -->
			hide: "scale", <!-- -----------> animación al cerrar la ventana -->
			resizable: "false", <!-- ------> fija o redimensionable si ponemos este valor a "true" -->
			position: "center",<!--  ------> posicion de la ventana en la pantalla (left, top, right...) -->
			modal: "true" <!-- ------------> si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
		});
        }

	
	
	</script>
    </body>
</html>