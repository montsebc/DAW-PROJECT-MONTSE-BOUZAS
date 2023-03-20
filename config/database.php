<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking a book";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>

