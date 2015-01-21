<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsistenciaDAO
 *
 * @author Administrador
 */
require_once "AsistenciaTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";
class AsistenciaDAO {

    public function registrarAsistencia($AsistenciaTO){
        $sql="INSERT INTO asistencia(fecha,  numero, estado, id_inscripcion, id_trabajador) VALUES (now(),'0','0',?,?) ";
        try {
        $sqlQuery=new SqlQuery($sql);    
        $sqlQuery->set($AsistenciaTO->getId_inscripcion());
        $sqlQuery->set($AsistenciaTO->getId_trabajador());
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }
    public function actualizarAsistencia(){
        $sql="UPDATE asistencia SET numero=?, estado='1' WHERE numero='0' ";
        try {
        $sqlQuery=new SqlQuery($sql);    
        $maxNum=new AsistenciaDAO();        
        $num=$maxNum->maxAsistencia();
        $sqlQuery->set($num[0]['numero']);
        $resp=QueryExecutor::executeInsert($sqlQuery);
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function selectIdInscrito($codigo){
        $sql="select * from inscripcion where codigo=?";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($codigo);
        return QueryExecutor::execute($sqlQuery);        
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        }                
    }
    public function selectRegistrado($idInscrito){
        $sql="SELECT * FROM asistencia WHERE estado='0' AND id_inscripcion=? ";
        try {
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set($idInscrito);
        return QueryExecutor::execute($sqlQuery);        
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        }                
    }
    
    public function mostrarCantidadASistencia(){
        $sql="SELECT COUNT(*) AS cantidad FROM asistencia WHERE estado='0' ";
        try {
        $sqlQuery=new SqlQuery($sql);     
        return QueryExecutor::execute($sqlQuery);        
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        }                
    }
    public function maxAsistencia(){
        $sql="SELECT MAX(numero)+1 AS numero FROM asistencia ";
        try {
        $sqlQuery=new SqlQuery($sql);     
        return QueryExecutor::execute($sqlQuery);        
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        }                
    }
    
}

?>
