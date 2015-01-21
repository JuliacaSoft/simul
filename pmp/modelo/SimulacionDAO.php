<?php
require_once "SimulacionTO.php";
require_once "SimulacionTO.php";
require_once "EnsayoTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class SimulacionDAO {

    public function listarSimulacion() {
        $sql = "Select * from simulacion";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarSimulacionTwo() {
        $sql = "Select * from simulacion";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $simulacionTO = new SimulacionTO();
                $simulacionTO->setEstado_sim($tabla[$a]['estado_sim']);
                $simulacionTO->setPuntaje($tabla[$a]['puntaje']);                
                $simulacionTO->setSimulacion_id($tabla[$a]['simulacion_id']);                
                $list[$a]=$simulacionTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarUsuario() {
        $sql = "SELECT * FROM usuario ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $usuarioTO = new UsuarioTO();
                $usuarioTO->setRole($tabla[$a]['usuario_id']);
                $usuarioTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$usuarioTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
        public function listarEnsayo() {
        $sql = "SELECT * FROM ensayo ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setRole($tabla[$a]['ensayo_id']);
                $ensayoTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$ensayoTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }   
  
    
}

?>