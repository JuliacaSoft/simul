<?php
session_start();
require_once('utils.php');
function s_pagina_validar(){
	if($_SESSION["autintificafsx"] != "dmplogiofsx"){                
            f_redireccionar("../../index.php");
        exit();
}
}
function s_trabajador_id(){
	$worker_id="X";
	if(isset($_SESSION["workerfsx"])){
		$worker_id=$_SESSION["workerfsx"];
	}
	return $worker_id;
}
?>
