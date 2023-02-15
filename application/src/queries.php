<?php 
	include "database.php";//

    function Login($EMAIL, $PASSWORD) {
        $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM usuarios WHERE EMAIL = '$EMAIL' AND PASSWORD = '$PASSWORD'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            mysqli_close($conn);
            return "usuarios";
        } else {
            mysqli_close($conn);
            return "usuario no reconocido";
        }
    }
?>
