<?php
include('../../includes/header.php');

require_once('../../models/Categoria.php');

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
$eliminar = isset($_POST['eliminar']);

  // si se está actualizando la categoría, obtener el nuevo nombre
  $nombre = null;
  if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
  }

  $categoria = new Categoria($conexion);
  $categoria->setId($id);

  if ($eliminar) {
    if ($categoria->tieneHistorialAsociado()) {
        $mensaje = "La categoría no se puede eliminar para mantener un correcto historial de préstamos, si lo desea, puede modificarla.";
        echo "<script>alert('$mensaje');</script>";
    } else {
        $query = "DELETE FROM categorias WHERE id = $id";
        $resultado = $conexion->query($query);

        if ($resultado) {
            $mensaje = "La categoría ha sido eliminada correctamente.";
            echo "<script>alert('$mensaje'); location.href='listar.php';</script>";
        } else {
            // Agregar mensaje de error personalizado para la consulta de eliminación
            $mensaje = "Error al eliminar la categoría: " . $conexion->error;
            echo "<script>alert('$mensaje');</script>";
        }
    }
  } else {
    $query = "UPDATE categorias SET nombre = '$nombre' WHERE id = $id";
    $mensaje = "La categoría ha sido actualizada correctamente.";
    $resultado = $conexion->query($query);
    echo "<script>alert('$mensaje'); location.href='listar.php';</script>";
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/styles.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5z91fgXvkR8M7r3z8GOwkpE2q3qjF3gmfsEY31pJ" crossorigin="anonymous">


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
      max-width: 100%;
      margin: auto;
    }

    .table-container {
      overflow-y: scroll;
      height: 600px;
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
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 p-5 bg-opacity">
        <h2>Editar Categorías</h2>
        <div class="table-container">
          <table class="table table-striped">
          <thead class="sticky-header">
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
        <td><input type="text" name="nombre" class="form-control" value="<?= $categoria['nombre'] ?>"></td>
        <td>
          <button type="submit" name="actualizar" class="btn btn-success">Guardar</button>
          <button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar esta categoría?')">Eliminar</button>
        </td>
      </form>
    </tr>
  <?php endforeach ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>







