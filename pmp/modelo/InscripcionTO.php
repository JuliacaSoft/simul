<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionTO
 *
 * @author Administrador
 */
class InscripcionTO {
   
    public $id_inscripcion; 	
    public $nombres;
    public $apell_paterno;
    public $apell_materno;
    public $sexo;
    public $dni_cedula;
    public $email;
    public $cel_telefono;
    public $pais;
    public $region;
    public $institucion;
    public $tipo_participante;
    public $especialidad;
    public $grado;
    public $clave_confirmacion;
  
    
    public function getId_inscripcion() {
        return $this->id_inscripcion;
    }

    public function setId_inscripcion($id_inscripcion) {
        $this->id_inscripcion = $id_inscripcion;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function getApell_paterno() {
        return $this->apell_paterno;
    }

    public function setApell_paterno($apell_paterno) {
        $this->apell_paterno = $apell_paterno;
    }

    public function getApell_materno() {
        return $this->apell_materno;
    }

    public function setApell_materno($apell_materno) {
        $this->apell_materno = $apell_materno;
    }
    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

        public function getDni_cedula() {
        return $this->dni_cedula;
    }

    public function setDni_cedula($dni_cedula) {
        $this->dni_cedula = $dni_cedula;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getCel_telefono() {
        return $this->cel_telefono;
    }

    public function setCel_telefono($cel_telefono) {
        $this->cel_telefono = $cel_telefono;
    }

    public function getPais() {
        return $this->pais;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function getInstitucion() {
        return $this->institucion;
    }

    public function setInstitucion($institucion) {
        $this->institucion = $institucion;
    }

    public function getTipo_participante() {
        return $this->tipo_participante;
    }

    public function setTipo_participante($tipo_participante) {
        $this->tipo_participante = $tipo_participante;
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }

    public function setEspecialidad($especialidad) {
        $this->especialidad = $especialidad;
    }

    public function getGrado() {
        return $this->grado;
    }

    public function setGrado($grado) {
        $this->grado = $grado;
    }

    public function getClave_confirmacion() {
        return $this->clave_confirmacion;
    }

    public function setClave_confirmacion($clave_confirmacion) {
        $this->clave_confirmacion = $clave_confirmacion;
    }


  
}

?>
