<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
$msgData="";
?>
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache"/>
        <title>COINTEM &reg; </title>
        <script type="text/javascript" src="../../recursos/js/jquery.js"></script>
        <script type="text/javascript" src="../../recursos/js/vanadium.js"></script>
         <script type="text/javascript" src="../../recursos/ajax/inscripcion.js"></script>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/formVanadium.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/style.css"/>
        <script type="text/javascript" language="JavaScript">   
            function ver(){
                $("#numdep").focus();
                $("#numdep").val("");                
            }
        </script>
        
</head>
    
    <body onload="ver()">   
    <div>

        <form id="valid" action="javascript:impNd()" >
        <table border="0">
            <thead>
                <tr>
                    <th colspan="4">Importar Numeros de Deposito</th>
                </tr>
            </thead>
            <tbody>
                <tr>                    
                    <td colspan="4">Pegar Numeros de Deposito</td>
                </tr>
                <tr>                    
                    <td colspan="4">
                        <textarea name="numdep" class=":required" id="numdep"  rows="4" cols="20">

                        </textarea>                       
                    </td>
                </tr>
                
                <tr>                    
                    <td colspan="4">
                        <input type="button" value="Validar" name="validar" />
                        <input type="submit" value="Importar" name="importar" />
                    </td>

                </tr>                
            </tbody>
        </table>            
        </form>
        <br/>
        <div>
            <?php echo $msgData ?>
        </div>
        
    </div>

</body>
</html>