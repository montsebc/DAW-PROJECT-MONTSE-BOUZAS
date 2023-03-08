<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Categorías</title>
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
	<h1>Eliminar categoría</h1>

<?php if (isset($categoria)): ?>
    <p>¿Está seguro de que desea eliminar la categoría? "<?php echo $categoria->getNombre(); ?>"?</p>

    <form action="/categoria/eliminar" method="POST">
        <input type="hidden" name="id" value="<?php echo $categoria->getId(); ?>">
        <input type="submit" value="Eliminar">
    </form>
<?php else: ?>
    <p>No se ha encontrado la categoría a eliminar.</p>
<?php endif; ?>

</body>
</html>