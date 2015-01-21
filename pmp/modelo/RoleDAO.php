<?php
require_once "RoleTO.php";
//require_once "RoleTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class RoleDAO {

    public function listarRole() {
        $sql = "Select * from role";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarRoleTwo() {
        $sql = "Select * from role";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $roleTO = new RoleTO();
                $roleTO->setNombre($tabla[$a]['nombre']);
                $roleTO->setEstado($tabla[$a]['estado']);
                $roleTO->setRole_id($tabla[$a]['role_id']); 
                $list[$a]=$roleTO;
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
  
    public function registrarRole($RoleTO){        
        $sql="INSERT INTO role (nombre, descripcion, estado )VALUES (?,?,?)";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($RoleTO->getNombre());
        $sqlQuery->set($RoleTO->getDescripcion());
        
        $sqlQuery->set($RoleTO->getEstado());
        
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaRole($RoleTO){        
        $sql="UPDATE role SET nombre = ? , descripcion = ? , estado = ? WHERE role_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($RoleTO->getNombre());
        $sqlQuery->set($RoleTO->getDescripcion());
        
        $sqlQuery->set($RoleTO->getEstado());
        $sqlQuery->set($RoleTO->getRole_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarRole($roleid){        
        $sql="delete from role where role_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($roleid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function buscarIdRole($id) {
        $sql = "select * from role where role_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $roleTO = new RoleTO();
                $roleTO->setNombre($tabla[$a]['nombre']);
                $roleTO->setDescripcion($tabla[$a]['descripcion']);                
                $roleTO->setEstado($tabla[$a]['estado']);                
                $roleTO->setRole_id($tabla[$a]['role_id']);  
                $list[$a]=$roleTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosRole($datos) {
        $sql = "SELECT * FROM role WHERE UPPER(CONCAT(nombre,' ', descripcion)) LIKE UPPER(?)";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $roleTO = new RoleTO();
                $roleTO->setNombre($tabla[$a]['nombre']);
                $roleTO->setDescripcion($tabla[$a]['descripcion']);
                $roleTO->setEstado($tabla[$a]['estado']);
                $list[$a]=$roleTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
}

?>