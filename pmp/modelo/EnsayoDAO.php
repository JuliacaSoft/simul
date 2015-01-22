<?php
require_once "EnsayoTO.php";
require_once "CursoTO.php";
require_once "GrupoTO.php";
require_once "AreaTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";

class EnsayoDAO {

    public function listarEnsayo() {
        $sql = "select *, case en.tipo when 2 then (select a.nombre from area a where a.area_id=en.t_dependencia  ) when 3 then (select g.nombre from grupo g where g.grupo_id=en.t_dependencia) when 1 then (case en.t_dependencia when 'A' then 'Area de Conocimienco' when 'G' then 'Grupo de Proceso' end)   end as nombre_dependencia , cu.nombre nomcurso, case en.tipo when 2 then 'Area de Conocimiento' when 3 then 'Grupo de Procesos' when 1 then 'GLobal'  end as tipo_nombre from ensayo en , curso cu where en.curso_id=cu.curso_id";
        
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarEnsayoTwo() {
        $sql = "Select * from ensayo ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setNombre($tabla[$a]['nombre']);
                $ensayoTO->setTipo($tabla[$a]['tipo']);
                $ensayoTO->setT_dependencia($tabla[$a]['t_dependencia']);
                $ensayoTO->setTiempo($tabla[$a]['tiempo']);
                $ensayoTO->setPorc_aprobacion($tabla[$a]['porc_aprobacion']);
                $ensayoTO->setCurso_id($tabla[$a]['curso_id']);
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);                
                $list[$a]=$ensayoTO;
            }
            return $list;
        }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function listarCursos() {
        $sql = "SELECT * FROM curso ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $cursoTO = new CursoTO();
                $cursoTO->setCurso_id($tabla[$a]['curso_id']);
                $cursoTO->setNombre($tabla[$a]['nombre']);                
                $list[$a]=$cursoTO;
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
    
    public function registrarEnsayo($EnsayoTO){        
        $sql="INSERT INTO ensayo (nombre, descripcion, tipo, t_dependencia, tiempo, intento, cant_preg, porc_aprobacion, estado, curso_id )VALUES (?,?,?,?,?,?,?,?,?,?) ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($EnsayoTO->getNombre());
        $sqlQuery->set($EnsayoTO->getDescripcion());
        $sqlQuery->set($EnsayoTO->getTipo());
        $sqlQuery->set($EnsayoTO->getT_dependencia());
        $sqlQuery->set($EnsayoTO->getTiempo());
        $sqlQuery->set($EnsayoTO->getIntento());
        $sqlQuery->set($EnsayoTO->getCant_preg());
        $sqlQuery->set($EnsayoTO->getPorc_aprobacion());
        $sqlQuery->set($EnsayoTO->getEstado());
        $sqlQuery->set($EnsayoTO->getCurso_id());
        
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    public function actualizaEnsayo($EnsayoTO){        
        $sql="UPDATE ensayo SET nombre = ? , descripcion = ? , tipo = ? , t_dependencia = ? , tiempo = ? , intento = ? , cant_preg = ? , porc_aprobacion = ? , estado = ? , curso_id = ? WHERE ensayo_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($EnsayoTO->getNombre());
        $sqlQuery->set($EnsayoTO->getDescripcion());
        $sqlQuery->set($EnsayoTO->getTipo());
        $sqlQuery->set($EnsayoTO->getT_dependencia());
        $sqlQuery->set($EnsayoTO->getTiempo());
        $sqlQuery->set($EnsayoTO->getIntento());
        $sqlQuery->set($EnsayoTO->getCant_preg());
        $sqlQuery->set($EnsayoTO->getPorc_aprobacion());
        $sqlQuery->set($EnsayoTO->getEstado());
        $sqlQuery->set($EnsayoTO->getCurso_id());
        $sqlQuery->set($EnsayoTO->getEnsayo_id());
        $resp=QueryExecutor::executeUpdate($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }   
    
    
    
    public function eliminarEnsayo($ensayoid){        
        $sql="delete from ensayo where ensayo_id = ?  ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($ensayoid);
        QueryExecutor::executeDelete($sqlQuery);
        $resp=1;
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarIdEnsayo($id) {
        $sql = "select * from ensayo where ensayo_id = ?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setNombre($tabla[$a]['nombre']);
                $ensayoTO->setDescripcion($tabla[$a]['descripcion']);
                $ensayoTO->setTipo($tabla[$a]['tipo']);
                $ensayoTO->setTiempo($tabla[$a]['tiempo']);
                $ensayoTO->setIntento($tabla[$a]['intento']);
                $ensayoTO->setCant_preg($tabla[$a]['cant_preg']);
                $ensayoTO->setPorc_aprobacion($tabla[$a]['porc_aprobacion']);
                $ensayoTO->setEstado($tabla[$a]['estado']);
                $ensayoTO->setCurso_id($tabla[$a]['curso_id']);
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);     
                $ensayoTO->setT_dependencia($tabla[$a]['t_dependencia']);
                
                $list[$a]=$ensayoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function buscarIdEnsayoArea($id) {
        $sql = "select e.*, a.nombre as area_nombre, a.area_id from ensayo e, area a where e.t_dependencia=a.area_id and ensayo_id=? ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setNombre($tabla[$a]['nombre']);
                $ensayoTO->setDescripcion($tabla[$a]['descripcion']);
                $ensayoTO->setTipo($tabla[$a]['tipo']);
                $ensayoTO->setTiempo($tabla[$a]['tiempo']);
                $ensayoTO->setIntento($tabla[$a]['intento']);
                $ensayoTO->setCant_preg($tabla[$a]['cant_preg']);
                $ensayoTO->setPorc_aprobacion($tabla[$a]['porc_aprobacion']);
                $ensayoTO->setEstado($tabla[$a]['estado']);
                $ensayoTO->setCurso_id($tabla[$a]['curso_id']);
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);     
                 $ensayoTO->setT_dependencia($tabla[$a]['t_dependencia']);
                $ensayoTO->setDependencia_nombre($tabla[$a]['area_nombre']);
                $list[$a]=$ensayoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    public function buscarIdEnsayoGrupo($id) {
        $sql = "select e.*, g.nombre as grupo_nombre, g.grupo_id from ensayo e, grupo g where e.t_dependencia=g.grupo_id and ensayo_id = ?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setNombre($tabla[$a]['nombre']);
                $ensayoTO->setDescripcion($tabla[$a]['descripcion']);
                $ensayoTO->setTipo($tabla[$a]['tipo']);
                $ensayoTO->setTiempo($tabla[$a]['tiempo']);
                $ensayoTO->setIntento($tabla[$a]['intento']);
                $ensayoTO->setCant_preg($tabla[$a]['cant_preg']);
                $ensayoTO->setPorc_aprobacion($tabla[$a]['porc_aprobacion']);
                $ensayoTO->setEstado($tabla[$a]['estado']);
                $ensayoTO->setCurso_id($tabla[$a]['curso_id']);
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);  
                $ensayoTO->setT_dependencia($tabla[$a]['t_dependencia']);
                $ensayoTO->setDependencia_nombre($tabla[$a]['grupo_nombre']);
                
                $list[$a]=$ensayoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    public function buscarDatosEnsayo($datos) {
        $sql = "SELECT * FROM ensayo WHERE UPPER(CONCAT(nombre,' ', descripcion)) LIKE UPPER(?)";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->setString("'%"+$datos+"%'");
            $tabla = QueryExecutor::execute($sqlQuery);
            $list=array();
            for ($a = 0; $a < count($tabla); $a++) {
                $ensayoTO = new EnsayoTO();
                $ensayoTO->setNombre($tabla[$a]['nombre']);
                $ensayoTO->setApellidos($tabla[$a]['descripcion']);
                $ensayoTO->setEnsayo_id($tabla[$a]['ensayo_id']);                
                $list[$a]=$ensayoTO;
            }
            return $list;
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function buscarAreasConocimiento() {
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
        public function buscarGrupoProcesos() {
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
    
}

?>