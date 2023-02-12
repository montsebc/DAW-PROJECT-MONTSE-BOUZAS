<?php 
	include "database.php";

    function login($email, $dni) {
		try {
			$connection = connect();
			$query = $connection->prepare(
				"SELECT * FROM usuari WHERE EMAIL = '".$email."' AND DNI = '".$dni."'"
			);

			$query->execute();
			$numeroUsuarios = $query->rowCount();
			$datos = $query->fetch();

			if($numeroUsuarios > 0)
                return true;
		} catch (Exception $e) {
			exit("Error: " . $e->GetMessage());
		} finally {
			close($connection);
		}
	}
?>