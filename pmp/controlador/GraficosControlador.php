<?php

require_once "../modelo/GraficosDAO.php";
class GraficosControlador {
    public $model;
    public function __construct() {
        $this->model = new GraficosDAO();
    }

    function listarReporteBarras(){     
            $resultado = $this->model->listarReporteBarras();            
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