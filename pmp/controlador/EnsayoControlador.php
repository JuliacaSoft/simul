<?php

require_once "../modelo/EnsayoDAO.php";
class EnsayoControlador {
    public $model;
    public function __construct() {
        $this->model = new EnsayoDAO();
    }

    function listarU(){     
            $ensayo = $this->model->listarEnsayo();            
            require_once '../../mainEnsayo.php'; 
            
    }
    function listarTwoU(){     
            $ensayo = $this->model->listarEnsayo();  
            //$ensayo = $this->model->listarEnsayoTwo();  
            require_once '../vista/ensayo/mainEnsayo.php';           
    }
    function formEnsayo(){     
            $grupo = $this->model->listarGrupos();  
            $area = $this->model->listarAreas();  
            $curso = $this->model->listarCursos();  
            require_once '../vista/ensayo/formEnsayo.php';           
    }
    function formEditEnsayo(){     
            $grupo = $this->model->listarGrupos();  
            $area = $this->model->listarAreas();  
            $curso = $this->model->listarCursos();  
            $Ensayoid = $_REQUEST['ensayoid'];
            $ensayo = $this->model->buscarIdEnsayo($Ensayoid);  
            require_once '../vista/ensayo/formEditEnsayo.php';           
    }

    function formPasarelaA(){     
     
            $tipoid = $_REQUEST['tipo'];
            $areadep="";
            $grupodep="";
            if($tipoid=="2"){
            $areadep = $this->model->buscarAreasConocimiento();                              
            }elseif ($tipoid=="3"){
            $grupodep = $this->model->buscarGrupoProcesos();    
                
            }

            require_once '../vista/ensayo/control.php';           
    }
    function formBuscarEnsayo(){ 
            $datos = $_REQUEST['datos'];
            $ensayo = $this->model->buscarDatosEnsayo($datos);   
            require_once '../vista/ensayo/mainEnsayo.php';            
    }
    
    function insertarEnsayo(){             
            $EnsayoTO=new EnsayoTO();
            $EnsayoTO->setNombre($_REQUEST['nombre']);
            $EnsayoTO->setDescripcion($_REQUEST['descripcion']);
            $EnsayoTO->setTipo($_REQUEST['tipo']);
            $EnsayoTO->setT_dependencia($_REQUEST['t_dependencia']);
            $EnsayoTO->setTiempo($_REQUEST['tiempo']);
            $EnsayoTO->setIntento($_REQUEST['intento']);
            $EnsayoTO->setCant_preg($_REQUEST['cant_preg']);
            $EnsayoTO->setPorc_aprobacion($_REQUEST['porc_aprobacion']);
            $EnsayoTO->setEstado($_REQUEST['estado']);
            $EnsayoTO->setCurso_id($_REQUEST['curso_id']);
            $msg = $this->model->registrarEnsayo($EnsayoTO);
            $control = new EnsayoControlador();
            $control->listarTwoU();
    }
    function actualizaEnsayo(){             
            $EnsayoTO=new EnsayoTO();
            $EnsayoTO->setNombre($_REQUEST['nombre']);
            $EnsayoTO->setDescripcion($_REQUEST['descripcion']);
            $EnsayoTO->setTipo($_REQUEST['tipo']);
            $EnsayoTO->setT_dependencia($_REQUEST['t_dependencia']);
            $EnsayoTO->setTiempo($_REQUEST['tiempo']);
            $EnsayoTO->setIntento($_REQUEST['intento']);
            $EnsayoTO->setCant_preg($_REQUEST['cant_preg']);
            $EnsayoTO->setPorc_aprobacion($_REQUEST['porc_aprobacion']);
            $EnsayoTO->setEstado($_REQUEST['estado']);
            $EnsayoTO->setCurso_id($_REQUEST['curso_id']);
            $EnsayoTO->setEnsayo_id($_REQUEST['ensayoid']);
            $msg = $this->model->actualizaEnsayo($EnsayoTO);
            $control = new EnsayoControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Ensayoid=0;
            $Ensayoid=$_REQUEST['ensayoid'];
            $msg = $this->model->eliminarEnsayo($Ensayoid);
            $control = new EnsayoControlador();
            $control->listarTwoU();
    }
}


?>