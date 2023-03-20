<?php
include('../includes/header.php'); 

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
  <title>Listado de Socios</title>
</head>
<body>
<div class="container main-container">

  <h2>Listado de Socios</h2>
  <table border="1">
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
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
      </div>
</body>
</html>

