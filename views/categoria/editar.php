<?php
include('../../includes/header.php');

// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// comprobar si se ha enviado un formulario para actualizar o eliminar la categoría
if (isset($_POST['actualizar']) || isset($_POST['eliminar'])) {
  // obtener el id y el nuevo nombre de la categoría
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];

  // determinar si se está eliminando la categoría
  $eliminar = isset($_POST['eliminar']) && $_POST['eliminar'] === 'true';

  // actualizar o eliminar la categoría en la base de datos
  if ($eliminar) {
    $query = "DELETE FROM categorias WHERE id = $id";
    $mensaje = "La categoría ha sido eliminada correctamente.";
  } else {
    $query = "UPDATE categorias SET nombre = '$nombre' WHERE id = $id";
    $mensaje = "La categoría ha sido actualizada correctamente.";
  }

  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito y redirigir al listado de categorías
  echo "<script>alert('$mensaje'); location.href='listar.php';</script>";
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
  <!-- Biblioteca de estilos de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Tu archivo de estilos CSS -->
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <div class="background-wrapper">
    <div class="container editar-main-container">
      <h2 class="titulo-centrado">Editar Categorías</h2>
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
              <td class="id-column"><?= $categoria['id'] ?></td>
              <td><input type="text" name="nombre" value="<?= $categoria['nombre'] ?>"></td>
              <td>
                <button type="submit" name="actualizar">Guardar</button>
              </td>
            </form>
            <td>
              <form method="POST" action="editar.php">
                <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                <input type="hidden" name="eliminar" value="true">
                <button type="submit" onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?')">Eliminar</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    <?php if (isset($_POST['actualizar'])): ?>
      alert('La categoría ha sido actualizada correctamente.');
      location.href = 'listar.php'; // redirigir al listado
    <?php endif; ?>
    <?php if (isset($_POST['eliminar'])): ?>
      <?php 
        $id = $_POST['id'];
        $query = "DELETE FROM categorias WHERE id = $id";
        $resultado = $conexion->query($query);
      ?>
      alert('La categoría ha sido eliminada correctamente.');
      location.href = 'listar.php'; // redirigir al listado
    <?php endif; ?>
  </script>
</body>
</html>