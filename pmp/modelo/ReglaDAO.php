<?php
require_once "ReglaTO.php";
require_once "EnsayoTO.php";
require_once "GrupoTO.php";
require_once "AreaTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class ReglaDAO {

    public function listarRegla() {
        $sql = "Select * from regla";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarReglaTwo() {
        $sql = "Select * from regla";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $reglaTO = new ReglaTO();
                $reglaTO->setNombre($tabla[$a]['nombre']);
                $reglaTO->setEstado($tabla[$a]['estado']);
                $reglaTO->setRegla_id($tabla[$a]['regla_id']);
                $list[$a]=$reglaTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarAreas() {
        $sql = "SELECT * FROM area ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $areaTO = new AreaTO();
                $areaTO->setArea_id($tabla[$a]['area_id']);
                $areaTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$areaTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function listarGrupos() {
        $sql = "SELECT * FROM grupo ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $grupoTO = new GrupoTO();
                $grupoTO->setGrupo_id($tabla[$a]['grupo_id']);
                $grupoTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$grupoTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function listarEnsayos() {
        $sql = "SELECT * FROM ensayo ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);
                $ensayoTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$ensayoTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
  
    public function registrarRegla($ReglaTO){        
        $sql="INSERT INTO regla (nombre, estado, ensayo_id, grupo_id, area_id )VALUES (?,?,?,?,?) ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($ReglaTO->getNombre());
        $sqlQuery->set($ReglaTO->getEstado());
        $sqlQuery->set($ReglaTO->getEnsayo_id());
        $sqlQuery->set($ReglaTO->getGrupo_id());
        $sqlQuery->set($ReglaTO->getArea_id());

        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaRegla($ReglaTO){        
        $sql="UPDATE regla SET nombre = ? , estado = ?  WHERE regla_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($ReglaTO->getNombre());
        $sqlQuery->set($ReglaTO->getEstado());
        $sqlQuery->set($ReglaTO->getRegla_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarRegla($reglaid){        
        $sql="delete from regla where regla_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($reglaid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function buscarIdRegla($id) {
        $sql = "select * from regla where regla_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $reglaTO = new ReglaTO();
                $reglaTO->setNombre($tabla[$a]['nombre']);
                $reglaTO->setEstado($tabla[$a]['estado']);   
                $reglaTO->setRegla_id($tabla[$a]['regla_id']);                
                $list[$a]=$reglaTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarDatosRegla($datos) {
        $sql = "SELECT * FROM regla WHERE UPPER(CONCAT(nombre,' ', estado)) LIKE UPPER(?)";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $reglaTO = new ReglaTO();
                $reglaTO->setNombre($tabla[$a]['nombre']);
                $reglaTO->setEstado($tabla[$a]['estado']);
                $reglaTO->setRegla_id($tabla[$a]['regla_id']);                
                $list[$a]=$reglaTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
}

?>