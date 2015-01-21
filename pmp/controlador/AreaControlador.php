<?php

require_once "../modelo/AreaDAO.php";

class AreaControlador {

    public $model;

    public function __construct() {
        require_once('Seguridad.php');
        s_pagina_validar();
        $this->model = new AreaDAO();
    }

    function listarU() {
        $area = $this->model->listarArea();
        require_once '../../mainArea.php';
    }

    function listarTwoU() {
        $area = $this->model->listarAreaTwo();
        require_once '../vista/area/mainArea.php';
    }

    function formArea() {
        $area = $this->model->listarArea();
        require_once '../vista/area/formArea.php';
    }

    function formEditArea() {
        $Areaid = $_REQUEST['areaid'];
        $area = $this->model->buscarIdArea($Areaid);
        require_once '../vista/area/formEditArea.php';
    }

    function formBuscarArea() {
        $datos = $_REQUEST['datos'];
        $area = $this->model->buscarDatosArea($datos);
        require_once '../vista/area/mainArea.php';
    }

    function formBuscarAreaAuto() {
        $datos = $_REQUEST['q'];
        $area = $this->model->buscarDatosAreaAuto($datos);
        for ($i = 0; $i < count($area); $i++) {
            echo $area[$i]['nombre'] . "\n";
        }
    }

    function insertarArea() {
        $AreaTO = new AreaTO();
        $AreaTO->setNombre($_REQUEST['nombre']);
        $AreaTO->setDescripcion($_REQUEST['descripcion']);
        $AreaTO->setPeso($_REQUEST['peso']);
        $AreaTO->setEstado($_REQUEST['estado']);
        $sumas = $this->model->validarPesoArea();

        $suma = ($sumas[0]['sumapeso']) + $AreaTO->getPeso();

        if ($suma <= 100) {
            $msg = $this->model->registrarArea($AreaTO);
            $control = new AreaControlador();
            $control->listarTwoU();
        } else {
             $control = new AreaControlador();
            $control->listarTwoU();
      
        }
    }

    function actualizaArea() {
        $AreaTO = new AreaTO();
        $AreaTO->setNombre($_REQUEST['nombre']);
        $AreaTO->setDescripcion($_REQUEST['descripcion']);
        $AreaTO->setPeso($_REQUEST['peso']);
        $AreaTO->setEstado($_REQUEST['estado']);
        $AreaTO->setArea_id($_REQUEST['areaid']);

        $msg = $this->model->actualizaArea($AreaTO);
        $control = new AreaControlador();
        $control->listarTwoU();
    }

    function eliminar() {
        $Areaid = 0;
        $Areaid = $_REQUEST['areaid'];
        $msg = $this->model->eliminarArea($Areaid);
        $control = new AreaControlador();
        $control->listarTwoU();
    }

    function validarAreaPeso() {
        $peso = $_REQUEST['peso'];
        $sumas = $this->model->validarPesoArea();

        $suma = ($sumas[0]['sumapeso']) + $peso;

        if ($suma <= 100) {
            $msjpeso = "1";
        } else {
            $resto = 100 - $suma;
            $msjpeso = "0";
        }
        require_once '../vista/area/validacion.php';
    }
    
    function validarAreaPesoEdit() {
        $peso = $_REQUEST['peso'];
        $Areaid = $_REQUEST['areaid'];
        #$area = $this->model->buscarIdArea($Areaid);
        $sumas = $this->model->validarPesoArea();
        $sumaedit = $this->model->validarPesoAreaEdit($Areaid);

        $sumaed = ($sumas[0]['sumapeso']) - ($sumaedit[0]['pesoedit']);
        $suma = $sumaed + $peso;

        if ($suma <= 100) {
            $msjpeso = "1";
        } else {
            $resto = 100 - $suma;
            $msjpeso = "0";
        }
        require_once '../vista/area/validacion.php';
    }
    
    

}

?>