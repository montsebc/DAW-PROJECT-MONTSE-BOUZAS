<!DOCTYPE html>
<html>
<head>
	<title>Editar Categorías</title>
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
<h1>Editar categoría</h1>

<form action="/categoria/actualizar" method="POST">
    <input type="hidden" name="id" value="<?php echo $categoria->getId(); ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $categoria->getNombre(); ?>" required>
    <input type="submit" value="Actualizar">
</form>
</body>
</html>
