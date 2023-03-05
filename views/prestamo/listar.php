<!DOCTYPE html>
<html>
<head>
	<title>Listado de préstamos</title>
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
<h1>Listado de préstamos</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Socio</th>
        <th>Libro</th>
        <th>Fecha de préstamo</th>
        <th>Fecha de devolución</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($prestamos as $prestamo): ?>
    <tr>
        <td><?php echo $prestamo->getId(); ?></td>
        <td><?php echo $prestamo->getSocio()->getNombreCompleto(); ?></td>
        <td><?php echo $prestamo->getLibro()->getTitulo(); ?></td>
        <td><?php echo $prestamo->getFechaPrestamo(); ?></td>
        <td><?php echo $prestamo->getFechaDevolucion() ?: 'Pendiente'; ?></td>
        <td>
            <?php if (!$prestamo->getFechaDevolucion()): ?>
                <a href="#">Devolver</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="/prestamo/nuevo">Agregar nuevo préstamo</a>
</body>
</html>
