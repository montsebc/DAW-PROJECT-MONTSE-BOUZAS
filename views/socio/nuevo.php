<?php include('../../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo socio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("../../assets/images/estante-librosBonita.png");
            background-size: cover;
            background-position: center;
        }
        .main-container {
            margin-top: 50px;
            border-radius: 10px;
        }
        .formulario-socio {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container main-container">
    <h2>Nuevo socio</h2>
    <form action="" method="POST" class="formulario-socio">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required class="form-control">
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required class="form-control">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required class="form-control">
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required class="form-control">
        <br>
        <input type="submit" name="guardar" value="Añadir" class="btn btn-primary">
    </form>

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
    echo "<script>alert('Socio agregado correctamente');
          window.location.href='listar.php';
          </script>";
    exit; // Asegurarse de que el script se detiene después de la redirección
} else {
    echo "<script>alert('Error al agregar el socio: ".$conexion->error."');</script>";
}

 
  }
    
