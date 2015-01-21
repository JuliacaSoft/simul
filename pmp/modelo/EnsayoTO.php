<?php


class EnsayoTO {


public $ensayo_id;
public $nombre;
public $descripcion;
public $tipo;
public $t_dependencia;
public $tiempo;
public $intento;
public $cant_preg;
public $porc_aprobacion;
public $estado;
public $curso_id;

public function getEnsayo_id() {
    return $this->ensayo_id;
}

public function getNombre() {
    return $this->nombre;
}

public function getDescripcion() {
    return $this->descripcion;
}

public function getTipo() {
    return $this->tipo;
}

public function getT_dependencia() {
    return $this->t_dependencia;
}

public function getTiempo() {
    return $this->tiempo;
}

public function getIntento() {
    return $this->intento;
}

public function getCant_preg() {
    return $this->cant_preg;
}

public function getPorc_aprobacion() {
    return $this->porc_aprobacion;
}

public function getEstado() {
    return $this->estado;
}

public function getCurso_id() {
    return $this->curso_id;
}

public function setEnsayo_id($ensayo_id) {
    $this->ensayo_id = $ensayo_id;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

public function setTipo($tipo) {
    $this->tipo = $tipo;
}

public function setT_dependencia($t_dependencia) {
    $this->t_dependencia = $t_dependencia;
}

public function setTiempo($tiempo) {
    $this->tiempo = $tiempo;
}

public function setIntento($intento) {
    $this->intento = $intento;
}

public function setCant_preg($cant_preg) {
    $this->cant_preg = $cant_preg;
}

public function setPorc_aprobacion($porc_aprobacion) {
    $this->porc_aprobacion = $porc_aprobacion;
}

public function setEstado($estado) {
    $this->estado = $estado;
}

public function setCurso_id($curso_id) {
    $this->curso_id = $curso_id;
}


}


?>