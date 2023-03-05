<!DOCTYPE html>
<html>
<head>
	<title>Devolver préstamo</title>
</head>
<body>
	<!-- Este es el menú de navegación que deberás incluir en todas las páginas que conforman tu aplicación -->
	<nav>
	  <ul>
	    <li><a href="index.php?action=prestamos">Préstamos</a></li>
	    <li><a href="index.php?action=socios">Socios</a></li>
	    <li><a href="index.php?action=libros">Libros</a></li>
	    <li><a href="index.php?action=categorias">Categorías</a></li>
	  </ul>
	</nav>

	<h1>Devolución de préstamos</h1>
<h1>Devolver préstamo</h1>
<form method="POST" action="/prestamo/devolver">
    <input type="hidden" name="id" value="<?php echo $prestamo->getId(); ?>">
    <label for="fecha_devolucion">Fecha de devolución:</label>
    <input type="date" name="fecha_devolucion" id="fecha_devolucion">
    <br>
    <input type="submit" value="Guardar">
</form>
</body>
</html>
