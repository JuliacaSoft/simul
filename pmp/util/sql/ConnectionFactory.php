<?php
require_once "MD5Crypt.php";
require_once "ConnectionProperty.php";
class ConnectionFactory{
	static public function getConnection(){
        $conn = mysql_connect(MD5Crypt::getDecrypt(ConnectionProperty::getHost()),MD5Crypt::getDecrypt(ConnectionProperty::getUser()) ,MD5Crypt::getDecrypt(ConnectionProperty::getPassword()));
        mysql_select_db(MD5Crypt::getDecrypt(ConnectionProperty::getDatabase()));
		if(!$conn){
			throw new Exception('No se puede conecctar con DB');
		}
		return $conn;
	}
	static public function close($connection){
		mysql_close($connection);
	}
}
?>
