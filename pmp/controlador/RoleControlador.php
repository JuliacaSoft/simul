<?php

require_once "../modelo/RoleDAO.php";
class RoleControlador {
    public $model;
    public function __construct() {
        $this->model = new RoleDAO();
    }

    function listarU(){     
            $role = $this->model->listarRole();            
            require_once '../../mainRole.php'; 
            
    }
    function listarTwoU(){     
            $role = $this->model->listarRoleTwo();  
            require_once '../vista/role/mainRole.php';           
    }
    function formRole(){     
            $role = $this->model->listarRole();  
            require_once '../vista/role/formRole.php';           
    }
    function formEditRole(){     
            $Roleid=$_REQUEST['roleid'];
            $role = $this->model->buscarIdRole($Roleid);  
            require_once '../vista/role/formEditRole.php';           
    }
    function formBuscarRole(){ 
            $datos=$_REQUEST['datos'];
            $role = $this->model->buscarDatosRole($datos);   
            require_once '../vista/role/mainRole.php';            
    }
    
    function insertarRole(){             
            $RoleTO=new RoleTO();
            $RoleTO->setNombre($_REQUEST['nombre']);
            $RoleTO->setDescripcion($_REQUEST['descripcion']);
            $RoleTO->setEstado($_REQUEST['estado']);
            $msg = $this->model->registrarRole($RoleTO);
            $control = new RoleControlador();
            $control->listarTwoU();
    }
    function actualizaRole(){             
            $RoleTO=new RoleTO();
            $RoleTO->setNombre($_REQUEST['nombre']);
            $RoleTO->setDescripcion($_REQUEST['descripcion']);
            $RoleTO->setEstado($_REQUEST['estado']);
            $RoleTO->setRole_id($_REQUEST['roleid']);
            
            $msg = $this->model->actualizaRole($RoleTO);
            $control = new RoleControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Roleid=0;
            $Roleid=$_REQUEST['roleid'];
            $msg = $this->model->eliminarRole($Roleid);
            $control = new RoleControlador();
            $control->listarTwoU();
    }
    
}


?>