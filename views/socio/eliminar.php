<!DOCTYPE html>
<html>
<head>
	<title>Eliminar socio</title>
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
<h1>Eliminar socio</h1>
<p>¿Está seguro que desea eliminar el socio <strong><?php echo $socio->getNombreCompleto(); ?></strong>?</p>
<form action="/socio/eliminar" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $socio->getId(); ?>">
    <button type="submit">Eliminar</button>
</form>
</body>
</html>
