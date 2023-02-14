<?php 
$host = "localhost";
$usuario = "root";
$contraseña = "";
$baseDatos = "proyecto_fin_grado";
// Create connection
$conn = mysqli_connect($host, $usuario, $contraseña, $baseDatos);
// Check connection
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
echo "Conexión realizada con éxito "."<br>";
mysqli_close($conn);
?>
		