<?php
include('../includes/header.php'); 

// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// consulta SQL para obtener todas las categorías
$query = "SELECT * FROM categorias";
$resultado = $conexion->query($query);

// verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
  // inicializar un array vacío para almacenar las categorías
  $categorias = [];

  // iterar a través de los resultados y agregar cada categoría al array
  while ($fila = $resultado->fetch_assoc()) {
    $categorias[] = $fila;
  }
} else {
  // no se encontraron resultados, asignar un array vacío
  $categorias = [];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Listado de Categorías</title>
  </head>
<body class="listado-body">
  <div class="listado-bg-wrapper">
    <div class="listado-main-container">
      <h1>Listado de Categorías</h1>
      <table class="listado-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categorias as $categoria): ?>
            <tr>
              <td><?= $categoria['id'] ?></td>
              <td><?= $categoria['nombre'] ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    <?php if (isset($_GET['actualizado'])): ?>
      alert('La categoría ha sido actualizada correctamente.');
    <?php endif; ?>
  </script>
</body>
</html>
