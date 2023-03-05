<!DOCTYPE html>
<html>
<head>
	<title>Cerrar sesión</title>
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
<h1>Cerrar sesión</h1>
<p>¿Está seguro que desea cerrar la sesión?</p>
<form method="post" action="/usuario/logout">
    <button type="submit">Cerrar sesión</button>
</form>
</body>
</html>
