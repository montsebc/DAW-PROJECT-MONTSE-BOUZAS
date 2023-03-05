<!DOCTYPE html>
<html>
<head>
	<title>Buscador de libros</title>
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
<h1>Buscar Libro</h1>
<form method="POST">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" required>
    <button type="submit">Buscar</button>
</form>
<?php if (isset($libros) && count($libros) > 0) { ?>
    <h2>Resultados de la búsqueda:</h2>
    <ul>
    <?php foreach ($libros as $libro) { ?>
        <li>
            <strong>Título:</strong> <?php echo $libro->getTitulo(); ?><br>
            <strong>Autor:</strong> <?php echo $libro->getAutor(); ?><br>
            <strong>Categoría:</strong> <?php echo $libro->getCategoria()->getNombre(); ?><br>
            <strong>Cantidad de Ejemplares:</strong> <?php echo $libro->getCantidadEjemplares(); ?>
        </li>
    <?php } ?>
    </ul>
<?php } else if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <p>No se encontraron resultados para la búsqueda.</p>
<?php } ?>
</body>
</html>

