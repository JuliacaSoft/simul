<?php
require_once "UsuarioTO.php";
require_once "RoleTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class UsuarioDAO {

    public function listarUsuario() {
        $sql = "Select * from usuario";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarUsuarioTwo() {
        $sql = "Select * from usuario";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $usuarioTO = new UsuarioTO();
                $usuarioTO->setNombre($tabla[$a]['nombre']);
                $usuarioTO->setApellidos($tabla[$a]['apellidos']);                
                $usuarioTO->setUsuario_id($tabla[$a]['usuario_id']);                
                $list[$a]=$usuarioTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarRoles() {
        $sql = "SELECT * FROM role ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $roleTO = new RoleTO();
                $roleTO->setRole($tabla[$a]['role_id']);
                $roleTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$roleTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
  
    public function registrarUsuario($UsuarioTO){        
        $sql="INSERT INTO usuario (nombre, apellidos, username, PASSWORD, estado, role_id )VALUES (?,?,?,?,?,?) ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($UsuarioTO->getNombre());
        $sqlQuery->set($UsuarioTO->getApellidos());
        $sqlQuery->set($UsuarioTO->getUsername());
        $sqlQuery->set($UsuarioTO->getPassword());
        $sqlQuery->set($UsuarioTO->getEstado());
        $sqlQuery->set($UsuarioTO->getRole_id());

        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaUsuario($UsuarioTO){        
        $sql="UPDATE usuario SET nombre = ? , apellidos = ? WHERE usuario_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($UsuarioTO->getNombre());
        $sqlQuery->set($UsuarioTO->getApellidos());
        $sqlQuery->set($UsuarioTO->getUsuario_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarUsuario($usuarioid){        
        $sql="delete from usuario where usuario_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($usuarioid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function buscarIdUsuario($id) {
        $sql = "select * from usuario where usuario_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $usuarioTO = new UsuarioTO();
                $usuarioTO->setNombre($tabla[$a]['nombre']);
                $usuarioTO->setApellidos($tabla[$a]['apellidos']);                
                $usuarioTO->setUsuario_id($tabla[$a]['usuario_id']);                
                $list[$a]=$usuarioTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosUsuario($datos) {
        $sql = "SELECT * FROM usuario WHERE UPPER(CONCAT(nombre,' ', apellidos)) LIKE UPPER('%".$datos."%')";
        try {
            $sqlQuery=new SqlQuery($sql);
            
           // $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $usuarioTO = new UsuarioTO();
                $usuarioTO->setNombre($tabla[$a]['nombre']);
                $usuarioTO->setApellidos($tabla[$a]['apellidos']);                
                $usuarioTO->setUsuario_id($tabla[$a]['usuario_id']);                
                $list[$a]=$usuarioTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosUsuarioAuto($datos) {
        $sql = "SELECT * FROM usuario WHERE UPPER(CONCAT(nombre,' ', apellidos)) LIKE UPPER('%".$datos."%')";
        try {
            $sqlQuery=new SqlQuery($sql);
           //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);
    
            return $tabla;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function preValidaxion($username) {
        $sql = "SELECT * FROM usuario WHERE username='".$username."'  ";
        try {
            $sqlQuery=new SqlQuery($sql);           
            $tabla = QueryExecutor::execute($sqlQuery);    
            return $tabla;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function preXValidaxion($username, $password) {
        $sql = "SELECT * FROM usuario WHERE username='".$username."'  AND PASSWORD='".$password."' ";
        try {
            $sqlQuery=new SqlQuery($sql);           
            $tabla = QueryExecutor::execute($sqlQuery);    
            return $tabla;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function validaxion($username, $password) {
        $sql = "SELECT u.*, (CASE WHEN r.nombre='Administrador' THEN '1' WHEN r.nombre='Docente' THEN '2' WHEN r.nombre='Estudiante' THEN '3' ELSE '3' END) AS nivel FROM usuario u, role r WHERE u.estado=1 AND r.role_id=u.role_id AND u.username='".$username."' AND u.password='".$password."'  ";
        try {
            $sqlQuery=new SqlQuery($sql);           
            $tabla = QueryExecutor::execute($sqlQuery);    
            return $tabla;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
}

?>