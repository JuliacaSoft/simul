<?php


class CursoTO {


public $curso_id;
public $nombre;
public $estado;

public function getCurso_id() {
    return $this->curso_id;
}

public function getNombre() {
    return $this->nombre;
}

public function getEstado() {
    return $this->estado;
}

public function setCurso_id($curso_id) {
    $this->curso_id = $curso_id;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setEstado($estado) {
    $this->estado = $estado;
}


}
?>