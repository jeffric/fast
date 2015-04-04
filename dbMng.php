<?php
include_once('dbClss.php');

class DataBaseManager
{
	public $db;
	
	public function __construct($serverName, $port, $db_name, $username, $password){
		$this->db = new DataBase($serverName, $port, $db_name, $username, $password);
		$this->db->link->set_charset('utf8');


	}	
}
?>
