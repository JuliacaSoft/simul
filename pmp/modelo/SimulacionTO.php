<?php


class SimulacionTO {


public $simulacion_id;
public $estado_sim;
public $num_intento;
public $puntaje;
public $pun_porcentual;
public $ensayo_id;
public $usuario_id;
public $restante;
public $respondida;
  
public function getSimulacion_id() {
    return $this->simulacion_id;
}

public function getEstado_sim() {
    return $this->estado_sim;
}

public function getNum_intento() {
    return $this->num_intento;
}

public function getPuntaje() {
    return $this->puntaje;
}

public function getPun_porcentual() {
    return $this->pun_porcentual;
}

public function getEnsayo_id() {
    return $this->ensayo_id;
}

public function getUsuario_id() {
    return $this->usuario_id;
}

public function getRestante() {
    return $this->restante;
}

public function getRespondida() {
    return $this->respondida;
}

public function setSimulacion_id($simulacion_id) {
    $this->simulacion_id = $simulacion_id;
}

public function setEstado_sim($estado_sim) {
    $this->estado_sim = $estado_sim;
}

public function setNum_intento($num_intento) {
    $this->num_intento = $num_intento;
}

public function setPuntaje($puntaje) {
    $this->puntaje = $puntaje;
}

public function setPun_porcentual($pun_porcentual) {
    $this->pun_porcentual = $pun_porcentual;
}

public function setEnsayo_id($ensayo_id) {
    $this->ensayo_id = $ensayo_id;
}

public function setUsuario_id($usuario_id) {
    $this->usuario_id = $usuario_id;
}

public function setRestante($restante) {
    $this->restante = $restante;
}

public function setRespondida($respondida) {
    $this->respondida = $respondida;
}


}


?>