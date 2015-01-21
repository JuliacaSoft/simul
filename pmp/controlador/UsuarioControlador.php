<?php

require_once "../modelo/UsuarioDAO.php";
class UsuarioControlador {
    public $model;
    public function __construct() {
        
        $this->model = new UsuarioDAO();
    }

    function listarU(){     
            $usuario = $this->model->listarUsuario();            
            require_once '../../mainUser.php'; 
            
    }
    
    function TestAlumno(){     
            //$usuario = $this->model->listarUsuarioTwo();  
            require_once '../vista/alumno/mainAlumno.php';           
    }
    
    function listarTwoU(){   
        require_once('Seguridad.php');
        s_pagina_validar();
            $usuario = $this->model->listarUsuarioTwo();  
            require_once '../vista/trabajador/mainUser.php';           
    }
    function formUser(){     
            $roles = $this->model->listarRoles();  
            require_once '../vista/trabajador/formUser.php';           
    }
    function formEditUser(){     
            $roles = $this->model->listarRoles();  
            $Usuarioid=$_REQUEST['usuarioid'];
            $usuario = $this->model->buscarIdUsuario($Usuarioid);  
            require_once '../vista/trabajador/formEditUsuer.php';           
    }
    function formBuscarUser(){ 
            $datos=$_REQUEST['datos'];
            $usuario = $this->model->buscarDatosUsuario($datos);   
            require_once '../vista/trabajador/mainUser.php';            
    }
    function formBuscarUserAuto(){ 
            $datos=$_REQUEST['q'];
            $usuario = $this->model->buscarDatosUsuarioAuto($datos);   
             for ($i = 0; $i < count($usuario); $i++) {
            echo $usuario[$i]['nombre']."\n";               
            }
            
    }
    function validaxion(){ 
    session_start();
    $username = trim($_POST["username"]);
    $password = (trim($_POST["password"]));

    $resultCustomer=$this->model->preXValidaxion($username,$password); 
    $dataExist=count($resultCustomer);

    if($dataExist==0){
       $resulVerifica=$this->model->preValidaxion($username);
       if(count($resulVerifica)!=0){echo "0->Error de clave";}
        else{echo "1->Personal no Registrado";}
    }else{ 
        if($dataExist==1){
        $resultWorker=$this->model->validaxion($username, $password);
            if(count($resultWorker)==1){
               
           
                if( $resultWorker[0]['estado']=="1"){
                    $_SESSION["autintificafsx"]= stripslashes("dmplogiofsx");                    
                    $_SESSION["workerfsx"]=stripslashes($resultWorker[0]['usuario_id']);
                    $_SESSION["nivelfsx"]=stripslashes($resultWorker[0]['nivel']);
                    echo "5->Exito->pmp/web/_proxy.php?controlador=Index&accion=login";
                }else{
                    if($resultWorker[0]['estado']!="1" && $resultWorker[0]['nivel']=="1"){
                    $_SESSION["autintificafsx"]= stripslashes("dmplogiofsx");                    
                    $_SESSION["workerfsx"]=stripslashes($resultWorker[0]['usuario_id']);
                    $_SESSION["nivelfsx"]=stripslashes($resultWorker[0]['nivel']);
                    echo "5->Exito->pmp/web/_proxy.php?controlador=Index&accion=login";
                     }
                     else{echo "2->Usted. Esta desactivado y No es Super Administrador";}
                 }
            
        }else{
            echo "3->Usted No es rabajador de la Biblioteca";
        }

        }else{
        echo "4->Registro Duplicado";
     }


    }
            
    }
    
    function insertarUseuario(){             
            $UsuarioTO=new UsuarioTO();
            $UsuarioTO->setNombre($_REQUEST['nombre']);
            $UsuarioTO->setApellidos($_REQUEST['apellidos']);
            $UsuarioTO->setUsername($_REQUEST['usuario']);
            $UsuarioTO->setPassword($_REQUEST['clave']);
            $UsuarioTO->setRole_id($_REQUEST['role']);
            $UsuarioTO->setEstado($_REQUEST['estado']);
            $msg = $this->model->registrarUsuario($UsuarioTO);
            $control = new UsuarioControlador();
            $control->listarTwoU();
    }
    function actualizaUsuario(){             
            $UsuarioTO=new UsuarioTO();
            $UsuarioTO->setNombre($_REQUEST['nombre']);
            $UsuarioTO->setApellidos($_REQUEST['apellidos']);
            $UsuarioTO->setUsuario_id($_REQUEST['usuarioid']);
            $msg = $this->model->actualizaUsuario($UsuarioTO);
            $control = new UsuarioControlador();
            $control->listarTwoU();
    }
    function eliminar(){             
            $Usuarioid=0;
            $Usuarioid=$_REQUEST['usuarioid'];
            $msg = $this->model->eliminarUsuario($Usuarioid);
            $control = new UsuarioControlador();
            $control->listarTwoU();
    }   
}


?>