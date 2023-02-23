<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Realizar préstamo de libro</title>
</head>
<body>
  <h1>Realizar préstamo de libro</h1>
  <form method="post" action="../views/prestamo-lista.php">
    <label for="ID">ID del libro:</label>
    <input type="text" id="ID" name="LIBRO_ID" required><br>

    <label for="USUARIO_ID">ID del socio:</label>
    <input type="text" id="USUARIO_ID" name="USUARIO_ID" required><br>

    <label for="FECHA_INICIO">Fecha de préstamo:</label>
    <input type="date" id="FECHA_INICIO" name="FECHA_INICIO" required><br>

    <label for="FECHA_FIN">Fecha de devolución:</label>
    <input type="date" id="FECHA_FIN" name="FECHA_FIN" required><br>

    <input type="submit" value="Realizar préstamo">
  </form>

  <button onclick="location.href='../views/prestamo-lista.php'">Ver los préstamos actuales</button>
</body>
</html>



