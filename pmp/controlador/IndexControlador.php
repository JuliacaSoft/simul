<?php

require_once "../modelo/TrabajadorDAO.php";
require_once('utils.php');

class indexControlador {
    public $model;
    public function __construct() {
        $this->model = new TrabajadorDAO();
    }


    function login(){  
            require_once('Seguridad.php');
            s_pagina_validar();
            $_SESSION['UserAct'] = $this->model->buscarIdUsuario($_SESSION['workerfsx']);
            $usuario = $_SESSION['UserAct'][0]['username'];
            $cargo = $_SESSION['UserAct'][0]['role_id'];
            $nombre = $_SESSION['UserAct'][0]['nombre'];
            #$trabajador = $this->model->listarTrabajarorTwo();            
            require_once '../vista/user/indexFrame.php';           
    }
    function salir(){     
        #$trabajador = $this->model->listarTrabajarorTwo();    
        session_start();
        session_destroy();
        f_redireccionar('../../index.php');           
    }

    function cargamasiva(){     
            #$trabajador = $this->model->listarTrabajarorTwo();            
            require_once '../web/index.php';           
    }

    
}
?>
