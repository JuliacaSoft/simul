<html>
    <head>
        <title>Resultados PMP Online</title>
    </head>
    <body>

    <table bgcolor="#c90119" width=100% height="55">
        <td valign="middle">
            <h1 style="text-align: center;"><span style="color: #ffffff;"><strong>ATENOS INGENIERÍA</strong></span></h1>
        </td>
    </table>
    &nbsp;
    
    <table border="0" bgcolor="">
    <td bgcolor="" width=5%>
    </td>
    <td bgcolor="" width=90%>
    <h3><strong>Quienes somos</strong></h3>
    &nbsp;
    <strong><span style="color: #c90119;">Atenos Ingeniería </span></strong>es una empresa chilena que presta servicios integrales en ingeniería multidisciplinaria en diversos tipos de proyectos, industrias y especialidades.
    &nbsp;
    <strong><span style="color: #c90119;">Nuestra misión</span></strong> es proveer soluciones integrales a nuestros clientes en el desarrollo de todas las etapas de <strong><span style="color: #c90119;">Ingeniería</span></strong>, así como también ser un apoyo efectivo durante la etapa de <strong><span style="color: #c90119;">Construcción.</span></strong>
    </td>
    <td bgcolor="" width=5%>
    </td>
    </table>






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
