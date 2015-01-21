<?php

require_once "../modelo/ReglaDAO.php";
class ReglaControlador {
    public $model;
    public function __construct() {
        $this->model = new ReglaDAO();
    }

    function listarU(){     
            $regla = $this->model->listarRegla();            
            require_once '../../mainRegla.php'; 
            
    }
    function listarTwoU(){     
            $regla = $this->model->listarReglaTwo();  
            require_once '../vista/regla/mainRegla.php';           
    }
    function formRegla(){     
            $ensayo = $this->model->listarEnsayos();
            $grupo = $this->model->listarGrupos();
            $area = $this->model->listarAreas();
            require_once '../vista/regla/formRegla.php';           
    }
    function formEditRegla(){     
            $ensayo = $this->model->listarEnsayos();
            $grupo = $this->model->listarGrupos();
            $area = $this->model->listarAreas();
            $Reglaid=$_REQUEST['reglaid'];
            $regla = $this->model->buscarIdRegla($Reglaid);  
            require_once '../vista/regla/formEditRegla.php';
    }
    function formBuscarRegla(){ 
            $datos=$_REQUEST['datos'];
            $regla = $this->model->buscarDatosRegla($datos);   
            require_once '../vista/regla/mainRegla.php';            
    }
    
    function insertarRegla(){             
            $ReglaTO=new ReglaTO();
            $ReglaTO->setNombre($_REQUEST['nombre']);
            $ReglaTO->setEstado($_REQUEST['estado']);
            $ReglaTO->setEnsayo_id($_REQUEST['ensayo_id']);
            $ReglaTO->setGrupo_id($_REQUEST['grupo_id']);
            $ReglaTO->setArea_id($_REQUEST['area_id']);
            $msg = $this->model->registrarRegla($ReglaTO);
            $control = new ReglaControlador();
            $control->listarTwoU();
    }
    function actualizaRegla(){             
            $ReglaTO=new ReglaTO();
            $ReglaTO->setNombre($_REQUEST['nombre']);
            $ReglaTO->setEstado($_REQUEST['estado']);
            $ReglaTO->setRegla_id($_REQUEST['reglaid']);
            $msg = $this->model->actualizaRegla($ReglaTO);
            $control = new ReglaControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Reglaid=0;
            $Reglaid=$_REQUEST['reglaid'];
            $msg = $this->model->eliminarRegla($Reglaid);
            $control = new ReglaControlador();
            $control->listarTwoU();
    }
}


?>