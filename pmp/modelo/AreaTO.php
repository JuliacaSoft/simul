<?php


class AreaTO {


public $area_id;
public $nombre;
public $descripcion;
public $peso;
public $estado;

public function getArea_id() {
    return $this->area_id;
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

public function setArea_id($area_id) {
    $this->area_id = $area_id;
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