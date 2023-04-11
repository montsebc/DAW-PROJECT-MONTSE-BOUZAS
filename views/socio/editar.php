<?php
include('../../includes/header.php'); 

// establecer la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'booking a book');

// verificar si se produjo un error en la conexión
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// comprobar si se ha enviado un formulario para actualizar o eliminar el socio
if (isset($_POST['actualizar'])) {
  // obtener el id y los nuevos datos del socio
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];

  // actualizar el socio en la base de datos
  $query = "UPDATE socios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email', telefono = '$telefono' WHERE id = $id";
  $resultado = $conexion->query($query);

  // mostrar mensaje de éxito
  echo "<script>alert('El socio ha sido actualizado correctamente.');</script>";
} elseif (isset($_POST['eliminar'])) {
  // obtener el id del socio a eliminar
  $id = $_POST['id'];

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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Socios</title>
</head>
<body>
<div class="container main-container">

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
      <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $socio['id'] ?>">
        <td><?= $socio['id'] ?></td>
        <td><input type="text" name="nombre" value="<?= $socio['nombre'] ?>"></td>
        <td><input type="text" name="apellidos" value="<?= $socio['apellidos'] ?>"></td>
        <td><input type="email" name="email" value="<?= $socio['email'] ?>"></td>
        <td><input type="text" name="telefono" value="<?= $socio['telefono'] ?>"></td>
        <td>
          <button type="submit" name="actualizar">Guardar</button>
          <button type="submit" name="eliminar" onclick="return confirm('¿Está seguro que desea eliminar este socio?')">Eliminar</button>
        </td>
      </form>
    </tr>
  <?php endforeach ?>
  </tbody>
  </table>
  <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
    </div>
</body>
</html>

            
