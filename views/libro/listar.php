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
  <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body class="listado-body">
  <div class="listado-bg-wrapper">
    <div class="listado-main-container">
      <h1>Listado de Libros</h1>
      <table class="listado-table">
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
</body>
</html>
