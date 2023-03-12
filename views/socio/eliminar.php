<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Verificar si se ha pasado el id del socio a eliminar en la URL
if (!isset($_GET['id'])) {
  echo "<p>No se ha especificado el socio que desea eliminar.</p>";
} else {
  $id = mysqli_real_escape_string($conexion, $_GET['id']);

  // Obtener los datos del socio a eliminar
  $query = "SELECT * FROM socios WHERE id = '$id'";
  $resultado = $conexion->query($query);

  // Verificar si se encontró el socio
  if ($resultado->num_rows == 0) {
    echo "<p>No se encontró el socio que desea eliminar.</p>";
  } else {
    $socio = $resultado->fetch_assoc();

    // Verificar si se ha enviado un formulario para confirmar la eliminación del socio
    if (isset($_POST['eliminar'])) {
      // Eliminar el socio de la base de datos
      $query = "DELETE FROM socios WHERE id = '$id'";
      $resultado = $conexion->query($query);

      // Verificar si se eliminó el socio correctamente
      if ($conexion->affected_rows > 0) {
        echo "<p>El socio ha sido eliminado correctamente.</p>";
        header('Location: editar.php');
        exit;
      } else {
        echo "<p>No se pudo eliminar al socio.</p>";
      }
    } else {
      // Mostrar formulario de eliminación
      echo "<h2>Eliminar socio</h2>";
      echo "<p>¿Está seguro que desea eliminar el socio " . $socio['nombre'] . ' ' . $socio['apellidos'] . "?</p>";
      echo "<form method='post'>";
      echo "<input type='submit' name='eliminar' value='Eliminar'>";
      echo "<button onclick=\"location.href='editar.php'\">Cancelar</button>";
      echo "</form>";
    }
  }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
