<?php

require_once "../modelo/ResultadoDAO.php";
class ResultadoControlador {
    public $model;
    public function __construct() {
        $this->model = new ResultadoDAO();
    }

    function listarU(){     
            $resultado = $this->model->listarResultado();            
            require_once '../../mainResultado.php'; 
            
    }
    function reportUsuario(){     
            //$resultado = $this->model->reportUsuario();            
            require_once '../web/report/reportes/reporteUsuario.php'; 
            
    }
    
    function listarTwoU(){     
            $resultado = $this->model->listarResultadoTwo();  
            require_once '../vista/resultado/mainResultado.php';           
    }
    
}


?>