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

    // Mostrar mensaje de éxito y redirigir al listado de libros
  echo "<script>
  alert('El libro ha sido agregado correctamente.');
  window.location.href = 'listar.php';
</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Agregar Libro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../styles.css">
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
    }
    .formulario-estrecho {
      max-width: 500px;
      margin: 0 auto;
    }
    .fondo-limitado {
      max-width: 550px;
      margin: 0 auto;
    }
  </style>
</head>
<body class="listado-body">
<div class="container mt-5">
    <div class="bg-opacity fondo-limitado">
      <div class="listado-main-container formulario-estrecho">
        <h1 class="text-center mb-4">Agregar Libro</h1>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" placeholder="Título" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" placeholder="Autor" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Editorial</label>
            <input type="text" name="editorial" placeholder="Editorial" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" placeholder="ISBN" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Ejemplares:</label>
            <select name="cantidad_ejemplares" class="form-select">
              <?php
                for ($i = 0; $i <= 10; $i++) {
                  echo "<option value=\"$i\">$i</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
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
          </div>
          <button type="submit" name="agregar" class="btn btn-primary" style="background-color: #8c9390; border-color: #8c9390;">Agregar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

