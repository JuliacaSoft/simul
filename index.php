<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login Form</title>    
        <link rel="icon" href="http://www.atenos.com/wp-content/themes/theme1369/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="recursos/css/login.css">
        <script type="text/javascript" src="recursos/js/jquery.js"></script>
        <link rel="shortcut icon" href="recursos/img/icons/favicon.png">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <?php 
    $msg="";
    
    
    
    if(! empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg']; 
    }
    ?>
    <body>
        <section class="container">
            <center>
            <div class="login" >
                <img src="recursos/img/logos/gruposcon.png" height="120px" style="border-radius: 10px;"/><br/><br/><br/>
                <h1><img src="recursos/img/logos/logo_test_pmi.png" height="15px"/><br/>Ingreso al Sistema Test PMI - Atenos </h1>
                
                <form method="post" action="javascript:validaxion()" name="fm" >
                    <p>
                    
                    <input type="text" class="myinput" name="username" id="username" size="15" autocomplete="off" placeholder="Username">
                    </p>
                    <p>                        
                        <input type="password"  class="myinput" name="password" id="password" size="15" autocomplete="off" placeholder="Password">
                    </p>
                    <p class="remember_me">
                        <label>
                            <input type="checkbox" name="remember_me" id="remember_me">
                            Recordar la contraseña en este equipo
                        </label>
                    </p>
                    <input type="hidden" name="opt" value="1"/>
                    <input type="hidden" name="controlador" value="Index"/>
                    <input type="hidden" name="accion" value="login"/>
                    <p class="submit">
                        <input type="submit" name="commit" value="Login">
                     
                    </p>
                    <p style="color: #DC143C; margin: 0 0 0 0 ;">
                    <a id="login_error"></a>
                        <?php if($msg!=null){ echo $msg;}?></p>
                </form>
            </div>
                </center>
            <div class="login-help">
                <p>¿Has olvidado tu contraseña? <a href="MAILTO:josmarl567@gmail.com">Haz click aqui para recuperarla</a>.</p>
            </div>
        </section>
        <section class="about">
            <p class="about-links">
                <a href="http://www.atenos.com/" target="_blank">Atenos</a>
                <a href="#" target="_parent">Mas informacion</a>
            </p>
            <p class="about-author">
                2014 <a href="#" target="_blank">AtenosConsulting </a>
                <a href="#" target="_blank">@Todos los derechos reservados </a><br>
                Original Software by <a href="#" target="_blank">Atenos Consulting & Services</a>
        <a href="pmp/web/_proxy.php?controlador=Index&accion=login">Inicio</a>
              
            </p>
        </section>
    </body>
<script type="text/javascript">
function validaxion(){
     var error = "";
     //$('#llave').val("");
	if (!$("#username").val()){
		error += "Introduce el usuario<br>";
		$('#username').focus();
	}
	if (!$("#password").val()){
		error += "Introduce la contraseña";
		if ($("#username").val())
		 $('#password').focus();
	}
    if(error.length > 0){
	   $("#login_error").html('');
	   $("#login_error").append(error);
	   $("#login_error").slideDown();           
	}else{
	$('#login_error').css('display','none');
	$('#login_cargando').css('display','block');
        var objParameter = "";

        $.ajax({
		type: 'POST',
		url: 'pmp/web/_proxy.php',
		cache: false,
		data: 'controlador=Usuario&accion=validaxion&username='+ encodeURIComponent($('#username').val()) + '&password=' + encodeURIComponent($('#password').val()),
		success: function(h){  
                    //alert(h);
                    objParameter=$.trim(h).split("->");                    
                    if($.trim(objParameter[0])=="5"){
                                if($.trim(objParameter[1])=='Exito'){
                                        window.location=$.trim(objParameter[2]);
                                }
                                else {
				$('#login_error').html("Acceso no Autorizado");
				$('#login_error').css('display','block');                                
                                }                         
                         }else{
				$('#login_error').html($.trim(objParameter[1]));
				$('#login_error').css('display','block');
				$('#username').focus();                                
                         } 
            }
         })        
	}
}

</script>
</html>
