<?php //require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <title>Jose Aguilar - Paginación de resultados con jQuery, Ajax y PHP</title> 
        <link type="text/css" href="css/styles.css" rel="stylesheet" />

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript">

$(document).ready(function() {	
	$('.paginate').live('click', function(){
		
		$('#content').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/></div>');

		var page = $(this).attr('data');		
		var dataString = 'page='+page;
		
		$.ajax({
            type: "GET",
            url: "includes/pagination.php",
            data: dataString,
            success: function(data) {
				$('#content').fadeIn(1000).html(data);
            }
        });
    });              
});    
</script>
       <script>
    function abrir_dialoga() {
      $( "#opca" ).dialog({
          show: "blind",
          hide: "explode"
      });
    };
    function abrir_dialogb() {
      $( "#opcb" ).dialog({
          show: "blind",
          hide: "explode"
      });
    };
    function abrir_dialogc() {
      $( "#opcc" ).dialog({
          show: "blind",
          hide: "explode"
      });
    };
    function abrir_dialogd() {
      $( "#opcd" ).dialog({
          show: "blind",
          hide: "explode"
      });
    };
    </script> 
    </head>
<body>
        <div id="central">
            <div class="service_category">Simulador - Preguntas</div>
            <div id="content"><?php require('includes/pagination.php'); ?></div>
					
        </div>
      
</body>
</html>