<?php

require_once "../modelo/CursoDAO.php";
class CursoControlador {
    public $model;
    public function __construct() {
        $this->model = new CursoDAO();
    }

    function listarU(){     
            $curso = $this->model->listarCurso();            
            require_once '../../mainCurso.php'; 
            
    }
    function listarTwoU(){     
            $curso = $this->model->listarCursoTwo();  
            require_once '../vista/curso/mainCurso.php';           
    }
    function formCurso(){     
            $curso = $this->model->listarCurso();  
            require_once '../vista/curso/formCurso.php';           
    }
    function formEditCurso(){     
            $Cursoid=$_REQUEST['cursoid'];
            $curso = $this->model->buscarIdCurso($Cursoid);  
            require_once '../vista/curso/formEditCurso.php';           
    }
    function formBuscarCurso(){ 
            $datos=$_REQUEST['datos'];
            $curso = $this->model->buscarDatosCurso($datos);   
            require_once '../vista/curso/mainCurso.php';            
    }
    
    function insertarCurso(){             
            $CursoTO=new CursoTO();
            $CursoTO->setNombre($_REQUEST['nombre']);
            $CursoTO->setEstado($_REQUEST['estado']);
            $msg = $this->model->registrarCurso($CursoTO);
            $control = new CursoControlador();
            $control->listarTwoU();
    }
    function actualizaCurso(){             
            $CursoTO=new CursoTO();
            $CursoTO->setNombre($_REQUEST['nombre']);
            $CursoTO->setEstado($_REQUEST['estado']);
            $CursoTO->setCurso_id($_REQUEST['cursoid']);
            
            $msg = $this->model->actualizaCurso($CursoTO);
            $control = new CursoControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Cursoid=0;
            $Cursoid=$_REQUEST['cursoid'];
            $msg = $this->model->eliminarCurso($Cursoid);
            $control = new CursoControlador();
            $control->listarTwoU();
    }
    
}


?>