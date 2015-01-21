<?php

require_once "../modelo/GrupoDAO.php";
class GrupoControlador {
    public $model;
    public function __construct() {
        $this->model = new GrupoDAO();
    }

    function listarU(){     
            $grupo = $this->model->listarGrupo();            
            require_once '../../mainGrupo.php'; 
            
    }
    function listarTwoU(){     
            $grupo = $this->model->listarGrupoTwo();  
            require_once '../vista/grupo/mainGrupo.php';           
    }
    function formGrupo(){     
            $grupo = $this->model->listarGrupo();  
            require_once '../vista/grupo/formGrupo.php';           
    }
    function formEditGrupo(){     
             
            $Grupoid=$_REQUEST['grupoid'];
            $grupo = $this->model->buscarIdGrupo($Grupoid);  
            require_once '../vista/grupo/formEditGrupo.php';           
    }
    function formBuscarGrupo(){ 
            $datos=$_REQUEST['datos'];
            $grupo = $this->model->buscarDatosGrupo($datos);   
            require_once '../vista/grupo/mainGrupo.php';            
    }
    function formBuscarGrupoAuto(){ 
            $datos=$_REQUEST['q'];
            $grupo = $this->model->buscarDatosGrupoAuto($datos);   
             for ($i = 0; $i < count($grupo); $i++) {
            echo $grupo[$i]['nombre']."\n";               
            }
            
    }
    
    function insertarGrupo(){             
            $GrupoTO=new GrupoTO();
            $GrupoTO->setNombre($_REQUEST['nombre']);
            $GrupoTO->setDescripcion($_REQUEST['descripcion']);
            $GrupoTO->setPeso($_REQUEST['peso']);
            $GrupoTO->setEstado($_REQUEST['estado']);
            
            $sumas = $this->model->validarPesoGrupo();
            $suma = ($sumas[0]['sumapeso']) + $GrupoTO->getPeso();
            if ($suma <= 100) {
                $msg = $this->model->registrarGrupo($GrupoTO);
                $control = new GrupoControlador();
                $control->listarTwoU();
            } else {
                 $control = new GrupoControlador();
                $control->listarTwoU();

            }
    }
            
    function actualizaGrupo(){             
            $GrupoTO=new GrupoTO();
            $GrupoTO->setNombre($_REQUEST['nombre']);
            $GrupoTO->setDescripcion($_REQUEST['descripcion']);
            $GrupoTO->setPeso($_REQUEST['peso']);
            $GrupoTO->setEstado($_REQUEST['estado']);
            $GrupoTO->setGrupo_id($_REQUEST['grupoid']);
            $msg = $this->model->actualizaGrupo($GrupoTO);
            $control = new GrupoControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Grupoid=0;
            $Grupoid=$_REQUEST['grupoid'];
            $msg = $this->model->eliminarGrupo($Grupoid);
            $control = new GrupoControlador();
            $control->listarTwoU();
    }
    
    function validarGrupoPeso() {
        $peso = $_REQUEST['peso'];
        $sumas = $this->model->validarPesoGrupo();

        $suma = ($sumas[0]['sumapeso']) + $peso;

        if ($suma <= 100) {
            $msjpeso = "1";
        } else {
            $resto = 100 - $suma;
            $msjpeso = "0";
        }
        require_once '../vista/grupo/validacion.php';
    }
    
    function validarGrupoPesoEdit() {
        $peso = $_REQUEST['peso'];
        $Grupoid = $_REQUEST['grupoid'];
        #$area = $this->model->buscarIdArea($Areaid);
        $sumas = $this->model->validarPesoGrupo();
        $sumaedit = $this->model->validarPesoGrupoEdit($Grupoid);

        $sumaed = ($sumas[0]['sumapeso']) - ($sumaedit[0]['pesoedit']);
        $suma = $sumaed + $peso;

        if ($suma <= 100) {
            $msjpeso = "1";
        } else {
            $resto = 100 - $suma;
            $msjpeso = "0";
        }
        require_once '../vista/grupo/validacion.php';
    }
}


?>