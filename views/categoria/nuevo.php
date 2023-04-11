<?php
include('../../includes/header.php'); 

// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Verificar si se ha enviado un formulario para agregar una categoría
if (isset($_POST['agregar'])) {
  // Obtener el nombre de la categoría desde el formulario
  $nombre = $_POST['nombre'];

  // Insertar la categoría en la base de datos
  $query = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
  $resultado = $conexion->query($query);

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Agregar Categoría</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="agregar-body">
  <div class="agregar-bg-image">
    <div class="agregar-main-container">
      <h2>Agregar Categoría</h2>
      <form method="POST">
        <label>Introduzca la nueva Categoría:</label>
        <input type="text" name="nombre">
        <br><br>
        <button type="submit" name="agregar">Agregar</button>
      </form>
    </div>
  </div>
  <script>
    <?php if (isset($_POST['agregar'])): ?>
      alert('La categoría ha sido agregada correctamente.');
    <?php endif; ?>
  </script>
</body>
</html>

