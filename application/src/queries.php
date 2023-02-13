<?php 
	include "database.php";

    function Login($email, $dni) {
		
			$connection = connect();
			$query = $connection->prepare(
				"SELECT * FROM usuario WHERE EMAIL = '".$email."' AND DNI = '".$dni."'"
			);
			$query->execute();
			$numeroUsuarios = $query->rowCount();
			$datos = $query->fetch();

			if ($numeroUsuarios == 1) {
					return "usuario";	
            }
            else
				return "usuario no registrado";
		
	}
?>