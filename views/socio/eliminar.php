<?php
// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// comprobar si se ha enviado un formulario para eliminar el socio
if (isset($_POST['eliminar'])) {
  // obtener el id del socio a eliminar
  $id = $_POST['socio'];

  // eliminar el socio de la base de datos
  $query = "DELETE FROM socios WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('El socio ha sido eliminado correctamente.');</script>";
}

// consulta SQL para obtener todos los socios
$query = "SELECT * FROM socios";
$resultado = $conexion->query($query);

// verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
  // inicializar un array vacío para almacenar los socios
  $socios = [];

  // iterar a través de los resultados y agregar cada socio al array
  while ($fila = $resultado->fetch_assoc()) {
    $socios[] = $fila;
  }
} else {
  // no se encontraron resultados, asignar un array vacío
  $socios = [];
}

// cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Eliminar Socio</title>
</head>
<body>
  <h2>Eliminar Socio</h2>
  <form method="POST" action="">
    <label for="socio">Seleccione un socio:</label>
    <select name="socio" id="socio">
      <option value="">Seleccione un socio</option>
      <?php foreach ($socios as $socio): ?>
        <option value="<?= $socio['id'] ?>"><?= $socio['nombre'] . ' ' . $socio['apellidos'] ?></option>
      <?php endforeach ?>
    </select>
    <br>
    <button type="submit" name="eliminar" onclick="return confirm('¿Está seguro que desea eliminar este socio?')">Eliminar</button>
  </form>
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>
