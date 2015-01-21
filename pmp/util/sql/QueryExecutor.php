<?php
require_once "Connection.php";
require_once "Transaction.php";
class QueryExecutor{
	public static function execute($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$query = $sqlQuery->getQuery();
		$result = $connection->executeQuery($query);
		if(!$result){
			throw new Exception(mysql_error());
		}
		$i=0;
		$tab = array();
		while ($row = mysql_fetch_array($result)){
			$tab[$i++] = $row;
		}
		mysql_free_result($result);
		if(!$transaction){
			$connection->close();
		}
		return $tab;
	}
	public static function executeUpdate($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$query = $sqlQuery->getQuery();
		$result = $connection->executeQuery($query);
		if(!$result){
			throw new Exception(mysql_error());
		}
		return mysql_affected_rows();
	}
	public static function executeDelete($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$query = $sqlQuery->getQuery();
		$connection->executeQuery($query);
		
	}

	public static function executeInsert($sqlQuery){
		QueryExecutor::executeUpdate($sqlQuery);
		return mysql_insert_id();
	}
	public static function queryForString($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$result = $connection->executeQuery($sqlQuery->getQuery());
		if(!$result){
			throw new Exception(mysql_error());
		}
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}
?>