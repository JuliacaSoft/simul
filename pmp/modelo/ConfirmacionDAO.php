<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfirmacionDAO
 *
 * @author Administrador
 */
require_once "ConfirmacionTO.php";
require_once "../util/sql/SqlQuery.php";
require_once "../util/sql/QueryExecutor.php";
class ConfirmacionDAO {

    public function registrarConfirmacion($ConfirmacionTO){
        $sqlVerif="select * from confirmacion where id_inscripcion=?";               
        $sql="INSERT INTO confirmacion (estado, num_deposito, id_inscripcion) VALUES (?, ?, ?) ";
        $sqlU="UPDATE  confirmacion SET num_deposito=? WHERE id_inscripcion=?";
        try {
        $sqlQueryVerif=new SqlQuery($sqlVerif);
        $sqlQueryVerif->set($ConfirmacionTO->getId_inscripcion());
        $data=QueryExecutor::execute($sqlQueryVerif); 
        if(count($data)>0){
        $sqlQueryU=new SqlQuery($sqlU);       
        $sqlQueryU->set($ConfirmacionTO->getNum_deposito());
        $sqlQueryU->set($ConfirmacionTO->getId_inscripcion());
        $resp=QueryExecutor::executeUpdate($sqlQueryU);                 
        }else{
        $sqlQuery=new SqlQuery($sql);
        $sqlQuery->set("proceso");
        $sqlQuery->set($ConfirmacionTO->getNum_deposito());
        $sqlQuery->set($ConfirmacionTO->getId_inscripcion());
        $resp=QueryExecutor::executeInsert($sqlQuery);
        
            }
        return $resp;
        } catch (Exception $e) {
        return $resp=$e->getMessage();        
        //throw new Exception("Error :".$e->getMessage());
        }
    }
    
    public function vereficConfirm($idInscripcion){
        $sql = "SELECT	* FROM confirmacion WHERE id_inscripcion=? AND estado='confirmado'";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($idInscripcion);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function selectNumDep($numdep){
        $sql = "SELECT * FROM depositos  WHERE deposito=? ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($numdep);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    public function validarConfirmacion(){
        $sql = "SELECT d.id_confirmacion, d.id_inscripcion, d.num_deposito, d.estado, d.desicion, (SELECT CONCAT(i.nombres,' ', i.apell_paterno,' ', i.apell_materno) AS nombre 
                FROM inscripcion i WHERE i.id_inscripcion=d.id_inscripcion) AS nombre 
                FROM (SELECT id_confirmacion, id_inscripcion, num_deposito, estado, CONCAT('Si') AS desicion  FROM confirmacion WHERE estado!='confirmado') AS d";
//        $sql = "SELECT d.id_confirmacion, d.id_inscripcion, d.num_deposito, d.estado, d.desicion, (SELECT CONCAT(i.nombres,' ', i.apell_paterno,' ', i.apell_materno) AS nombre FROM inscripcion i WHERE i.id_inscripcion=d.id_inscripcion) AS nombre 
//                FROM (SELECT id_confirmacion, id_inscripcion, num_deposito, estado, CONCAT('Si') AS desicion  FROM confirmacion WHERE estado='proceso' AND num_deposito IN (SELECT  deposito FROM depositos WHERE id_inscripcion IS NULL OR id_inscripcion='0') UNION ALL (SELECT id_confirmacion, id_inscripcion, num_deposito, estado, CONCAT('No') AS desicion FROM confirmacion WHERE estado='proceso' AND num_deposito NOT IN (SELECT  deposito FROM depositos WHERE id_inscripcion IS NULL OR id_inscripcion='0'))) AS d";
        try {
            $sqlQuery=new SqlQuery($sql);
            return QueryExecutor::execute($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function registNd($numdep){
        $sql = " INSERT INTO depositos(deposito) VALUES(?) ";
        try {
            $sqlQuery=new SqlQuery($sql);
            $sqlQuery->set($numdep);
            return QueryExecutor::executeInsert($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function estadoNumdep($ConfirmacionTO, $condifion){
        $sql = " UPDATE confirmacion SET estado='confirmado', id_trabajdor='".$ConfirmacionTO->getId_trabajdor()."' WHERE id_inscripcion='".$ConfirmacionTO->getId_inscripcion()."' AND id_confirmacion='".$ConfirmacionTO->getId_confirmacion()."' ";
        if($condifion=="No"){
        $sql = " UPDATE confirmacion SET observacion='El numero de deposito no es correcto... por favor confirme nuevamente.', id_trabajdor='".$ConfirmacionTO->getId_trabajdor()."' WHERE id_inscripcion='".$ConfirmacionTO->getId_inscripcion()."' AND id_confirmacion='".$ConfirmacionTO->getId_confirmacion()."' ";
        }        
        try {
            $sqlQuery=new SqlQuery($sql);            
            return QueryExecutor::executeUpdate($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    public function updateNumDep($idInscripcion, $deposito){
        $sql = " UPDATE depositos SET id_inscripcion='".$idInscripcion."' WHERE deposito='".$deposito."' ";
        try {
            $sqlQuery=new SqlQuery($sql);            
            return QueryExecutor::executeUpdate($sqlQuery);
            }catch (Exception $e) {
            throw new Exception("Error :".$e->getMessage());
        }
    }    
    
    
    
}

?>
