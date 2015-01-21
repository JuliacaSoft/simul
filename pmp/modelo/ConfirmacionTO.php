<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfirmacionTO
 *
 * @author Administrador
 */
class ConfirmacionTO {
   public $id_confirmacion;
   public $estado;
   public $num_deposito;
   public $observacion;
   public $estado_certificado;
   public $id_inscripcion;
   public $id_trabajdor;
   
   public function getId_confirmacion() {
       return $this->id_confirmacion;
   }

   public function setId_confirmacion($id_confirmacion) {
       $this->id_confirmacion = $id_confirmacion;
   }

   public function getEstado() {
       return $this->estado;
   }

   public function setEstado($estado) {
       $this->estado = $estado;
   }

   public function getNum_deposito() {
       return $this->num_deposito;
   }

   public function setNum_deposito($num_deposito) {
       $this->num_deposito = $num_deposito;
   }

   public function getObservacion() {
       return $this->observacion;
   }

   public function setObservacion($observacion) {
       $this->observacion = $observacion;
   }

   public function getEstado_certificado() {
       return $this->estado_certificado;
   }

   public function setEstado_certificado($estado_certificado) {
       $this->estado_certificado = $estado_certificado;
   }

   public function getId_inscripcion() {
       return $this->id_inscripcion;
   }

   public function setId_inscripcion($id_inscripcion) {
       $this->id_inscripcion = $id_inscripcion;
   }

   public function getId_trabajdor() {
       return $this->id_trabajdor;
   }

   public function setId_trabajdor($id_trabajdor) {
       $this->id_trabajdor = $id_trabajdor;
   }


   
}

?>
