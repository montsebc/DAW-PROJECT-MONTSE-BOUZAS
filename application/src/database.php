<?php 
	function connect() {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$database = "proyecto_fin_grado";

		$conection = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8", $user, $pass);
		$conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if (!$conection)
			die("<h3>Error: " . $conection->errorCode() . "</h3>");

		return $conection;
	}

	function close($conection) {
		$conexion = null;
	}
?>