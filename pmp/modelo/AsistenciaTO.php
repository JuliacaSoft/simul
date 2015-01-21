<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsistenciaTO
 *
 * @author Administrador
 */
class AsistenciaTO {
    public $id_asistencia;
    public $fecha;
    public $numero;
    public $estado;
    public $id_inscripcion;
    public $id_trabajador;
    
    
    
    public function getId_asistencia() {
        return $this->id_asistencia;
    }

    public function setId_asistencia($id_asistencia) {
        $this->id_asistencia = $id_asistencia;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    
    public function getId_inscripcion() {
        return $this->id_inscripcion;
    }

    public function setId_inscripcion($id_inscripcion) {
        $this->id_inscripcion = $id_inscripcion;
    }

    public function getId_trabajador() {
        return $this->id_trabajador;
    }

    public function setId_trabajador($id_trabajador) {
        $this->id_trabajador = $id_trabajador;
    }


    
}

?>
