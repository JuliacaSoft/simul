<?php
require_once "EnsayoTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class GraficosDAO {

    public function listarReporteBarras() {
        $sql = "SELECT nombre, cant_preg FROM ensayo";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function reportUsuario() {
        $sql = "Select * from simulacion";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarResultadoTwo() {
        $sql = "Select * from sim_resultado";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $resultadoTO = new ResultadoTO();
                $resultadoTO->setRevision($tabla[$a]['revision']);
                $resultadoTO->setRespuesta($tabla[$a]['respuesta']);                
                $resultadoTO->setSim_resultado_id($tabla[$a]['sim_resultado_id']);                
                $list[$a]=$resultadoTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarSimulacion() {
        $sql = "SELECT * FROM simulacion ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $simulacionTO = new SimulacionTO();
                $simulacionTO->setRole($tabla[$a]['simulacion_id']);
                //$simulacionTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$simulacionTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
  /*
    public function registrarResultado($ResultadoTO){        
        $sql="INSERT INTO resultado (nombre, apellidos, username, PASSWORD, estado, role_id )VALUES (?,?,?,?,?,?) ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($ResultadoTO->getNombre());
        $sqlQuery->set($ResultadoTO->getApellidos());
        $sqlQuery->set($ResultadoTO->getUsername());
        $sqlQuery->set($ResultadoTO->getPassword());
        $sqlQuery->set($ResultadoTO->getEstado());
        $sqlQuery->set($ResultadoTO->getRole_id());

        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    } 
    */
    
   /* public function actualizaResultado($ResultadoTO){        
        $sql="UPDATE resultado SET nombre = ? , apellidos = ? WHERE resultado_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($ResultadoTO->getNombre());
        $sqlQuery->set($ResultadoTO->getApellidos());
        $sqlQuery->set($ResultadoTO->getResultado_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarResultado($resultadoid){        
        $sql="delete from resultado where resultado_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($resultadoid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    */
    public function buscarIdResultado($id) {
        $sql = "select * from sim_resultado where sim_resultado_id=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $resultadoTO = new ResultadoTO();
                $resultadoTO->setRevision($tabla[$a]['revision']);
                $resultadoTO->setRespuesta($tabla[$a]['respuesta']);                
                $resultadoTO->setSim_resultado_id($tabla[$a]['sim_resultado_id']);                
                $list[$a]=$resultadoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    
}

?>