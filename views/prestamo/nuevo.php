<!DOCTYPE html>
<html>
<head>
	<title>Añadir nuevo préstamos</title>
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

	
<h1>Nuevo préstamo</h1>
<form method="POST" action="/prestamo/guardar">
    <label for="socio_id">Socio:</label>
    <select name="socio_id" id="socio_id">
        <?php foreach ($socios as $socio): ?>
            <option value="<?php echo $socio->getId(); ?>"><?php echo $socio->getNombreCompleto(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="libro_id">Libro:</label>
    <select name="libro_id" id="libro_id">
        <?php foreach ($libros as $libro): ?>
            <option value="<?php echo $libro->getId(); ?>"><?php echo $libro->getTitulo(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="fecha_prestamo">Fecha de préstamo:</label>
    <input type="date" name="fecha_prestamo" id="fecha_prestamo">
    <br>
    <input type="submit" value="Guardar">
</form>
</body>
</html>
