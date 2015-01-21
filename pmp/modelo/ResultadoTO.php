<?php


class ResultadoTO {


public $sim_resultado_id;
public $revision;
public $respuesta;
public $simulacion_id;
public $pregunta_id;
public $estado;
  
public function getSim_resultado_id() {
    return $this->sim_resultado_id;
}

public function getRevision() {
    return $this->revision;
}

public function getRespuesta() {
    return $this->respuesta;
}

public function getSimulacion_id() {
    return $this->simulacion_id;
}

public function getPregunta_id() {
    return $this->pregunta_id;
}

public function getEstado() {
    return $this->estado;
}

public function setSim_resultado_id($sim_resultado_id) {
    $this->sim_resultado_id = $sim_resultado_id;
}

public function setRevision($revision) {
    $this->revision = $revision;
}

public function setRespuesta($respuesta) {
    $this->respuesta = $respuesta;
}

public function setSimulacion_id($simulacion_id) {
    $this->simulacion_id = $simulacion_id;
}

public function setPregunta_id($pregunta_id) {
    $this->pregunta_id = $pregunta_id;
}

public function setEstado($estado) {
    $this->estado = $estado;
}


}

?>