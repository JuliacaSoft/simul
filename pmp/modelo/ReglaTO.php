<?php


class ReglaTO {


public $regla_id;
public $nombre;
public $estado;
public $ensayo_id;
public $grupo_id;
public $area_id;

public function getRegla_id() {
    return $this->regla_id;
}

public function getNombre() {
    return $this->nombre;
}

public function getEstado() {
    return $this->estado;
}

public function getEnsayo_id() {
    return $this->ensayo_id;
}

public function getGrupo_id() {
    return $this->grupo_id;
}

public function getArea_id() {
    return $this->area_id;
}

public function setRegla_id($regla_id) {
    $this->regla_id = $regla_id;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setEstado($estado) {
    $this->estado = $estado;
}

public function setEnsayo_id($ensayo_id) {
    $this->ensayo_id = $ensayo_id;
}

public function setGrupo_id($grupo_id) {
    $this->grupo_id = $grupo_id;
}

public function setArea_id($area_id) {
    $this->area_id = $area_id;
}


}
?>