<?php
//Primero algunas variables de configuracion
//require 'conexion.php';


//La carpeta donde buscaremos los controladores
$carpetaControladores = "../controlador/";

//Si no se indica un controlador, este es el controlador que se usar�
$controladorPredefinido = "Trabajador";

//Si no se indica una accion, esta accion es la que se usar�
$accionPredefinida = "listarTwo";

if(! empty($_REQUEST['controlador']))
    $controlador = $_REQUEST['controlador'];
else {
    $controlador = $controladorPredefinido;
}



if(! empty($_REQUEST['accion']))
    $accion = $_REQUEST['accion'];
else {
    $accion = $accionPredefinida;
}
$instanciaControladorNew=$controlador.'Controlador';

//Ya tenemos el controlador y la accion

//Formamos el nombre del fichero que contiene nuestro controlador
$controlador = $carpetaControladores . $controlador . 'Controlador.php';
$instanciaControlador=null;
//Incluimos el controlador o detenemos todo si no existe
if(is_file($controlador)) {
    require_once $controlador;
    $instanciaControlador=new $instanciaControladorNew();
}
else {
    die('El controlador no existe - 404 not found--->');
}

//Llamamos la accion o detenemos todo si no existe
if(is_callable($instanciaControladorNew.'::'.$accion)) {
    $instanciaControlador->$accion();
}
else {
    die('La accion no existe - 404 not found');
}

?>