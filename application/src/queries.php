<?php 
	include "database.php";

    function Login($EMAIL, $DNI) {
        $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM usuario WHERE EMAIL = '$EMAIL' AND dni = '$DNI'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            mysqli_close($conn);
            return "usuario";
        } else {
            mysqli_close($conn);
            return "no-usuario";
        }
    }
?>
