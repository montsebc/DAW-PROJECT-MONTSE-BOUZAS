<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Devolución de préstamo</title>
</head>
<body>
  <h1>Devolución de préstamo</h1>
  <form action="../src/devolucion.php" method="post">
    <label for="prestamo_id">ID del préstamo a devolver:</label>
    <input type="text" id="prestamo_id" name="prestamo_id">
    <br>
    <button type="submit">Devolver préstamo</button>
  </form>
  <br>
  <a href="../views/prestamo-lista.php">Volver a la lista de préstamos</a>
  <br>
  <a href="../index.php">Volver al dashboard</a>
</body>
</html>
