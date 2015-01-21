<?php

require_once "AreaTO.php";
//require_once "RoleTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class AreaDAO {

    public function listarArea() {
        $sql = "Select * from area";
        try {
            $sqlQuery = new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarAreaTwo() {
        $sql = "Select * from area";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $areaTO = new AreaTO();
                $areaTO->setNombre($tabla[$a]['nombre']);
                // $areaTO->setDescripcion($tabla[$a]['descripcion']);                
                $areaTO->setPeso($tabla[$a]['peso']);
                $areaTO->setEstado($tabla[$a]['estado']);
                $areaTO->setArea_id($tabla[$a]['area_id']);
                $list[$a] = $areaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function listarRoles() {
        $sql = "SELECT * FROM role ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $roleTO = new RoleTO();
                $roleTO->setRole($tabla[$a]['role_id']);
                $roleTO->setNombre($tabla[$a]['nombre']);
                $list[$a] = $roleTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function registrarArea($AreaTO) {
        $sql = "INSERT INTO area (nombre, descripcion, peso, estado )VALUES (?,?,?,?)";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($AreaTO->getNombre());
            $sqlQuery->set($AreaTO->getDescripcion());
            $sqlQuery->set($AreaTO->getPeso());
            $sqlQuery->set($AreaTO->getEstado());

            $resp = QueryExecutor::executeInsert($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function actualizaArea($AreaTO) {
        $sql = "UPDATE area SET nombre = ? , descripcion = ? , peso = ? , estado = ? WHERE area_id = ?  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($AreaTO->getNombre());
            $sqlQuery->set($AreaTO->getDescripcion());
            $sqlQuery->set($AreaTO->getPeso());
            $sqlQuery->set($AreaTO->getEstado());
            $sqlQuery->set($AreaTO->getArea_id());
            $resp = QueryExecutor::executeUpdate($sqlQuery);
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function eliminarArea($areaid) {
        $sql = "delete from area where area_id = ?  ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($areaid);
            QueryExecutor::executeDelete($sqlQuery);
            $resp = 1;
            return $resp;
        } catch (Exception $e) {
            return $resp = $e->getMessage();
            //throw new Exception("Error :".$e->getMessage());
        }
    }

    public function buscarIdArea($id) {
        $sql = "select * from area where area_id=?";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $areaTO = new AreaTO();
                $areaTO->setNombre($tabla[$a]['nombre']);
                $areaTO->setDescripcion($tabla[$a]['descripcion']);
                $areaTO->setPeso($tabla[$a]['peso']);
                $areaTO->setEstado($tabla[$a]['estado']);
                $areaTO->setArea_id($tabla[$a]['area_id']);
                $list[$a] = $areaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function buscarDatosArea($datos) {
        $sql = "SELECT * FROM area WHERE UPPER(CONCAT(nombre,' ', descripcion)) LIKE UPPER('%" . $datos . "%')";
        try {
            $sqlQuery = new SqlQuery($sql);
            // $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list = array();
            for ($a = 0; $a < count($tabla); $a++) {
                $areaTO = new AreaTO();
                $areaTO->setNombre($tabla[$a]['nombre']);
                $areaTO->setDescripcion($tabla[$a]['descripcion']);
                $areaTO->setPeso($tabla[$a]['peso']);
                $areaTO->setEstado($tabla[$a]['estado']);
                $areaTO->setArea_id($tabla[$a]['area_id']);
                $list[$a] = $areaTO;
            }
            return $list;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function buscarDatosAreaAuto($datos) {
        $sql = "SELECT * FROM area WHERE UPPER(CONCAT(nombre,' ', descripcion)) LIKE UPPER('%" . $datos . "%')";
        try {
            $sqlQuery = new SqlQuery($sql);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

    public function validarPesoArea() {
        $sql = "select sum(peso) as sumapeso from area where estado=1";
        try {
            $sqlQuery = new SqlQuery($sql);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }
    
    public function validarPesoAreaEdit($areaid) {
        $sql = "select peso as pesoedit from area where area_id=? ";
        try {
            $sqlQuery = new SqlQuery($sql);
            $sqlQuery->set($areaid);
            //$sqlQuery->set("'%".$datos."%'");
            $tabla = QueryExecutor::execute($sqlQuery);

            return $tabla;
        } catch (Exception $e) {
            throw new Exception("Error :" . $e->getMessage());
        }
    }

}

?>