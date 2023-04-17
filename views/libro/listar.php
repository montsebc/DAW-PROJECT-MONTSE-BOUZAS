<?php
include('../../includes/header.php');

// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Consulta SQL para obtener todos los libros
$query = "SELECT libros.id, libros.titulo, libros.autor, libros.editorial, libros.isbn, categorias.nombre AS categoria, libros.cantidad_ejemplares FROM libros INNER JOIN categorias ON libros.id_categoria = categorias.id";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Listado de Libros</title>
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
    .table-container {
      overflow-y: scroll;
      height: 400px; /* ajusta esta altura según sea necesario */
    }
    thead th {
      position: sticky;
      top: 0;
      background-color: #fff;
      z-index: 1;
    }
  </style>
</head>
<body class="listado-body">
  <div class="container mt-5">
    <div class="bg-opacity">
      <div class="listado-main-container">
        <h1 class="text-center mb-4">Listado de Libros</h1>
        <div class="table-container">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>ISBN</th>
                <th>Categoría</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($libro = $resultado->fetch_assoc()): ?>
                <tr>
                  <td><?= $libro['titulo'] ?></td>
                  <td><?= $libro['autor'] ?></td>
                  <td><?= $libro['editorial'] ?></td>
                  <td><?= $libro['isbn'] ?></td>
                  <td><?= $libro['categoria'] ?></td>
                </tr>
              <?php endwhile; ?>
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
