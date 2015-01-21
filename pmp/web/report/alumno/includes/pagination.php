<?php

define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'python');
define('DB_SERVER_PASSWORD', '123456');
define('DB_DATABASE', 'simulador');

$conexion = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);

mysql_select_db(DB_DATABASE, $conexion);

$query_num_services =  mysql_query("select * from sim_resultado where simulacion_id=16", $conexion);
$num_total_registros = mysql_num_rows($query_num_services);

//Si hay registros
 if ($num_total_registros > 0) {
    //numero de registros por página
    $rowsPerPage = 1;

    //por defecto mostramos la página 1
    $pageNum = 1;

    // si $_GET['page'] esta definido, usamos este número de página
    if(isset($_GET['page'])) {
        sleep(1);
        $pageNum = $_GET['page'];
    }
        
    //echo 'page'.$_GET['page'];

    //contando el desplazamiento
    $offset = ($pageNum - 1) * $rowsPerPage;
    $total_paginas = ceil($num_total_registros / $rowsPerPage);

                    
    $query_services = mysql_query(" select * from sim_resultado sr, pregunta pr where pr.pregunta_id=sr.pregunta_id and sr.simulacion_id = 16 ORDER BY  sim_resultado_id asc LIMIT $offset, $rowsPerPage", $conexion);
   while ($row_services = mysql_fetch_array($query_services)) {
                        //$service = new Service($row_services['service_id']);
        
    
        $contador = 0;
        
        // Reconstruimos la cadena
          echo ' 
              
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
                <strong>'. $row_services['pregunta_es'].'</strong></font>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20">a) 
        <button onclick="abrir_dialoga()">Ver comentarios</button>
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
              '. $row_services['opcion_aes'].'</font>
            <div id="opca" title="Titulo dialog" style="display:none;">
                <p>'. $row_services['opcion_aes'].'</p>
            </div>
        </td>
    </tr>
    <tr>
        <td>b)<button onclick="abrir_dialogb()">Ver comentarios</button></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            '.$row_services['opcion_bes'] .'
            </font>
            <div id="opcb" title="Titulo dialog" style="display:none;">
                <p>'. $row_services['opcion_bes'].'</p>
            </div>
        </td>
    </tr>
    <tr> 
        <td>c)<button onclick="abrir_dialogc()">Ver comentarios</button></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
           '. $row_services['opcion_ces'].' </font>
           <div id="opcc" title="Titulo dialog" style="display:none;">
                <p>'. $row_services['opcion_ces'].'</p>
            </div>

    </td>
    </tr>
    <tr>
        <td>d)<button onclick="abrir_dialogd()">Ver comentarios</button></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          '. $row_services['opcion_des'] .'</font>
          <div id="opcd" title="Titulo dialog" style="display:none;">
                <p>'. $row_services['opcion_des'].'</p>
            </div>

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
                <strong>'. $row_services['pregunta_us'].' </strong></font>
            </div>
        </td>
    </tr>
    <tr>
        <td width="20">a) <input name="respuesta" type="radio" value="a" checked="checked" />
        </td>
        <td width="272">
            <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
              '.  $row_services['opcion_aus'].' </font>
        </td>
    </tr>
    <tr>
        <td>b)<input type="radio" name="respuesta" value="b" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
           '.$row_services['opcion_bus'] .'
            </font>
        </td>
    </tr>
    <tr> 
        <td>c)<input type="radio" name="respuesta" value="c" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
           '. $row_services['opcion_cus'].' </font>
    </td>
    </tr>
    <tr>
        <td>d)<input type="radio" name="respuesta" value="d" /></td>
        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
            '.$row_services['opcion_dus'].' </font>
        </td>
    </tr>
   
    </div>
 </table>



        ';
    }
    
     if ($total_paginas > 1) {
                        echo '<div class="pagination">';
                        echo '<ul>';
                            if ($pageNum != 1)
                                    echo '<li><a class="paginate" data="'.($pageNum-1).'">Anterior</a></li>';
                                for ($i=1;$i<=$total_paginas;$i++) {
                                    if ($pageNum == $i)
                                            //si muestro el índice de la página actual, no coloco enlace
                                            echo '<li class="active"><a>'.$i.'</a></li>';
                                    else
                                            //si el índice no corresponde con la página mostrada actualmente,
                                            //coloco el enlace para ir a esa página
                                            echo '<li><a class="paginate" data="'.$i.'">'.$i.'</a></li>';
                            }
                            if ($pageNum != $total_paginas)
                                    echo '<li><a class="paginate" data="'.($pageNum+1).'">Siguiente</a></li>';
                       echo '</ul>';
                       echo '</div>';
                    }
    
}