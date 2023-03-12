<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// Verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Comprobar si se ha enviado un formulario para actualizar o eliminar el socio
if (isset($_POST['actualizar'])) {
  // Obtener el id y los nuevos datos del socio
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];

  // Actualizar el socio en la base de datos
  $query = "UPDATE socios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email', telefono = '$telefono' WHERE id = $id";
  $resultado = $conexion->query($query);

  // Mostrar mensaje de éxito
  echo "<script>alert('El socio ha sido actualizado correctamente.');</script>";
} elseif (isset($_POST['eliminar'])) {
  // Obtener el id del socio a eliminar
  $id = $_POST['id'];

  // Eliminar el socio de la base de datos
  $query = "DELETE FROM socios WHERE id = $id";
  $resultado = $conexion->query($query);

  // Mostrar mensaje de éxito
  echo "<script>alert('El socio ha sido eliminado correctamente.');</script>";
}

// Consulta SQL para obtener todos los socios
$query = "SELECT * FROM socios";
$resultado = $conexion->query($query);

// Verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
  // Inicializar un array vacío para almacenar los socios
  $socios = [];

  // Iterar a través de los resultados y agregar cada socio al array
  while ($fila = $resultado->fetch_assoc()) {
    $socios[] = $fila;
  }
} else {
  // No se encontraron resultados, asignar un array vacío
  $socios = [];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Socios</title>
</head>
<body>
  <h2>Editar Socios</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($socios as $socio): ?>
        <tr>
          <td><?= $socio['id'] ?></td>
          <td><?= $socio['nombre'] ?></td>
          <td><?= $socio['apellidos'] ?></td>
          <td><?= $socio['email'] ?></td>
          <td><?= $socio['telefono'] ?></td>
          <td>
            <a href="editar.php?id=<?= $socio['id'] ?>">Editar</a>
            <a href="eliminar.php?id=<?= $socio['id'] ?>" onclick="return confirm('¿Está seguro que desea eliminar este socio?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>




