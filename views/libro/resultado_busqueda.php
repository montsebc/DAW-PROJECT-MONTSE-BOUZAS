<?php


// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener los datos de la búsqueda desde el formulario
$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : '';
$valor_busqueda = isset($_GET['valor_busqueda']) ? $_GET['valor_busqueda'] : '';

// Consulta SQL para buscar el libro según la opción seleccionada y el valor de búsqueda
$query = "SELECT * FROM libros";
if (!empty($opcion) && !empty($valor_busqueda)) {
  $query .= " WHERE $opcion LIKE '%$valor_busqueda%'";
}

$resultado = $conexion->query($query);


// Verificar si se obtuvieron resultados
if ($resultado && $resultado->num_rows > 0) {
  // Mostrar los resultados en una tabla
  echo "<table>";
  echo "<tr><th>Título</th><th>Autor</th><th>Editorial</th><th>ISBN</th></tr>";
  while ($libro = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$libro['titulo']."</td>";
    echo "<td>".$libro['autor']."</td>";
    echo "<td>".$libro['editorial']."</td>";
    echo "<td>".$libro['isbn']."</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  // Mostrar un mensaje si no se encontraron resultados
  echo "No se encontraron resultados.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>