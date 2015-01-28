<html>
    <head>
        <title>Resultados PMP Online</title>
    </head>
    <body>

    
        <table>
            <tr>
                <th colspan="2">Resultados</th>
            </tr>
            <tr>
                <th>Puntaje </th>
                <td><?php echo $puntaje; ?></td>
            </tr>
            <tr>
                <th>Puntaje Porcentual </th>
                <td><?php echo $porcentaje; ?></td>
            </tr>
            <tr>
                <?php if($porcentaje>=$aprobacion){ ?>
                <td>Aprobo</td>
                <?php }else{ ?>
                <td>Desaprobo</td>
                <?php } ?>
            </tr>
        </table>
        <button>Revisar Pregunta</button>
        <button type="button" onclick="location.href='_proxy.php?controlador=Alumno&accion=listarPreguntasTer&simulacion_id='+<?php  echo $simulacion_id ?>">Ver Examen </button>               
        <button>Intentar de Nuevo</button>
    </body>
</html>
