<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Verificar si se ha enviado un formulario para agregar un libro
if (isset($_POST['agregar'])) {
  // Obtener los datos del libro desde el formulario
  $titulo = $_POST['titulo'];
  $autor = $_POST['autor'];
  $editorial = $_POST['editorial'];
  $cantidad_ejemplares = $_POST['cantidad_ejemplares'];
  $id_categoria = $_POST['id_categoria'];

  // Validar la cantidad de ejemplares
  if (!filter_var($cantidad_ejemplares, FILTER_VALIDATE_INT) || $cantidad_ejemplares < 0 || $cantidad_ejemplares > 10) {
    echo "<script>alert('La cantidad de ejemplares debe ser un número entre 0 y 10');</script>";
  } else {
    // Insertar los datos del libro en la base de datos
    $query = "INSERT INTO libros (titulo, autor, editorial, cantidad_ejemplares, id_categoria) VALUES ('$titulo', '$autor', '$editorial', '$cantidad_ejemplares', '$id_categoria')";
    $resultado = $conexion->query($query);

  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Agregar Libro</title>
</head>
<body>
<h2>Agregar Libro</h2>
  <form method="POST">
    <label>Título:</label>
    <input type="text" name="titulo">
    <br><br>
    <label>Autor:</label>
    <input type="text" name="autor">
    <br><br>
    <label>Editorial:</label>
    <input type="text" name="editorial">
    <br><br>
    <label>Cantidad de Ejemplares:</label>
    <input type="number" name="cantidad_ejemplares">
    <br><br>
    <label>Categoría:</label>
    <select name="id_categoria">
      <?php
      // Consulta SQL para obtener las categorías disponibles
      $query = "SELECT * FROM categorias";
      $resultado = $conexion->query($query);

      // Verificar si se obtuvieron resultados
      if ($resultado->num_rows > 0) {
        // Recorrer los resultados y crear una opción para cada categoría
        while ($categoria = $resultado->fetch_assoc()) {
          echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
        }
      }
      ?>
    </select>
    <br><br>
    <button type="submit" name="agregar">Agregar</button>
  </form>
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
  <button onclick="location.href='listar.php'">Volver a la lista de libros</button>


  </script>
</body>
</html>
