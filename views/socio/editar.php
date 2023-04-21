<?php
include('../../includes/header.php'); 

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

  // Verificar si el socio ha realizado préstamos en el pasado
  $query = "SELECT COUNT(*) AS num_prestamos FROM prestamos WHERE id_socio = $id";
  $resultado = $conexion->query($query);

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $num_prestamos = $fila['num_prestamos'];

    if ($num_prestamos > 0) {
      // Si el socio ha realizado préstamos, mostrar mensaje de error
      echo "<script>alert('No se puede eliminar el socio, ya ha realizado al menos un préstamo. Si lo desea, puede modificarlo.');</script>";
    } else {
      // Si el socio no ha realizado préstamos, eliminar el socio de la base de datos
      $query = "DELETE FROM socios WHERE id = $id";
      $resultado = $conexion->query($query);

      // Mostrar mensaje de éxito
      echo "<script>alert('El socio ha sido eliminado correctamente.');</script>";
    }
  }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
      max-width: 100%;
      margin: auto;
    }

    .table-container {
      overflow-y: scroll;
      height: 450px; /* ajusta esta altura según sea necesario */
    }
    thead th {
      position: sticky;
      top: 0;
      background-color: #fff;
      z-index: 1;
    }

    /* Nuevo estilo */
    .button-container {
      display: flex;
      justify-content: space-between;
    }

    /* Estilo modificado */
    .form-control {
      height: calc(1.5em + .75rem + 2px);
      padding: .375rem .75rem;
      font-size: .875rem;
      line-height: 1.5;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8 p-5 bg-opacity">
        <h2>Editar Socios</h2>
        <div class="table-container">
          <table class="table table-striped">
            <thead class="sticky-header">
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
                    <td><input type="text" name="nombre" class="form-control" value="<?= $socio['nombre'] ?>"></td>
                    <td><input type="text" name="apellidos" class="form-control" value="<?= $socio['apellidos'] ?>"></td>
                    <td><input type="email" name="email" class="form-control" value="<?= $socio['email'] ?>"></td>
                    <td><input type="text" name="telefono" class="form-control" value="<?= $socio['telefono'] ?>"></td>
                    <td>
                      <div class="button-container">
                      <button type="submit" name="actualizar" class="btn btn-primary" style="background-color: #8c9390;">Guardar</button>
                      <button type="submit" name="eliminar" class="btn btn-danger" onclick="return confirm('¿Está seguro que desea eliminar este socio?')" style="background-color: #e0cc8d;">Eliminar</button>
                      </div>
                    </td>
                  </form>
                </tr>
              <?php endforeach ?>
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


            
