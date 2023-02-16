<?php 
	include "database.php";

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
    
    // Función para obtener todas las categorías desde la base de datos
    function getCategorias() {
        $host = "localhost";
        $usuario = "nombre_usuario";
        $contraseña = "contraseña";
        $baseDatos = "proyecto_fin_grado";

        // Conexión a la base de datos
        $conn = new mysqli($host, $usuario, $contraseña, $baseDatos);
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener todas las categorías
        $sql = "SELECT * FROM categoria";
        $result = $conn->query($sql);

        // Obtener los resultados como un array asociativo
        $categorias = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categorias[] = $row;
            }
        }

        // Cerrar la conexión y devolver los resultados
        $conn->close();
        return $categorias;
    }
?>


?>
