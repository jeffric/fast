<?php
/*********************************************************************************************
										>>VERSION PARA MySQL SERVER<<
 *********************************************************************************************/
//
										class DataBase{

											var $serverName;
											var $port;	
	var $username; // username 
	var $password; // password 
	var $db_name; // Database name 
	var $connectionInfo;
	var $link;

	// constructor
	function DataBase($serverName, $port, $db_name, $username, $password){
		$this->serverName = $serverName . "," . $port;
		$this->port = $port;
		$this->db_name = $db_name;
		$this->username = $username;
		$this->password = $password;
		$this->connectionInfo = array("UID"=>$this->username, "PWD"=>$this->password, "Database"=>$this->db_name);		
		$conexion = mysqli_connect($serverName, $username, $password);
		$link = $conexion;

		
		if (!$conexion) { 
			die('<strong>Ha ocurrido un error al conectar al servidor de base de datos en: ' . $this->serverName . '.</strong> ' . mysqli_error()); 
		}

		mysqli_select_db($conexion, $db_name) or die(mysqli_error($conexion));  
		$this->link = $conexion;
	}

	//Funcion para ejecutar cualquier query
		function ExecutePersonalizado($sql){		
			//se ejecuta la consulta
			try {				
				$result = mysqli_query($this->link,$sql) or die(mysql_error());

				return $result;				
			}catch(Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}	
		}

		//--> SELECT (Consultar)
		function Consultar($strTablas, $strCampos, $strRestricciones = "", $strAgrupacion = "", $strOrdenamiento = ""){
			$strSql = "";
			$result;
				//Se arma la consultar
			$strSql = " SELECT " . $strCampos . " FROM " . $strTablas . " ";

			($strRestricciones != "") ? $strSql = $strSql. " WHERE " . $strRestricciones . " " : $strSql = $strSql;
			($strAgrupacion != "") ? $strSql = $strSql. " GROUP BY " . $strAgrupacion . " " : $strSql = $strSql;
			($strOrdenamiento != "") ? $strSql = $strSql. " ORDER BY " . $strOrdenamiento . " " : $strSql = $strSql;

			//se ejecuta la consulta
			try {				
				$result = mysqli_query($this->link,$strSql) or die(mysql_error());

				return $result;				
			}catch(Exception $e) {
				echo 'Error: ' .$e->getMessage();
			}			
		}

		//--> INSERT (Insertar)
		function Insertar($strTabla, $strCampos, $strValores){
			$strSql = "";			
			$strSql = " INSERT INTO " . $strTabla . "(" . $strCampos . ") VALUES(" . $strValores . ")";
			//se ejecuta la consulta
			try {
				$result = mysqli_query($this->link,$strSql);
				if($result){
					return 1;
				}else{
					return -1;
				}				
			}catch(Exception $e) {
				return $e;
			}
		}

		function InsertarIdentity($strTabla, $strCampos, $strValores){			
			$strSql = "";			
			$strSql = " INSERT INTO " . $strTabla . "(" . $strCampos . ") VALUES(" . $strValores . ");";
			//se ejecuta la consulta
			try {
				$result = mysqli_query($this->link,$strSql) or die(mysql_error());
				$id = mysqli_insert_id($this->link);
				return $id;
			}catch(Exception $e) {
				return $e;
			}
		}

		//--> DELETE (Eliminar)
		function Eliminar($strTabla, $strRestricciones){
			$strSql = "";
			$strSql = " DELETE FROM " . $strTabla . " ";
			if($strRestricciones != ""){
				$strSql = $strSql . " WHERE " . $strRestricciones . " ";
			}
			try {
				$result = mysqli_query($this->link,$strSql);
				if($result){
					return 1;
				}else{
					return -1;
				}				
			}catch(Exception $e) {
				return -1;
			}
		}

		//--> UPDATE (Modificar)
		function Modificar($strTabla, $strValores ,$strRestricciones){
			$strSql = "";
			$strSql = " UPDATE " . $strTabla . " SET " . $strValores . " ";
			if ($strRestricciones != "") {
				$strSql = $strSql. " WHERE " . $strRestricciones . " ";
		
			}
			try {
				$result = mysqli_query($this->link,$strSql);
				if($result){
					return 1;
				
				}else{
					return -1;
				}
			}catch(Exception $e) {
				return -1;
			}
		}

}
?>