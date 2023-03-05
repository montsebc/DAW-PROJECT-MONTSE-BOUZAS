<?php
session_start();

// Si no hay sesión iniciada, redirigir al usuario al login
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?action=login');
    exit;
}

// Obtener el email del usuario
$email = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bienvenido</title>
</head>
<body>
	<h1>Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
	<nav>
		<ul>
			<li><a href="index.php?action=prestamos">Préstamos</a></li>
			<li><a href="index.php?action=socios">Socios</a></li>
			<li><a href="index.php?action=libros">Libros</a></li>
			<li><a href="index.php?action=categorias">Categorías</a></li>
			<li><a href="index.php?action=logout">Cerrar sesión</a></li>
		</ul>
	</nav>
	<p>Contenido de la página de bienvenida</p>
</body>
</html>

