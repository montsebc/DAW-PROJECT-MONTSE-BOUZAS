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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css">
  <style>
    body {
      background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url("../../assets/images/estante-librosBonita.png");
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
    .white-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.7);
      z-index: -1;
    }

  </style>
</head>
<body class="agregar-body">
<div class="white-overlay"></div>

  <div class="container mt-5">
    <div class="bg-opacity fondo-limitado">
      <div class="formulario-estrecho">
        <h2 class="text-center mb-4">Agregar Categoría</h2>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Introduzca la nueva Categoría:</label>
            <input type="text" name="nombre" class="form-control">
          </div>
          <button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    <?php if (isset($_POST['agregar'])): ?>
      alert('La categoría ha sido agregada correctamente.');
      location.href = 'listar.php'; // redirigir al listado
    <?php endif; ?>
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
