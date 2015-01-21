<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsistenciaControlador
 *
 * @author Administrador
 */
require_once "../modelo/AsistenciaTO.php";
require_once "../modelo/AsistenciaDAO.php";

class AsistenciaControlador {
    public $model;
    public function __construct() {
        $this->model = new AsistenciaDAO();
    }
    
    function asisSave(){ 
            if(!is_null($_REQUEST['codigo'])){ 
            $idInscrip=null;    
            $idInscrip=$this->model->selectIdInscrito($_REQUEST['codigo']);        
            $nombre="";
                    if($idInscrip!=null){
                        $idVerific=null;    
                        $idVerific=$this->model->selectRegistrado($idInscrip[0]['id_inscripcion']);
                       $nombre=$idInscrip[0]['nombres']." ".$idInscrip[0]['apell_paterno']." ".$idInscrip[0]['apell_materno']; 
                         if($idVerific!=null){
                              echo "2|Usted ya fue Registrado Antes...!";
                         }else{
                                $AsistenciaTO=new AsistenciaTO();
                                $AsistenciaTO->setId_inscripcion($idInscrip[0]['id_inscripcion']);
                                $AsistenciaTO->setId_trabajador("1");            
                                $msg = $this->model->registrarAsistencia($AsistenciaTO);                               
                                if(is_numeric($msg)){
                                echo "1|Registro exitoso...!<br/>".$nombre;
                                }else{
                                echo "0|Error al registrar..! Intente Nuevamente";
                                }                                 
                         }
                    }else{
                        echo "3|Error..! Verifique que su codigo es correcto e Intente Nuevamente";
                    }              
            }else{                
                echo "4|Por favor lecture su codigo";                
            }
          
    }
    
    
    
    
    
    function formAsi(){
            require_once '../vista/asistencia/formAsistencia.php';                 
    }
    
    function formClose(){       
            $data=$this->model->mostrarCantidadASistencia();
            require_once '../vista/asistencia/cerrarAsistencia.php';                 
    }
    function asisClose(){    
            $this->model->actualizarAsistencia();
            $data=$this->model->mostrarCantidadASistencia();
            require_once '../vista/asistencia/cerrarAsistencia.php';                 
    }

    
}

?>
