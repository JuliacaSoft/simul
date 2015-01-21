<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InscripcionDAO
 *
 * @author Administrador
 */
require_once "InscripcionTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";
require_once "../util/sql/MD5Crypt.php";

class InscripcionDAO {
    public function registrarInscripcion($InscripcionTO){
        $sqlopt="SELECT (CASE WHEN CONCAT('7',LPAD(MAX(SUBSTRING(codigo, 2,3)), 3, '0')) IS NULL THEN '7001' ELSE CAST((CONCAT('7',LPAD(MAX(SUBSTRING(codigo, 2,3)), 3, '0'))) AS SIGNED)+1 END) AS codigo  FROM inscripcion";
        
        
        $sql="INSERT INTO inscripcion (nombres, apell_paterno, apell_materno, 
            sexo, dni_cedula, email, cel_telefono, pais, region, 
            institucion, tipo_participante, especialidad, grado, clave_confirmacion, codigo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
        try {
            
        $sqlQueryO=new SqlQuery($sqlopt);    
        $codData=  QueryExecutor::execute($sqlQueryO);
        
        
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($InscripcionTO->getNombres());
        $sqlQuery->set($InscripcionTO->getApell_paterno());
        $sqlQuery->set($InscripcionTO->getApell_materno());
        $sqlQuery->set($InscripcionTO->getSexo());
        $sqlQuery->set($InscripcionTO->getDni_cedula());
        $sqlQuery->set($InscripcionTO->getEmail());
        $sqlQuery->set($InscripcionTO->getCel_telefono());
        $sqlQuery->set($InscripcionTO->getPais());
        $sqlQuery->set($InscripcionTO->getRegion());
        $sqlQuery->set($InscripcionTO->getInstitucion());
        $sqlQuery->set($InscripcionTO->getTipo_participante());
        $sqlQuery->set($InscripcionTO->getEspecialidad());
        $sqlQuery->set($InscripcionTO->getGrado());
        $sqlQuery->set(MD5Crypt::getEncrypt($InscripcionTO->getDni_cedula().'dmp'));
        $sqlQuery->set($codData[0]['codigo']);
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }

    
    public function mostrarDatosInscrito($id) {
        $sql = "select * from inscripcion where id_inscripcion=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($id);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    public function validarDni($dni) {
        $sql = "SELECT * FROM inscripcion WHERE dni_cedula=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($dni);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }

    public function viewPais(){
        $sql = "SELECT * FROM pais ";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    public function viewEspecialidad(){
        $sql = "SELECT * FROM especialidad ";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    
    public function mostRegion($pais){
        $sql = "SELECT * FROM region WHERE pais=? ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($pais);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    public function codigoBarra($codIni, $codFin){
        $sql = "SELECT (CONCAT(apell_paterno, ' ', apell_materno, ' ', SUBSTRING_INDEX(nombres, ' ',1))) AS nombre, codigo FROM inscripcion WHERE CONVERT(codigo USING utf8) BETWEEN ? AND ? ORDER BY nombre  ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->setNumber($codIni);
            $sqlQuery->setNumber($codFin);            
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    
    public function dniClave($InscripcionTO){
        $sql = "SELECT * FROM inscripcion WHERE dni_cedula=? AND clave_confirmacion=?";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($InscripcionTO->getDni_cedula());
            $sqlQuery->set($InscripcionTO->getClave_confirmacion());
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
    
    
    public function exportExcel($opt){
        if($opt=='0'){
        $sql = "SELECT 
                i.apell_paterno as paterno,
                i.apell_materno as materno,
                i.nombres as nombre,
                (CASE WHEN i.sexo='M' THEN 'Masculino' ELSE 'Femenino' END) AS sexo,
                i.dni_cedula as documento,
                i.email,
                i.cel_telefono as fono,
                i.institucion, 
                (CASE WHEN i.tipo_participante='D' THEN 'Delegación' ELSE 'Independiente' END) AS participante,
                i.grado,
                (SELECT e.nombre FROM especialidad  e WHERE e.id=i.especialidad) AS especialidad,
                i.codigo
                 FROM inscripcion i                 
                ORDER BY apell_paterno, apell_materno, nombres	";   
        }else{
            
        $sql = "SELECT 
                i.apell_paterno as paterno,
                i.apell_materno as materno,
                i.nombres as nombre,
                (CASE WHEN i.sexo='M' THEN 'Masculino' ELSE 'Femenino' END) AS sexo,
                i.dni_cedula as documento,
                i.email,
                i.cel_telefono as fono,
                i.institucion, 
                (CASE WHEN i.tipo_participante='D' THEN 'Delegación' ELSE 'Independiente' END) AS participante,
                i.grado,
                (SELECT e.nombre FROM especialidad  e WHERE e.id=i.especialidad) AS especialidad,
                i.codigo
                 FROM inscripcion i 
                where i.id_inscripcion in (SELECT id_inscripcion FROM confirmacion where estado='confirmado')
                ORDER BY apell_paterno, apell_materno, nombres	";  
        
//        $sql = "SELECT 
//                i.apell_paterno as paterno,
//                i.apell_materno as materno,
//                i.nombres as nombre,
//                (CASE WHEN i.sexo='M' THEN 'Masculino' ELSE 'Femenino' END) AS sexo,
//                i.dni_cedula as documento,
//                i.email,
//                i.cel_telefono as fono,
//                i.institucion, 
//                (CASE WHEN i.tipo_participante='D' THEN 'Delegación' ELSE 'Independiente' END) AS participante,
//                i.grado,
//                (SELECT e.nombre FROM especialidad  e WHERE e.id=i.especialidad) AS especialidad,
//                i.codigo
//                 FROM inscripcion i 
//                where i.id_inscripcion in (SELECT id_inscripcion FROM depositos)
//                ORDER BY apell_paterno, apell_materno, nombres	";     
        }                
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }
}

?>
