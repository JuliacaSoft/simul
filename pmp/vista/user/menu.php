
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/layout.css"/>
        <link rel="stylesheet" type="text/css" href="../../recursos/css/menu.css"/>
    </head>
    <body id="menu">
        <ul id="nav">
            <li><a style="background: brown;" href="#"><img src="../../recursos/img/icons/t0.png" />MENU PRINCIPAL</a></li>
            <li><a href="_proxy.php?controlador=Index&accion=login"><img src="../../recursos/img/icons/t1.png" /> Home</a></li>
            <?php
                    if($_SESSION["nivelfsx"]=="1"){
                    
             ?>
            <li><a href="#" class="sub" tabindex="1"><img src="../../recursos/img/icons/t2.png" />Administrar</a><img src="../../recursos/img/icons/up.gif" alt="" />
                <ul>
                    <!--<li><a href="pmp/web/_proxy.php?controlador=Index&accion=login" target="content"><img src="../../recursos/img/icons/t9.png" />Link 1</a></li>-->
                    <li><a href="_proxy.php?controlador=Usuario&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Usuario</a></li>
                     <li><a href="_proxy.php?controlador=Area&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Area</a></li>
                    <li><a href="_proxy.php?controlador=Grupo&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Grupo</a></li>
                    <!--<li><a href="../vista/grupo/sample.php" target="content"><img src="../../recursos/img/icons/t9.png" />Grupo De</a></li>-->
                    <li><a href="../web/cargamas/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Carga Masiva</a></li>
                    <!--<li><a href="_proxy.php?controlador=Index&accion=cargamasiva" target="content"><img src="../../recursos/img/icons/t9.png" />Carga masiva Ant</a></li>-->
                    <li><a href="_proxy.php?controlador=Pregunta&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Pregunta</a></li>
                    
                    <li><a href="_proxy.php?controlador=Role&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Roles</a></li>
                    <li><a href="_proxy.php?controlador=Curso&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Curso</a></li>
                    <li><a href="_proxy.php?controlador=Ensayo&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Ensayo</a></li>
                    <!--<li><a href="_proxy.php?controlador=Regla&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Regla</a></li>-->
                    <!--<li><a href="_proxy.php?controlador=Usuario&accion=TestAlumno" target="content"><img src="../../recursos/img/icons/t9.png" />Perfil Alumno</a></li>
                    <li><a href="_proxy.php?controlador=Asistencia&accion=formAsi" target="content"><img src="../../recursos/img/icons/t9.png" />Link 4</a></li>
                    <li><a href="_proxy.php?controlador=Confirmacion&accion=preConf" target="content"><img src="../../recursos/img/icons/t9.png" />Link 5</a></li>-->

                </ul>
            </li>
            
            <li><a href="#" class="sub" tabindex="1"><img src="../../recursos/img/icons/t3.png" />Perfil Alumno</a><img src="../../recursos/img/icons/up.gif" alt="" />
                <ul>
                    
                    <li><a href="_proxy.php?controlador=Alumno&accion=listarCursos" target="content"><img src="../../recursos/img/icons/t9.png" />Mis Simulaciones</a></li>
                    <!--<li><a href="_proxy.php?controlador=Simulacion&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Simulacion</a></li>-->
                    <li><a href="_proxy.php?controlador=Resultado&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Resultado</a></li>
                    <li><a href="_proxy.php?controlador=Alumno&accion=listarCursosTerminados" target="content"><img src="../../recursos/img/icons/t9.png" />Revisar mis Simulaciones</a></li>
                    
                    <li><a href="../web/report/reportes/reporteUsuario.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gráfica</a></li>
                    <li><a href="../web/report/graficas/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gra</a></li>
                    
                    <li><a href="../web/report/graficas1/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gra PHP</a></li>
                    
                    <li><a href="../web/report/maxmin/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Max Min</a></li>
                    <li><a href="../web/report/maxmin2/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Max Min2</a></li>
                    <li><a href="../web/report/area/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Area</a></li>
                    <li><a href="../web/report/column/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column</a></li>
                    <li><a href="../web/report/columnbasic/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Basic</a></li>
                    <li><a href="../web/report/columnrotate/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Rotate</a></li>
                    
                    <li><a href="../web/report/columnrotate2/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Rotate2</a></li>
                    <li><a href="../web/report/columnstacked/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Stacked</a></li>
                    
                    

                </ul>
            </li>
            
            <?php } ?>
             <?php
                    if($_SESSION["nivelfsx"]=="3"){
                    
             ?>
            <li><a href="#" class="sub" tabindex="1"><img src="../../recursos/img/icons/t3.png" />Perfil Alumno</a><img src="../../recursos/img/icons/up.gif" alt="" />
                <ul>
                    
                    <li><a href="_proxy.php?controlador=Alumno&accion=listarCursos" target="content"><img src="../../recursos/img/icons/t9.png" />Mis Simulaciones</a></li>
                    <!--<li><a href="_proxy.php?controlador=Simulacion&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Simulacion</a></li>-->
                    <li><a href="_proxy.php?controlador=Resultado&accion=listarTwoU" target="content"><img src="../../recursos/img/icons/t9.png" />Resultado</a></li>
                    <li><a href="_proxy.php?controlador=Alumno&accion=listarCursosTerminados" target="content"><img src="../../recursos/img/icons/t9.png" />Revisar mis Simulaciones</a></li>
                    
                    <li><a href="../web/report/reportes/reporteUsuario.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gráfica</a></li>
                    <li><a href="../web/report/graficas/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gra</a></li>
                    
                    <li><a href="../web/report/graficas1/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Gra PHP</a></li>
                    
                    <li><a href="../web/report/maxmin/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Max Min</a></li>
                    <li><a href="../web/report/maxmin2/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Max Min2</a></li>
                    <li><a href="../web/report/area/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Area</a></li>
                    <li><a href="../web/report/column/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column</a></li>
                    <li><a href="../web/report/columnbasic/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Basic</a></li>
                    <li><a href="../web/report/columnrotate/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Rotate</a></li>
                    
                    <li><a href="../web/report/columnrotate2/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Rotate2</a></li>
                    <li><a href="../web/report/columnstacked/index.php" target="content"><img src="../../recursos/img/icons/t9.png" />Ver Column Stacked</a></li>
                    
                    

                </ul>
            </li>
             <?php } ?>
<!--            <li><a href="#" class="sub" tabindex="1"><img src="../../recursos/img/icons/t3.png" />Mantenimiento</a><img src="../../recursos/img/icons/up.gif" alt="" />
                <ul>
                    <li><a href="../../InstitucionController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png" />Institucion</a></li>
                    <li><a href="../../FilialController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png" />Filial</a></li>
                    <li><a href="../../SedeController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png" />Sede</a></li>
                    <li><a href="../../CampaniaController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png" />Campaña</a></li>
                    <li><a href="../../PeriodoAnualController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png"/>Periodo</a></li>
                </ul>
            </li>
            <li><a href="#" class="sub" tabindex="1"><img src="../../recursos/img/icons/t4.png" />Gastos e Ingresos</a><img src="../../recursos/img/icons/up.gif" alt="" />
                <ul>
                    <li><a href="../../ActividadController?opt=1" target="content"><img src="../../recursos/img/icons/t9.png" />Gastos en pasajes</a></li>
                    <li><a href="#"><img src="../../recursos/img/icons/t9.png" />Link 2</a></li>
                    <li><a href="#"><img src="../../recursos/img/icons/t9.png" />Link 3</a></li>
                    <li><a href="#"><img src="../../recursos/img/icons/t9.png" />Link 4</a></li>
                    <li><a href="#"><img src="../../recursos/img/icons/t9.png" />Link 5</a></li>
                </ul>
            </li>
            <li><a href="#"><img src="../../recursos/img/icons/t5.png" />Inventario</a></li>
            <li><a href="#"><img src="../../recursos/img/icons/t6.png" />Estadisticas</a></li>
            <li><a href="#"><img src="../../recursos/img/icons/t7.png" />Reportes</a></li>-->
            <li><a href="_proxy.php?controlador=Index&accion=salir" onclick="return confirm('¿Desea salir del Sistema TestPMI Atenos?')"><img src="../../recursos/img/icons/t8.png" />Logout</a></li>
        </ul>

    </body>
</html>

