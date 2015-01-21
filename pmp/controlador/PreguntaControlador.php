<?php
header('Content-Type: text/html; charset=UTF-8'); 
require_once "../modelo/PreguntaDAO.php";
class PreguntaControlador {
    public $model;
    public function __construct() {
        $this->model = new PreguntaDAO();
    }

    function listarU(){     
            $pregunta = $this->model->listarPregunta();            
            require_once '../../mainPregunta.php'; 
            
    }
    function listarTwoU(){     
            $pregunta = $this->model->listarPregunta();  
            //$pregunta = $this->model->listarPreguntaTwo();  
            require_once '../vista/pregunta/mainPregunta.php';           
    }
    function formPregunta(){     
            $grupo = $this->model->listarGrupos();
            $area = $this->model->listarAreas();    
            $pregunta = $this->model->listarPregunta();  
            require_once '../vista/pregunta/formPregunta.php';           
    }
    function formEditPregunta(){     
            $grupo = $this->model->listarGrupos();
            $area = $this->model->listarAreas();
            $Preguntaid=$_REQUEST['preguntaid'];
            $pregunta = $this->model->buscarIdPregunta($Preguntaid);  
            require_once '../vista/pregunta/formEditPregunta.php';           
    }
    function formBuscarPregunta(){ 
            $datos=$_REQUEST['datos'];
            $pregunta = $this->model->buscarDatosPregunta($datos);   
            require_once '../vista/pregunta/mainPregunta.php';            
    }
    
    function formBuscarPreguntaAuto() {
        $datos = $_REQUEST['q'];
        $pregunta = $this->model->buscarDatosPreguntaAuto($datos);
        for ($i = 0; $i < count($pregunta); $i++) {
            echo $pregunta[$i]['pregunta_es'] . "\n";
        }
    }
    
    function insertarPregunta(){
            $PreguntaTO=new PreguntaTO();
//            $PreguntaTO->setNombre($_REQUEST['nombre']);
            $PreguntaTO->setExcel_id($_REQUEST['excel_id']);
            $PreguntaTO->setPregunta_es($_REQUEST['pregunta_es']);
            $PreguntaTO->setPregunta_us($_REQUEST['pregunta_us']);
            $PreguntaTO->setImagen_es($_REQUEST['imagen_es']);
            $PreguntaTO->setImagen_us($_REQUEST['imagen_us']);
            $PreguntaTO->setRespuesta($_REQUEST['respuesta']);
            $PreguntaTO->setOpcion_aes($_REQUEST['opcion_aes']);
            $PreguntaTO->setOpcion_bes($_REQUEST['opcion_bes']);
            $PreguntaTO->setOpcion_ces($_REQUEST['opcion_ces']);
            $PreguntaTO->setOpcion_des($_REQUEST['opcion_des']);
            $PreguntaTO->setOpcion_aus($_REQUEST['opcion_aus']);
            $PreguntaTO->setOpcion_bus($_REQUEST['opcion_bus']);
            $PreguntaTO->setOpcion_cus($_REQUEST['opcion_cus']);
            $PreguntaTO->setOpcion_dus($_REQUEST['opcion_dus']);
            $PreguntaTO->setComentario_aes($_REQUEST['comentario_aes']);
            $PreguntaTO->setComentario_bes($_REQUEST['comentario_bes']);
            $PreguntaTO->setComentario_ces($_REQUEST['comentario_ces']);
            $PreguntaTO->setComentario_des($_REQUEST['comentario_des']);
            $PreguntaTO->setComentario_aus($_REQUEST['comentario_aus']);
            $PreguntaTO->setComentario_bus($_REQUEST['comentario_bus']);
            $PreguntaTO->setComentario_cus($_REQUEST['comentario_cus']);
            $PreguntaTO->setComentario_dus($_REQUEST['comentario_dus']);
            $PreguntaTO->setNivel_dificultad($_REQUEST['nivel_dificultad']);
            $PreguntaTO->setEstado($_REQUEST['estado']);
            $PreguntaTO->setGrupo_id($_REQUEST['grupo_id']);
            $PreguntaTO->setArea_id($_REQUEST['area_id']);
            $msg = $this->model->registrarPregunta($PreguntaTO);
            $control = new PreguntaControlador();
            $control->listarTwoU();
    }
    function actualizaPregunta(){             
            $PreguntaTO=new PreguntaTO();
            $PreguntaTO->setExcel_id($_REQUEST['excel_id']);
            $PreguntaTO->setPregunta_es($_REQUEST['pregunta_es']);
            $PreguntaTO->setPregunta_us($_REQUEST['pregunta_us']);
            $PreguntaTO->setImagen_es($_REQUEST['imagen_es']);
            $PreguntaTO->setImagen_us($_REQUEST['imagen_us']);
            $PreguntaTO->setRespuesta($_REQUEST['respuesta']);
            $PreguntaTO->setOpcion_aes($_REQUEST['opcion_aes']);
            $PreguntaTO->setOpcion_bes($_REQUEST['opcion_bes']);
            $PreguntaTO->setOpcion_ces($_REQUEST['opcion_ces']);
            $PreguntaTO->setOpcion_des($_REQUEST['opcion_des']);
            $PreguntaTO->setOpcion_aus($_REQUEST['opcion_aus']);
            $PreguntaTO->setOpcion_bus($_REQUEST['opcion_bus']);
            $PreguntaTO->setOpcion_cus($_REQUEST['opcion_cus']);
            $PreguntaTO->setOpcion_dus($_REQUEST['opcion_dus']);
            $PreguntaTO->setComentario_aes($_REQUEST['comentario_aes']);
            $PreguntaTO->setComentario_bes($_REQUEST['comentario_bes']);
            $PreguntaTO->setComentario_ces($_REQUEST['comentario_ces']);
            $PreguntaTO->setComentario_des($_REQUEST['comentario_des']);
            $PreguntaTO->setComentario_aus($_REQUEST['comentario_aus']);
            $PreguntaTO->setComentario_bus($_REQUEST['comentario_bus']);
            $PreguntaTO->setComentario_cus($_REQUEST['comentario_cus']);
            $PreguntaTO->setComentario_dus($_REQUEST['comentario_dus']);
            $PreguntaTO->setNivel_dificultad($_REQUEST['nivel_dificultad']);
            $PreguntaTO->setEstado($_REQUEST['estado']);
            $PreguntaTO->setGrupo_id($_REQUEST['grupo_id']);
            $PreguntaTO->setArea_id($_REQUEST['area_id']);
            $PreguntaTO->setPregunta_id($_REQUEST['preguntaid']);
            
            $msg = $this->model->actualizaPregunta($PreguntaTO);
            $control = new PreguntaControlador();
            $control->listarTwoU();
    }
    
    function eliminar(){             
            $Preguntaid = 0;
            $Preguntaid = $_REQUEST['preguntaid'];
            $msg = $this->model->eliminarPregunta($Preguntaid);
            $control = new PreguntaControlador();
            $control->listarTwoU();
    }
}
?>