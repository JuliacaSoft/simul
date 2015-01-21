<?php

require_once "../modelo/SimulacionDAO.php";


class SimulacionControlador {
    public $model;
    public function __construct() {
        $this->model = new SimulacionDAO();
        require_once('Seguridad.php');
    }

    function listarU(){ 

            $simulacion = $this->model->listarSimulacion();            
            require_once '../../mainSimulacion.php'; 
            
    }
    
    
    function listarTwoU(){ 
            
            s_pagina_validar();
            $simulacion = $this->model->listarSimulacionTwo();  
            require_once '../vista/simulacion/mainSimulacion.php';           
    }
    
}


?>