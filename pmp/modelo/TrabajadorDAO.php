<?php

require_once "TrabajadorTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class TrabajadorDAO {

    public function listarTrabajador() {
        $sql = "Select * from trabajador";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarTrabajarorTwo() {
        $sql = "Select * from trabajador";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $trabajadorTO = new TrabajadorTO();
                $trabajadorTO->setNombre($tabla[$a]['nombre']);
                $trabajadorTO->setApellidos($tabla[$a]['apellidos']);                
                $list[$a]=$trabajadorTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    
}

?>