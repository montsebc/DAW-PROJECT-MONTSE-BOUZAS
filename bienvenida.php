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
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <!-- Biblioteca de estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Tu archivo de estilos CSS -->
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
	<?php if (isset($_SESSION['usuario'])): ?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Booking a Book</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="categoriaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categoría
        </a>
        <div class="dropdown-menu" aria-labelledby="categoriaDropdown">
		<a class="dropdown-item" href="index.php?action=editar_categoria&id=<?php echo $categoria['id']; ?>">Editar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <a class="dropdown-item" href="#">Listar</a>
          <a class="dropdown-item" href="#">Nuevo</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="libroDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Libro
        </a>
        <div class="dropdown-menu" aria-labelledby="libroDropdown">
          <a class="dropdown-item" href="#">Actualizar</a>
          <a class="dropdown-item" href="#">Agregar</a>
          <a class="dropdown-item" href="#">Buscar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <a class="dropdown-item" href="#">Guardar</a>
          <a class="dropdown-item" href="#">Listar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="prestamoDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Préstamo
        </a>
        <div class="dropdown-menu" aria-labelledby="prestamoDropdown">
          <a class="dropdown-item" href="#">Devolver</a>
          <a class="dropdown-item" href="#">Listar</a>
          <a class="dropdown-item" href="#">Nuevo</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="socioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Socio
        </a>
        <div class="dropdown-menu" aria-labelledby="socioDropdown">
          <a class="dropdown-item" href="#">Editar</a>
          <a class="dropdown-item" href="#">Eliminar</a>
          <a class="dropdown-item" href="#">Listar</a>
          <a class="dropdown-item" href="#">Nuevo</a>
        </div>
	  </li>
	  <li class="nav-item">
  		<a class="nav-link" href="logout.php">Cerrar sesión</a>
	</li>


		</ul>

        </div>
    </nav>
	<div class="container">
        <h1>Bienvenido</h1>
        <p>¡Bienvenido/a <?php echo $email; ?>! Esta es la página de bienvenida.</p>
    </div>
    <?php endif; ?>
    <!-- Biblioteca de scripts de jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Biblioteca de scripts de Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
