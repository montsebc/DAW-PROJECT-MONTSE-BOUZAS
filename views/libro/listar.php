<?php
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
</head>
<body>
  <h2>Listado de Libros</h2>
  <table border="1">
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
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>
