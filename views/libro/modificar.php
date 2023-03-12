<?php
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

  // actualizar el libro en la base de datos
  $query = "UPDATE libros SET titulo = '$titulo', autor = '$autor', id_categoria = $categoria, editorial = '$editorial' WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('El libro ha sido actualizado correctamente.');</script>";
} elseif (isset($_POST['eliminar'])) {
  // obtener el id del libro a eliminar
  $id = $_POST['id'];

  // eliminar el libro de la base de datos
  $query = "DELETE FROM libros WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('El libro ha sido eliminado correctamente.');</script>";
}

// consulta SQL para obtener todos los libros
$query = "SELECT libros.id, libros.titulo, libros.autor, libros.editorial, categorias.nombre as categoria, categorias.id as categoria_id FROM libros JOIN categorias ON libros.id_categoria = categorias.id";
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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Libros</title>
</head>
<body>
  <h2>Editar Libros</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Editorial</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($libros as $libro): ?>
        <tr>
          <form method="POST" action="modificar.php">
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">
            <td><?= $libro['id'] ?></td>
            <td><input type="text" name="titulo" value="<?= $libro['titulo'] ?>"></td>
            <td><input type="text" name="autor" value="<?= $libro['autor'] ?>"></td>
            <td>
              <select name="categoria">
                <?php
                  // consulta SQL para obtener todas las categorías
                  $query = "SELECT * FROM categorias";
                  $resultado = $conexion->query($query);

                  // verificar si se obtuvieron resultados
                  if ($resultado->num_rows > 0) {
                    // inicializar un array vacío para almacenar las categorías
                    $categorias = [];

                    // iterar a través de los resultados y agregar cada categoría al array
                    while ($categoria = $resultado->fetch_assoc()) {
                      $categorias[] = $categoria;
                    }
                  } else {
                    // no se encontraron resultados, asignar un array vacío
                    $categorias = [];
                  }
                ?>
                <?php foreach ($categorias as $categoria): ?>
                  <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $libro['categoria_id'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                <?php endforeach ?>
              </select>
            </td>
            <td><input type="text" name="editorial" value="<?= $libro['editorial'] ?>"></td>
            <td>
              <button type="submit" name="actualizar">Guardar</button>
              <button type="submit" name="eliminar" onclick="return confirm('¿Está seguro que desea eliminar este libro?')">Eliminar</button>
            </td>
          </form>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>

