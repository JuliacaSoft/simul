<?php


class UsuarioTO {


public $usuario_id;
public $nombre;
public $apellidos;
public $username;
public $password;
public $estado;
public $role_id;
  

public function getUsuario_id() {
    return $this->usuario_id;
}

public function getNombre() {
    return $this->nombre;
}

public function getApellidos() {
    return $this->apellidos;
}

public function getUsername() {
    return $this->username;
}

public function getPassword() {
    return $this->password;
}

public function getEstado() {
    return $this->estado;
}

public function getRole_id() {
    return $this->role_id;
}

public function setUsuario_id($usuario_id) {
    $this->usuario_id = $usuario_id;
}

public function setNombre($nombre) {
    $this->nombre = $nombre;
}

public function setApellidos($apellidos) {
    $this->apellidos = $apellidos;
}

public function setUsername($username) {
    $this->username = $username;
}

public function setPassword($password) {
    $this->password = $password;
}

public function setEstado($estado) {
    $this->estado = $estado;
}

public function setRole_id($role_id) {
    $this->role_id = $role_id;
}




}


?>