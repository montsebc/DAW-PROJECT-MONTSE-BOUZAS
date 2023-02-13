<?php 
	include "database.php";

    function Login($email, $dni) {
        $conn = mysqli_connect();
        $query = $conn->prepare("SELECT * FROM usuario WHERE EMAIL = ? AND DNI = ?");
        $query->bind_param("ss", $email, $dni);
        $query->execute();
        $query->store_result();
        $numeroUsuarios = $query->num_rows;
        $datos = $query->fetch();
        

        if ($numeroUsuarios == 1) { 
            return "usuario";
        } else {
            return "usuario no registrado";
        }
    }     
?>