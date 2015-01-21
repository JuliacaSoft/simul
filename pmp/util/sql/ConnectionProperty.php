<?php
class ConnectionProperty{
	/*private static $host = 'BzwAbQFsAGYBOVRpB2lQIlAj';
	private static $user = 'AzUEYgNgUz1Ubgc7WykAdQN2VDAHOQU+AXM=';
	private static $password = 'U2VVMwVmADVQLgBkW3ACcFYoA3U=';
	private static $database = 'UGMAY1UvAGYFDlVwUyAPewVnAWZTaA==';*/
	private static $host = 'Wz5Tbg09WjwDaVVuWjpWclIm';
	private static $user = 'CXBRegIlBmkGbwY7'; //agile_cointem
	private static $password = 'WmJUNARkUWJRYlI3'; //c01ntem
	private static $database = 'DnQFPgc5UCICaFtpWzBQaFQm';//agile_cointem //
	//private static $database = 'C2FbZg03UTgMflBmDmw=';//agile_cointem //DidVdAQ+AGoFdgY5DmACMQdoDH0=
	public static function getHost(){
		return ConnectionProperty::$host;
	}
	public static function getUser(){
		return ConnectionProperty::$user;
	}
	public static function getPassword(){
		return ConnectionProperty::$password;
	}
	public static function getDatabase(){
		return ConnectionProperty::$database;
	}
}
?>