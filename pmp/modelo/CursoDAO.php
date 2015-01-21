<?php
require_once "CursoTO.php";
//require_once "RoleTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class CursoDAO {

    public function listarCurso() {
        $sql = "Select * from curso";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarCursoTwo() {
        $sql = "Select * from curso";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $cursoTO = new CursoTO();
                $cursoTO->setNombre($tabla[$a]['nombre']);
                $cursoTO->setEstado($tabla[$a]['estado']);
                $cursoTO->setCurso_id($tabla[$a]['curso_id']); 
                $list[$a]=$cursoTO;
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
  
    public function registrarCurso($CursoTO){        
        $sql="INSERT INTO curso (nombre,  estado )VALUES (?,?)";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($CursoTO->getNombre());
        $sqlQuery->set($CursoTO->getEstado());
        
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaCurso($CursoTO){        
        $sql="UPDATE curso SET nombre = ?  , estado = ? WHERE curso_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($CursoTO->getNombre());
        $sqlQuery->set($CursoTO->getEstado());
        $sqlQuery->set($CursoTO->getCurso_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarCurso($cursoid){        
        $sql="delete from curso where curso_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($cursoid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function buscarIdCurso($id) {
        $sql = "select * from curso where curso_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $cursoTO = new CursoTO();
                $cursoTO->setNombre($tabla[$a]['nombre']);         
                $cursoTO->setEstado($tabla[$a]['estado']);                
                $cursoTO->setCurso_id($tabla[$a]['curso_id']);  
                $list[$a]=$cursoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosCurso($datos) {
        $sql = "SELECT * FROM curso WHERE UPPER(CONCAT(nombre )) LIKE UPPER(?)";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $cursoTO = new CursoTO();
                $cursoTO->setNombre($tabla[$a]['nombre']);
                $cursoTO->setEstado($tabla[$a]['estado']);
                $list[$a]=$cursoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
}

?>