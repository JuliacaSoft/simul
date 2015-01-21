<?php
require_once "ConnectionFactory.php";
class Connection{
	private $connection;

	public function Connection(){
		$this->connection = ConnectionFactory::getConnection();
	}

	public function close(){
		ConnectionFactory::close($this->connection);
	}
	public function executeQuery($sql){
		return mysql_query($sql, $this->connection);
	}
    public function getConn() {
        return ConnectionFactory::getConnection();
    }
}
?>