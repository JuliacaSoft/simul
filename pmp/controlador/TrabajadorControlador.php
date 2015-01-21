<?php

require_once "../modelo/TrabajadorDAO.php";

class trabajadorControlador {
    public $model;
    public function __construct() {
        $this->model = new TrabajadorDAO();
    }

    function listar(){     
            $trabajador = $this->model->listarTrabajador();            
            require_once '../../lista.php';           
    }
    function listarTwo(){     
            $trabajador = $this->model->listarTrabajarorTwo();            
            require_once '../vista/trabajador/listar.php';           
    }


}
?>
