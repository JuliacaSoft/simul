<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfirmacionControlador
 *
 * @author Administrador
 */
require_once "../modelo/ConfirmacionTO.php";
require_once "../modelo/ConfirmacionDAO.php";
require_once "../modelo/InscripcionTO.php";
require_once "../modelo/InscripcionDAO.php";

class ConfirmacionControlador {
    public $model;
    public $modelIns;
    public function __construct() {
        $this->model = new ConfirmacionDAO();
        $this->modelIns = new InscripcionDAO();
    }
    
    function confSave(){          
        $status = "";
//        obtenemos los datos del archivo 
//        $tamano = $_FILES["archivo"]['size'];
//        $tipo = $_FILES["archivo"]['type'];        
        $archivo = $_FILES["archivo"]['name'];
        if ($_POST["accion"] == "confSave") {                
               // $prefijo = substr(md5(uniqid(rand())),0,6);
                if ($archivo != "") {
                        // guardamos el archivo a la carpeta files
                        $destino =  "../../recursos/files/".$_REQUEST['idInscrito']."_".$archivo;
                        if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                                $status = "Archivo subido: <b>".$archivo."</b>";
                        } else { $status = "Error al subir el archivo"; }
                        } else { $status = "Error al subir archivo";}
        }        
            $ConfirmacionTO=new ConfirmacionTO();
            $ConfirmacionTO->setNum_deposito($_REQUEST['idInscrito']."_".$archivo);
            $ConfirmacionTO->setId_inscripcion($_REQUEST['idInscrito']);
                        
            $msg = $this->model->registrarConfirmacion($ConfirmacionTO);
            if(is_numeric($msg)){
            $msgdmp="<b>Se ha Registrado Correctamente</b>";    
            $dataPais=$this->modelIns->viewPais();
            $dataEspecialidad=$this->modelIns->viewEspecialidad();
            require_once '../vista/inscripcion/formInscripcion.php'; 
             
            //echo "1|_proxy.php?controlador=Confirmacion&accion=msgConf&id=".$msg;
            }else{
            echo "0|"+$status;          
            }            
    }
    
    function preSave(){                                              
            $InscripcionTO=new InscripcionTO();
            $InscripcionTO->setDni_cedula($_REQUEST['dni']);
            $InscripcionTO->setClave_confirmacion($_REQUEST['clave']);            
            $dataInsc=null;
            $dataInsc = $this->modelIns->dniClave($InscripcionTO);
            if($dataInsc!=null && count($dataInsc)>0){
                $dataConfVeri=null;
                $dataConfVeri=$this->model->vereficConfirm($dataInsc[0]['id_inscripcion']); 
                if(count($dataConfVeri)==0){
                     echo "1|_proxy.php?controlador=Inscripcion&accion=formConf&id=".$dataInsc[0]['id_inscripcion'];
                }else{
                    echo "0|Usted ya Confirmo su participacion... Gracias por su confianza.";
                }
                
            }else{
                 echo "2|No Coincide los datos... Intente Nuevamente";
            }            
    }
    
    
    function msgConf(){
//            $id=$_REQUEST['id'];
//            $data = $this->model->mostrarDatosInscrito($id);
            require_once '../vista/inscripcion/msgInscripcion.php';                 
    }
    
    
    function preConf(){
            require_once '../vista/inscripcion/formPreConfirmar.php';                 
    }
    function preValiConf(){
            $data = $this->model->validarConfirmacion();
            require_once '../vista/inscripcion/validarInscripcion.php';                 
    }
    function importND(){            
            require_once '../vista/inscripcion/importDepo.php';                 
    }
    
    
    
    
    function impSave(){     
            $dataNd =array();
            $dataNd=  explode("|", trim($_REQUEST['numdep']));
            $n=0;
            $m=0;
            $msgr="";
            while($n<count($dataNd)){
                $data=$this->model->selectNumDep($dataNd[$n]);                
                if(count($data)==0){
                    $this->model->registNd($dataNd[$n]);    
                }else{$m++; $msgr=$msgr."->".$dataNd[$n]; }             
                $n++;
            }
            if($m!=0){
            $msgr="<br> Hay ".$m." registros rechazados y son las siguientes : ".$msgr;    
            }else{$msgr=""; }
            
            
            echo "1|Registor Exitoso|".$n."|_proxy.php?controlador=Confirmacion&accion=msgImp|".$msgr."";
    }
    

    
    function validaUpdate(){        
       $dataValidar =array();
       $dataValidar=$_REQUEST['vloar'];
       $n=0;
        while($n<count($dataValidar)){
            $dataNd =array();
            $dataNd=  explode("|", trim($dataValidar[$n])); 
            $ConfirmacionTO=new ConfirmacionTO();
            $ConfirmacionTO->setId_trabajdor("1");
            $ConfirmacionTO->setId_inscripcion($dataNd[2]);
            $ConfirmacionTO->setId_confirmacion($dataNd[0]);
            $condifion=$dataNd[1];
            $this->model->estadoNumdep($ConfirmacionTO, $condifion); 
            $dataInscritos=$this->modelIns->mostrarDatosInscrito($dataNd[2]);
            
            foreach ($dataInscritos as $valueI) {
            $emailIn=$valueI['email'];
            $msgIn="        
                <div>
                <p> Estimado(a)<b> ".$valueI['nombres']." ".$valueI['apell_paterno']." ".$valueI['apell_materno']." </b> Gracias por Inscribirse en nuestro Evento</p>
                <p> <b>Su participaci&oacute;n ya est&aacute; confirmada</b>
                </p>                  
                <img src='http://agile.grupoinnop.pe/Seminario.jpg' width='80%' height='80%'/>    
                </div>         
            ";                
             $fun=new ConfirmacionControlador();
             $fun->enviarMailPipol($msgIn, $emailIn);
            }
            
            $idInscripcion=$dataNd[2];
            $deposito=$dataNd[3];   
            $this->model->updateNumDep($idInscripcion, $deposito);  
            
            
            
            $n++;        
        }
            $data = $this->model->validarConfirmacion();
            require_once '../vista/inscripcion/validarInscripcion.php';
    }


    function msgImp(){
        $msg=$_REQUEST['msg'];
        $num=$_REQUEST['num'];
        $msgr=$_REQUEST['msgr'];
        
       $msgData= $msg." "."Cantidad Registrada ".$num." ".$msgr;
       
        require_once '../vista/inscripcion/importDepo.php';
    }

    function enviarMailPipol($msg, $correo){
        include("../util/email/class.phpmailer.php");
        include("../util/email/class.smtp.php");        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "asistencia.gerencia77@gmail.com";
        $mail->Password = "7@s1stenc1@7";

        $mail->From = "inscripciones@cointem.com";
        $mail->FromName = "Juliaca Agile Day 2012 ";
        $mail->Subject = "Inscripcion Evento - 2012";
        $mail->AltBody = "Bienvenidos al III Seminario de Tendencia de Desarrollo de Software - 2012.";
        $mail->MsgHTML($msg);
       // $mail->AddAttachment("files/files.zip");
       // $mail->AddAttachment("files/img03.jpg");
        $mail->AddAddress($correo, "Destinatario");
        $mail->IsHTML(true);
        $mensaje="";
        if(!$mail->Send()) {
          $mensaje= "Error: " . $mail->ErrorInfo;
        } else {
          $mensaje= "Mensaje enviado correctamente";
        }        
        return $mensaje;
    }    
    
}

?>
