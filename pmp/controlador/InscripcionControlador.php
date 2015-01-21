<?php

require_once "../modelo/InscripcionTO.php";
require_once "../modelo/InscripcionDAO.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionControlador
 *
 * @author Administrador
 */
class InscripcionControlador {
    public $model;
    public function __construct() {
        $this->model = new InscripcionDAO();
    }

    function form(){     
           // $trabajador = $this->model->listarTrabajador();                    
            $dataPais=$this->model->viewPais();
            $dataEspecialidad=$this->model->viewEspecialidad();
            require_once '../vista/inscripcion/formInscripcion.php';           
    }
    function insSave(){
            $dataDni=null;
            $dataDni = $this->model->validarDni($_REQUEST['dnicedula']);
            if(count($dataDni)==0 ||$dataDni==null){
            //require_once '../vista/inscripcion/formInscripcion.php';            
            $InscripcionTO=new InscripcionTO();
            $InscripcionTO->setNombres($_REQUEST['nombre']);
            $InscripcionTO->setApell_paterno($_REQUEST['apellpaterno']);
            $InscripcionTO->setApell_materno($_REQUEST['apellmaterno']);
            $InscripcionTO->setSexo($_REQUEST['sexo']);
            $InscripcionTO->setDni_cedula($_REQUEST['dnicedula']);
            $InscripcionTO->setEmail($_REQUEST['email']);
            $InscripcionTO->setCel_telefono($_REQUEST['celular']);
            $InscripcionTO->setPais($_REQUEST['pais']);
            $InscripcionTO->setRegion($_REQUEST['region']);
            $InscripcionTO->setTipo_participante($_REQUEST['tipo']);
            $InscripcionTO->setInstitucion($_REQUEST['institucion']);
            $InscripcionTO->setEspecialidad($_REQUEST['area']);
            $InscripcionTO->setGrado($_REQUEST['nivel']);
            $msg = $this->model->registrarInscripcion($InscripcionTO);
            
            $reporte = $this->model->validarDni($_REQUEST['dnicedula']);
           
            foreach ($reporte as $valueR) {                            
            $emailIn=$_REQUEST['email'];
            $msgIn="        
                <div>
                <p> Estimado(a)<b> ".$valueR['nombres']." ".$valueR['apell_paterno']." ".$valueR['apell_materno']." </b> Gracias por Inscribirse en nuestro Evento</p>
                <p> Si Usted no ha adjuntado su Voucher de Pago, Puede hacerlo introduciendo su DNI y el siguiente C&oacute;digo:<br>                
                <b> C&oacute;digo de Confirmaci&oacute;n:</b> ".$valueR['clave_confirmacion']."<br>
                  En la Opcion <b>Enviar Voucher</b>
                </p>  
                <p>Si Usted ya Adjunt&oacute; su Voucher de Pago, dentro de unos dias se le enviar&aacute; un correo de aceptaci&oacute;n para la participaci&oacute;n en el Evento; <br> de no llegarle el  correo electr&oacute;nico ... por favor comuniquese con nosotros al siguiente correo <b>eap.sistemas@upeu.pe</b>   </p>
                <img src='http://agile.grupoinnop.pe/Seminario.jpg' width='80%' height='50%'/>    
                </div>         
            ";
            if(is_numeric($msg)){            
            $fun=new InscripcionControlador();
            $msgmail=$fun->enviarMailPipol($msgIn, $emailIn);
            echo "1|_proxy.php?controlador=Inscripcion&accion=formConf&id=".$msg;
            }else{
            echo "0|Error al registra...!  Comuniquese con el administrador.";                
            } 
                 }            
            }else{
                echo "2|Error...! Usted ya se registro anteriormnte. para confirmar su participacion haga click <a href='_proxy.php?controlador=Confirmacion&accion=preConf'> Aqui </a> ";   
            }
            
    }

    function formConf(){            
            $id=$_REQUEST['id'];
            $data = $this->model->mostrarDatosInscrito($id);
            require_once '../vista/inscripcion/formConfirmacion.php';           
    }
    function excelExport(){          
            $opt=$_REQUEST['opt'];
            if($opt=='1'){$title=" Inscritos al I COINTEM - Confirmados "; }
            else{$title=" Inscritos al I COINTEM 2011 - Todos"; }
            
            $data = $this->model->exportExcel($opt);
            require_once '../vista/inscripcion/exportExcel.php';           
    }
    function formExcel(){          
            require_once '../vista/inscripcion/formExcel.php';           
    }
    
    
    function impriBarr(){     
            $codIni=$_REQUEST['codIni'];
            $codFin=$_REQUEST['codFin'];
            $dataCodigo = $this->model->codigoBarra($codIni, $codFin);        
            require_once '../vista/inscripcion/impBarra.php';           
    }
    
    function formBarr(){           
            require_once '../vista/inscripcion/formBarra.php';           
    }
    
    
    function viewRegion(){            
            $id=$_REQUEST['pais'];            
            $data = $this->model->mostRegion($id);
            $region="";
            if(count($data)>0){
                foreach ($data as $to) {
                    $region=$region."<option value='".$to['id']."'>".$to['region']."</option>";
                }
                
            }
           echo $region;            
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
        $mail->Username = "mamanipari@gmail.com";
        $mail->Password = "studen@studen";//7@s1stenc1@7

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
