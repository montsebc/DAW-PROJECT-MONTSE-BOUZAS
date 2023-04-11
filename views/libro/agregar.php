<?php
include('../../includes/header.php'); 

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
  $isbn = $_POST['isbn'];
  $cantidad_ejemplares = $_POST['cantidad_ejemplares'];
  $id_categoria = $_POST['categoria_id'];

  // Validar la cantidad de ejemplares
  if (!filter_var($cantidad_ejemplares, FILTER_VALIDATE_INT) || $cantidad_ejemplares < 0 || $cantidad_ejemplares > 10) {
    echo "La cantidad de ejemplares debe ser un número entre 0 y 10";
  } else {
    // Insertar los datos del libro en la base de datos
    $query = "INSERT INTO libros (titulo, autor, editorial,isbn, cantidad_ejemplares, id_categoria) VALUES ('$titulo', '$autor', '$editorial','$isbn', '$cantidad_ejemplares', '$id_categoria')";
    $resultado = $conexion->query($query);

    // Mostrar mensaje de éxito
    echo "<script>alert('El libro ha sido agregado correctamente.');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Agregar Libro</title>
 <!-- Biblioteca de estilos de Bootstrap -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Tu archivo de estilos CSS -->
<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
  <div class="addLibro-background-wrapper">
    <div class="container addLibro-main-container">
      <h2 class="titulo-centrado">Agregar Libro</h2>
      <div class="addLibro-form-container">
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
          <label>ISBN:</label>
          <input type="text" name="isbn">
          <br><br>
          <label>Cantidad de Ejemplares:</label>
          <input type="number" name="cantidad_ejemplares">
          <br><br>
          <label>Categoría:</label>
          <select name="categoria_id">
            <?php
            // Consulta SQL para obtener las categorías disponibles
            $query = "SELECT * FROM categorias";
            $resultado = $conexion->query($query);

            // Verificar si se obtuvieron resultados
            if ($resultado->num_rows > 0) {
              // Recorrer los resultados y crear una opción para cada categoría
              while ($categoria = $resultado->fetch_assoc()) {
                echo '<option value="' . $categoria['id'] . '">' . $categoria['nombre'] . '</option>';
              }
            }
            ?>
          </select>
          <br><br>
          <button type="submit" name="agregar">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
