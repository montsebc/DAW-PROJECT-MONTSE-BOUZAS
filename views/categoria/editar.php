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
  // obtener el id de la categoría
  $id = $_POST['id'];

  // determinar si se está eliminando la categoría
  $eliminar = isset($_POST['eliminar']) && $_POST['eliminar'] === 'true';

  // si se está actualizando la categoría, obtener el nuevo nombre
  $nombre = null;
  if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
  }

  try {
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
  } catch (mysqli_sql_exception $ex) {
    // capturar la excepción y mostrar mensaje correspondiente
    if (mysqli_errno($conexion) === 1451) {
      $mensaje = "La categoría no se puede eliminar para mantener un correcto historial de préstamos, si lo desea, puede modificarla.";
    } else {
      $mensaje = "Ha ocurrido un error al actualizar/eliminar la categoría.";
    }
    echo "<script>alert('$mensaje');</script>";
  }
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Y6XfQSTaUltcXlUhclhP" crossorigin="anonymous">

  <!-- Tu archivo de estilos CSS -->
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<div class="editar background-wrapper">
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
            <button type="submit" name="eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?')">Eliminar</button>
          </td>
        </form>
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
  </script>
</body>
</html>





