<?php
require_once "../src/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $libro_id = $_POST['LIBRO_ID'];
  $usuario_id = $_POST['USUARIO_ID'];
  $fecha_inicio = $_POST['FECHA_INICIO'];
  $fecha_fin = $_POST['FECHA_FIN'];

  $resultado = realizarPrestamo($libro_id, $usuario_id, $fecha_inicio, $fecha_fin);
  if ($resultado === true) {
    header('Location: ../views/prestamo-lista.php');
    exit();
  }
}

function realizarPrestamo($libro_id, $usuario_id, $fecha_inicio, $fecha_fin) {
  $conn = connect();

  // Verificar si el libro ya está prestado
  $consulta = "SELECT * FROM prestamo WHERE LIBRO_ID = $libro_id AND DEVUELTO = 0";
  $resultado = mysqli_query($conn, $consulta);
  if (mysqli_num_rows($resultado) > 0) {
    return "El libro ya está prestado";
  }

  // Verificar si el usuario tiene menos de 3 libros prestados
  $consulta = "SELECT * FROM prestamo WHERE USUARIO_ID = $usuario_id AND DEVUELTO = 0";
  $resultado = mysqli_query($conn, $consulta);
  if (mysqli_num_rows($resultado) >= 3) {
    return "El usuario ya tiene 3 libros prestados";
  }

  // Insertar el nuevo préstamo
  $consulta = "INSERT INTO prestamo (LIBRO_ID, USUARIO_ID, FECHA_INICIO, FECHA_FIN) VALUES ($libro_id, $usuario_id, '$fecha_inicio', '$fecha_fin')";
  if (mysqli_query($conn, $consulta)) {
    return true;
  } else {
    return "Error al realizar el préstamo: " . mysqli_error($conn);
  }

  mysqli_close($conn);
}
?>






