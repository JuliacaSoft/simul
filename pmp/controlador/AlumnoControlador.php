<?php

require_once "../modelo/PreguntaDAO.php";

class AlumnoControlador {

    public $model;
    public $intentos;

    public function __construct() {
        require_once('Seguridad.php');
        s_pagina_validar();
        $this->model = new PreguntaDAO();
    }

    public function listarCursos() {

        //Usuario Id Necesario por la funcion

        $usuario_id = $_SESSION['UserAct'][0]['usuario_id'];
        $cursos = $this->model->listarCursosEnsayo($usuario_id);
        $simulacion = $this->model->ultimasimulacionUsuario($usuario_id);

        require_once '../vista/alumno/mainAlumno.php';
    }

    public function listarCursosTerminados() {

        $cursos = $this->model->listarCursosEnsayoTerminado(1);
        require_once '../vista/alumno/listaEnsayoTerminados.php';
    }

    function listarTwoU() {
        $area = $this->model->listarPreguntaTwo();
        require_once '../vista/alumno/mainAlumno.php';
    }

    function formPregunta() {
        $area = $this->model->listarPregunta();
        require_once '../vista/alumno/mainAlumno.php';
    }

    function listarExamenPregunta() {

        $tipo = $_REQUEST['tipo'];
        $cantidad = $_REQUEST['cantidad'];
        $pregunta = $this->model->generarSimulation($tipo, $cantidad);

        require_once '../vista/alumno/mainAlumno.php';
    }

    function listarSimuladorGenerate() {

        $tipo = $_REQUEST['tipo'];
        $cantidad = $_REQUEST['cantidad'];
        $ensayo_id = $_REQUEST['ensayo_id'];
        $usuario_id = $_REQUEST['usuario_id'];
        $t_dependencia = $_REQUEST['t_dependencia'];
        $simulador = $this->model->generarSimulacionX($tipo, $cantidad, $ensayo_id, $usuario_id, $t_dependencia);
        echo $simulador[0]['condicion'];
    }

    function listarPreguntasTer() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta = $this->model->reportarPregungtasSimulationRev($simulacion_id);
        $datos = 0;
        require_once '../vista/alumno/listaPreguntasTerminados.php';
    }

    function listarPreguntas() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta = $this->model->reportarPreguntaSimulation($simulacion_id);

        $pregunta2=$this->model->reportarPreguntaSimulationRev2($simulacion_id);
        $datos = 0;

        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];

        $rev = $this->model->tiempoSimulacion($simulacion_id);
        $tiempofin = $rev[0]['tiempofin'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadasRev($simulacion_id, 1);
        $totalrev = $rev[0]['totalrev'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 0);
        $restante = $rev[0]['totalCont'];


        if ($restante != 0) {
            $intentos = $this->model->mostrarCantidadIntento($pregunta[0]['ensayo_id']);
        } else {
            $ksk;
        }
        $rev = $this->model->totalSimulacionContestadasPerdidas($simulacion_id);
        $perdidos = $rev[0]['totalCont'];


        require_once '../vista/alumno/mainPreguntas.php';
    }

    function listarPreguntasRev() {
        $opc = $_REQUEST['opc'];
        $simulacion_id = $_REQUEST['simulacion_id'];
        if ($opc == 100) {
            $this->model->actualizarRevision($simulacion_id);
        }


        $pregunta = $this->model->reportarPreguntaSimulationRev($simulacion_id);

        $intentos = $this->model->mostrarCantidadIntento($pregunta[0]['ensayo_id']);
        $datos = 0;
        $pregunta2=$this->model->reportarPreguntaSimulationRev2($simulacion_id);
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];
        $rev = $this->model->tiempoSimulacion($simulacion_id);
        $tiempofin = $rev[0]['tiempofin'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadasRev($simulacion_id, 1);
        $totalrev = $rev[0]['totalrev'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 0);
        $restante = 0;

        $rev = $this->model->totalSimulacionContestadasPerdidas($simulacion_id);
        $perdidos = $rev[0]['totalCont'];

        require_once '../vista/alumno/mainPreguntasRev.php';
    }

    function cambiarCondicionPregunta() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta_id = $_REQUEST['pregunta_id'];
        $respuesta = isset($_REQUEST['respuesta']) ? $_REQUEST['respuesta'] : "0";
        $plantilla = $_REQUEST['plantilla'];
        $revision = isset($_REQUEST['revision']) ? $_REQUEST['revision'] : "0";
        $pregunta2=$this->model->reportarPreguntaSimulationRev2($simulacion_id);

        if ($revision == "R") {
            if ($respuesta != "0") {
                $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, $respuesta, 2, $plantilla, 1);
            } else {
                $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, 0, 1, $plantilla, 1);
            }
        } else {
            if ($respuesta != "0") {
                $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, $respuesta, 2, $plantilla, 0);
            } else {
                $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, 0, 1, $plantilla, 0);
            }
        }
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadasRev($simulacion_id, 1);
        $totalrev = $rev[0]['totalrev'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 0);
        $restante = $rev[0]['totalCont'];
        $rev = $this->model->totalSimulacionContestadasPerdidas($simulacion_id);
        $perdidos = $rev[0]['totalCont'];

        $pregunta = $this->model->reportarPreguntaSimulation($simulacion_id);
        if ($restante != 0) {
            $intentos = $this->model->mostrarCantidadIntento($pregunta[0]['ensayo_id']);
        } else {
            $ksk;
        }
        $rev = $this->model->reportarCantidadRevision($simulacion_id);

        $datos = $rev[0]['cantidadrev'];
        require_once '../vista/alumno/mainPreguntas.php';
    }

    function siguientePreg() {
        $simulacion_id = $_REQUEST['simulacion_id'];

        $pregunta = $this->model->reportarPregungtasSimulationRev($simulacion_id);


        require_once '../vista/alumno/mainAlumnoPregTerm.php';
    }

    function cambiarCondicionPreguntaRevis() {

        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta_id = $_REQUEST['pregunta_id'];
        $respuesta = isset($_REQUEST['respuesta']) ? $_REQUEST['respuesta'] : "0";
        //$plantilla = $_REQUEST['plantilla'];
        $revision = isset($_REQUEST['revision']) ? $_REQUEST['revision'] : "0";


        if ($revision == "R") {
            if ($respuesta != "0") {
                $this->model->actualizaSimulPreguntaRev($simulacion_id, $pregunta_id, $respuesta, 2, 1);
            } else {
                $this->model->actualizaSimulPreguntaRev($simulacion_id, $pregunta_id, 0, 1, 1);
            }
        } else {
            if ($respuesta != "0") {
                $this->model->actualizaSimulPreguntaRev($simulacion_id, $pregunta_id, $respuesta, 2, 0);
            } else {
                $this->model->actualizaSimulPreguntaRev($simulacion_id, $pregunta_id, 0, 1, 0);
            }
        }
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadasRev($simulacion_id, 1);
        $totalrev = $rev[0]['totalrev'];

        $rev = $this->model->totalSimulacionContestadasRev($simulacion_id, 0);
        $totalrev2 = $rev[0]['totalrev'];
        $restante=0;
        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 0);
        $restante2 = $rev[0]['totalCont'];
        $rev = $this->model->totalSimulacionContestadasPerdidas($simulacion_id);
        $perdidos = $rev[0]['totalCont'];


        $pregunta = $this->model->reportarPreguntaSimulationRev($simulacion_id);
        $pregunta2=$this->model->reportarPreguntaSimulationRev2($simulacion_id);
        
        if ($restante2 != 0) {
            $intentos = $this->model->mostrarCantidadIntento($pregunta[0]['ensayo_id']);
        }






        $rev = $this->model->reportarCantidadRevision($simulacion_id);
        $datos = $rev[0]['cantidadrev'];

        require_once '../vista/alumno/mainPreguntasRev.php';
    }

    function finalizarSimul() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];

        $totalrest = $totals - $totalcon;
        $rev = $this->model->puntaje($simulacion_id);
        $puntaje = $rev;

        $rev = $this->model->validarAprobacion($simulacion_id);
        $aprobacion = $rev[0]['porc_aprobacion'];

//        regla de 3 simple
        $porcentaje = ($puntaje * 100) / $totals;

        $pregunta = $this->model->finSimulacion($simulacion_id, $totalrest, $totalcon, $puntaje, $porcentaje);

        require_once '../vista/alumno/resultados.php';
    }

}

?>