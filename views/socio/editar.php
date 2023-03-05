<!DOCTYPE html>
<html>
<head>
	<title>Editar socio</title>
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

	
<h1>Editar socio</h1>
<form action="/socio/actualizar" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $socio->getId(); ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $socio->getNombre(); ?>" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo $socio->getApellidos(); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $socio->getEmail(); ?>" required>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="telefono" value="<?php echo $socio->getTelefono(); ?>" required>

    <button type="submit">Actualizar</button>
</form>
</body>
</html>
