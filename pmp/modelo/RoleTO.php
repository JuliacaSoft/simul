<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleTO
 *
 * @author Intel
 */
class RoleTO {
    
    public $role_id;
    public $role;
    public $nombre;
    public $descripcion;
    public $estado;
    
    public function getRole_id() {
        return $this->role_id;
    }

    public function getRole() {
        return $this->role;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setRole_id($role_id) {
        $this->role_id = $role_id;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }



}
