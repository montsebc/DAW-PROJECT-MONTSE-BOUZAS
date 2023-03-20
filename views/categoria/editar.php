<?php
include('../includes/header.php'); 

// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// comprobar si se ha enviado un formulario para actualizar la categoría
if (isset($_POST['actualizar'])) {
  // obtener el id y el nuevo nombre de la categoría
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];

  // actualizar la categoría en la base de datos
  $query = "UPDATE categorias SET nombre = '$nombre' WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('La categoría ha sido actualizada correctamente.');</script>";

  // redirigir al archivo listar.php para mostrar el nuevo listado de categorías
  echo "<script>location.href='listar.php';</script>";
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
  <title>Editar Categorías</title>
</head>
<body>
<div class="container main-container">

  <h2>Editar Categorías</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categorias as $categoria): ?>
        <tr>
          <form method="POST" action="editar.php">
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <td><?= $categoria['id'] ?></td>
            <td><input type="text" name="nombre" value="<?= $categoria['nombre'] ?>"></td>
            <td>
              <button type="submit" name="actualizar">Guardar</button>
            </td>
          </form>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  
  <script>
    <?php if (isset($_POST['actualizar'])): ?>
      alert('La categoría ha sido actualizada correctamente.');
    <?php endif; ?>
  </script>
  </div>
</body>
</html>
