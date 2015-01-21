<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TrabajadorTO
 *
 * @author Administrador
 */
class TrabajadorTO {
    //put your code here    
    public $idTrabajador;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $usuario;
    public $password;
    public $estado;
    
    
    public function getIdTrabajador() {
        return $this->idTrabajador;
    }

    public function setIdTrabajador($idTrabajador) {
        $this->idTrabajador = $idTrabajador;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }


    
}
?>
