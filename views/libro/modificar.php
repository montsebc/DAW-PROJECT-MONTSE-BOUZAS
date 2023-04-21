<?php
include('../../includes/header.php'); 

// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// comprobar si se ha enviado un formulario para actualizar o eliminar el libro
if (isset($_POST['actualizar'])) {
  // obtener el id y los nuevos datos del libro
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $categoria = $_POST['categoria'];
  $editorial = $_POST['editorial'];
  $isbn = $_POST['isbn'];

  // actualizar el libro en la base de datos
  $query = "UPDATE libros SET titulo = '$titulo', autor = '$autor', id_categoria = $categoria, editorial = '$editorial', isbn = $isbn WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('El libro ha sido actualizado correctamente.');</script>";
} elseif (isset($_POST['eliminar'])) {
  // obtener el id del libro a eliminar
  $id = $_POST['id'];

  // verificar si hay préstamos registrados para el libro
  $query = "SELECT COUNT(*) as num_prestamos FROM prestamos WHERE id_libro = $id";
  $resultado = $conexion->query($query);

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $num_prestamos = $fila['num_prestamos'];

    if ($num_prestamos > 0) {
      // si hay préstamos registrados para el libro, mostrar mensaje de error
      echo "<script>alert('No se puede eliminar este libro para mantener el historial de préstamos.');</script>";
    } else {
      // si no hay préstamos registrados para el libro, eliminar el libro de la base de datos
      $query = "DELETE FROM libros WHERE id = $id";
      $resultado = $conexion->query($query);
      

      // mostrar mensaje de éxito
      echo "<script>alert('El libro ha sido eliminado correctamente.');</script>";
    }
  }
}
// consulta SQL para obtener todos los libros
$query = "SELECT * FROM libros";
$resultado = $conexion->query($query);

// verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
  // inicializar un array vacío para almacenar los libros
  $libros = [];

  // iterar a través de los resultados y agregar cada libro al array
  while ($fila = $resultado->fetch_assoc()) {
    $libros[] = $fila;
  }
} else {
  // no se encontraron resultados, asignar un array vacío
  $libros = [];
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
  <title>Editar Libros</title>
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
      max-width: 100%;
      margin: auto;
    }

    .table-container {
      overflow-y: scroll;
      height: 600px; /* ajusta esta altura según sea necesario */
    }
    thead th {
      position: sticky;
      top: 0;
      background-color: #fff;
      z-index: 1;
    }

    /* Nuevo estilo */
    .button-container {
      display: flex;
      justify-content: space-between;
    }

    /* Estilo modificado */
    .form-control {
      height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-size: .875rem;
      line-height: 1.5;
    }

  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8 p-5 bg-opacity">
        <h2>Editar Libros</h2>
        <div class="table-container">
          <table class="table table-striped">
          <thead class="sticky-header">
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Categoría</th>
              <th>Editorial</th>
              <th>ISBN</th>
              <th>Acciones</th>
            </tr>
          </thead>

            <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                  <form method="POST" action="modificar.php">
                    <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                    <td><?= $libro['id'] ?></td>
                    <td><input type="text" name="titulo" class="form-control" value="<?= $libro['titulo'] ?>"></td>
                    <td><input type="text" name="autor" class="form-control" value="<?= $libro['autor'] ?>"></td>
                    <td>
                      <select name="categoria" class="form-control">
                        <?php foreach ($categorias as $categoria): ?>
                          <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $libro['id_categoria'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </td>
                    <td><input type="text" name="editorial" class="form-control" value="<?= $libro['editorial'] ?>"></td>
                    <td><input type="text" name="isbn" class="form-control" value="<?= $libro['isbn'] ?>"></td>
                    <td>
                      <div class="button-container"> <!-- Agregar esta línea -->
                      <button type="submit" name="actualizar" class="btn btn-primary" style="background-color: #8c9390; border-color: #8c9390;">Guardar</button>
                      <button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar este libro?')" style="background-color: #e0cc8d; border-color: #e0cc8d;">Eliminar</button>
                      </div> <!-- Agregar esta línea -->
                    </td>
                  </form>
                </tr>
              <?php endforeach?>
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

