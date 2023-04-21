<?php
include('../../includes/header.php'); 

// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Consulta SQL para obtener todos los socios
$query = "SELECT * FROM socios";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Socios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("../../assets/images/estante-librosBonita.png");
            background-size: cover;
            background-position: center;
        }

        .bg-opacity {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
        }
        .table-container {
            overflow-y: scroll;
            height: 400px; /* ajusta esta altura según sea necesario */
        }
        thead th {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="container main-container mt-5">
        <div class="bg-opacity">
            <h2 class="text-center mb-4">Listado de Socios</h2>
            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($socio = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $socio['nombre'] ?></td>
                            <td><?= $socio['apellidos'] ?></td>
                            <td><?= $socio['email'] ?></td>
                            <td><?= $socio['telefono'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


