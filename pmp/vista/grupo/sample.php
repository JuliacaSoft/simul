<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Smart Alert Demos</title>
        <meta charset="utf-8" />
        
        <link href="../../../recursos/confir/css/page.css" rel="stylesheet"/>
        <link href="../../../recursos/confir/alert/css/alert.css" rel="stylesheet"/> <!-- Estilo al popup-->
        <link href="../../../recursos/confir/alert/themes/default/theme.css" rel="stylesheet"/> <!-- No sale popup-->
        <script src="../../../recursos/confir/js/jqueryS.js"></script> 
        <!--<script src="js/jquery-ui.js"></script>-->
        <script src="../../../recursos/confir/alert/js/alert.js"></script>
        <script src="../../../recursos/confir/js/page.js"></script>
        
    </head>
    <body>
        <div id="page">

                <button onclick="eliminar(1)" class="button blue">Eliminar</button>
                <button onclick="eliminar(2)" class="button blue">Boton</button>
                <a href="#demo-callback_confirm" class="button blue">Ver</a>
                <button href="#demo-callback_confirm" class="button blue">Ver</button>
       
         </div>
<script>
    function eliminar(dato){
        if(dato==1){
               // $.alert.open({ content: 'Lorem ipsum dolor sit amet' }); 
            $.alert.open('confirm', 'Lorem ipsum dolor sit amet?', function(button) {
                        if (button == 'yes')
                            $.alert.open('You pressed the "Yes" button.');
                        else if (button == 'no')
                            $.alert.open('You pressed the "No" button.');
                        else
                            $.alert.open('Alert was canceled.');
                    });

        }if (dato==2){
            alert("I am an alert box!");

        }
         
    }
       

</script>

    </body>
</html>