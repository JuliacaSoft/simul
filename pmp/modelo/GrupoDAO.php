<?php
require_once "GrupoTO.php";
//require_once "RoleTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class GrupoDAO {

    public function listarGrupo() {
        $sql = "Select * from grupo";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarGrupoTwo() {
        $sql = "Select * from grupo";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $grupoTO = new GrupoTO();
                $grupoTO->setNombre($tabla[$a]['nombre']);
               // $grupoTO->setDescripcion($tabla[$a]['descripcion']);                
                $grupoTO->setPeso($tabla[$a]['peso']);
                $grupoTO->setEstado($tabla[$a]['estado']);
                $grupoTO->setGrupo_id($tabla[$a]['grupo_id']);
                $list[$a]=$grupoTO;
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
  
    public function registrarGrupo($GrupoTO){        
        $sql="INSERT INTO grupo (nombre, descripcion, peso, estado )VALUES (?,?,?,?)";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($GrupoTO->getNombre());
        $sqlQuery->set($GrupoTO->getDescripcion());
        $sqlQuery->set($GrupoTO->getPeso());
        $sqlQuery->set($GrupoTO->getEstado());
        
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaGrupo($GrupoTO){        
        $sql="UPDATE grupo SET nombre = ? , descripcion = ? , peso = ? , estado = ? WHERE grupo_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($GrupoTO->getNombre());
        $sqlQuery->set($GrupoTO->getDescripcion());
        $sqlQuery->set($GrupoTO->getPeso());
        $sqlQuery->set($GrupoTO->getEstado());
        $sqlQuery->set($GrupoTO->getGrupo_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarGrupo($grupoid){        
        $sql="delete from grupo where grupo_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($grupoid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function buscarIdGrupo($id) {
        $sql = "select * from grupo where grupo_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $grupoTO = new GrupoTO();
                $grupoTO->setNombre($tabla[$a]['nombre']);
                $grupoTO->setDescripcion($tabla[$a]['descripcion']);                
                $grupoTO->setPeso($tabla[$a]['peso']);                
                $grupoTO->setEstado($tabla[$a]['estado']);                
                $grupoTO->setGrupo_id($tabla[$a]['grupo_id']); 
                $list[$a]=$grupoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosGrupo($datos) {
        $sql = "SELECT * FROM grupo WHERE UPPER(CONCAT( nombre,' ', descripcion)) LIKE UPPER('%".$datos."%')";
        try {
            $sqlQuery=new SqlQuery($sql);
           // $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $grupoTO = new GrupoTO();
                $grupoTO->setNombre($tabla[$a]['nombre']);
                $grupoTO->setDescripcion($tabla[$a]['descripcion']);
                $grupoTO->setPeso($tabla[$a]['peso']);                
                $grupoTO->setEstado($tabla[$a]['estado']);
                $grupoTO->setGrupo_id($tabla[$a]['grupo_id']);
                $list[$a]=$grupoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    } 
    public function buscarDatosGrupoAuto($datos) {
        $sql = "SELECT * FROM grupo WHERE UPPER(CONCAT(nombre,' ', descripcion)) LIKE UPPER('%".$datos."%')";
        try {
            $sqlQuery=new SqlQuery($sql);
           //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);
    
            return $tabla;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function validarPesoGrupo() {
        $sql = "select sum(peso) as sumapeso from grupo where estado=1";
        try {
            $sqlQuery = new SqlQuery($sql);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }
    
    public function validarPesoGrupoEdit($grupoid) {
        $sql = "select peso as pesoedit from grupo where grupo_id=?";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($grupoid);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }
    
}

?>