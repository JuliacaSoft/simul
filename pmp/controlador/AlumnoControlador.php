<?php

require_once "../modelo/PreguntaDAO.php";

class AlumnoControlador {

    public $model;

    public function __construct() {
        require_once('Seguridad.php');
        s_pagina_validar(); 
        $this->model = new PreguntaDAO();
    }

    public function listarCursos() {
        $cursos = $this->model->listarCursosEnsayo();
        require_once '../vista/alumno/mainAlumno.php';
    }

    public function listarCursosTerminados() {

        $cursos = $this->model->listarCursosEnsayoTerminado(1);
        require_once '../vista/alumno/mainAlumnoTerminado.php';
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
        require_once '../web/report/alumno/mainAlumnoPregTerm.php';
    }

    function listarPreguntas() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta = $this->model->reportarPreguntaSimulation($simulacion_id);
        $intentos = $this->model->mostrarCantidadIntento($pregunta[0]['ensayo_id']);
        $datos = 0;

        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];

        $rev = $this->model->tiempoSimulacion($simulacion_id);
        $tiempofin = $rev[0]['tiempofin'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 1);
        $totalrev = $rev[0]['totalCont'];

        $restante = $totals - $totalcon - $totalrev;

        require_once '../vista/alumno/mainPreguntas.php';
    }

    function listarPreguntasRev() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta = $this->model->reportarPreguntaSimulRevision($simulacion_id);
        $datos = 0;

        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];
        $rev = $this->model->tiempoSimulacion($simulacion_id);
        $tiempofin = $rev[0]['tiempofin'];
        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 1);
        $totalrev = $rev[0]['totalCont'];

        $restante = $totals - $totalcon - $totalrev;

        require_once '../vista/alumno/mainPreguntasRev.php';
    }

    function cambiarCondicionPregunta() {
        $simulacion_id = $_REQUEST['simulacion_id'];
        $pregunta_id = $_REQUEST['pregunta_id'];
        $respuesta = $_REQUEST['respuesta'];
        $plantilla = $_REQUEST['plantilla'];



        if ($respuesta == "r") {
            $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, "0", 1);
        } else {
            $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, $respuesta, 2, $plantilla);

        }
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];
        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];
        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 1);
        $totalrev = $rev[0]['totalCont'];
        $restante = $totals - $totalcon - $totalrev;

        $pregunta = $this->model->reportarPreguntaSimulation($simulacion_id);

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
        $respuesta = $_REQUEST['respuesta'];
        if ($respuesta == "r") {
            $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, "0", 1);
        } else {
            $this->model->actualizaSimulPregunta($simulacion_id, $pregunta_id, $respuesta, 2);
        }
        $rev = $this->model->totalSimulacionRes($simulacion_id);
        $totals = $rev[0]['totalSim'];


        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 2);
        $totalcon = $rev[0]['totalCont'];

        $rev = $this->model->totalSimulacionContestadas($simulacion_id, 1);
        $totalrev = $rev[0]['totalCont'];

        $restante = $totals - $totalcon - $totalrev;
        $pregunta = $this->model->reportarPreguntaSimulRevision($simulacion_id);

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

//        regla de 3 simple
        $puntaje = ($puntaje * 100) / $totals;

        $pregunta = $this->model->finSimulacion($simulacion_id, $totalrest, $totalcon, $puntaje);
        $cursos = $this->model->listarCursosEnsayo();
        $datos = 0;
        require_once '../vista/alumno/mainAlumno.php';
    }

}

?>