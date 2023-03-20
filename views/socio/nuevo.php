<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo socio</title>
</head>
<body>
<div class="container main-container">
    <h2>Nuevo socio</h2>
    <form action="" method="POST" class="formulario-socio">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required>
        <br>
        <input type="submit" name="guardar" value="Agregar">

    </form>
    <button onclick="location.href='index.php'">Cancelar</button>
    <?php
    
    // Verificar si se recibieron datos del formulario
    if (isset($_POST['guardar'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        
        // Conectarse a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($conexion->connect_error) {
          die('Error de conexión: ' . $conexion->connect_error);
        }

        // Preparar la consulta SQL para insertar el nuevo socio
        $query = "INSERT INTO socios (nombre, apellidos, email, telefono) VALUES ('$nombre', '$apellidos', '$email', '$telefono')";

        // Ejecutar la consulta SQL y mostrar la alerta
        if ($conexion->query($query) === TRUE) {
            echo "<script>alert('Socio agregado correctamente');</script>";
        } else {
            echo "<script>alert('Error al agregar el socio: ".$conexion->error."');</script>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
    }
    ?>

    <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
    </div>

</body>
</html>
