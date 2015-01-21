<?php


class GrupoTO {


public $grupo_id;
public $nombre;
public $descripcion;
public $peso;
public $estado;

public function getGrupo_id() {
    return $this->grupo_id;
}

public function getNombre() {
    return $this->nombre;
}

public function getDescripcion() {
    return $this->descripcion;
}

public function getPeso() {
    return $this->peso;
}

public function getEstado() {
    return $this->estado;
}

public function setGrupo_id($grupo_id) {
    $this->grupo_id = $grupo_id;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

public function setPeso($peso) {
    $this->peso = $peso;
}

public function setEstado($estado) {
    $this->estado = $estado;
}


}
?>