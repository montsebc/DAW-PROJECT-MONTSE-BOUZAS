<!DOCTYPE html>
<html>
<head>
	<title>Listado de socios</title>
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

	
<h1>Listado de socios</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($socios as $socio): ?>
    <tr>
        <td><?php echo $socio->getId(); ?></td>
        <td><?php echo $socio->getNombre(); ?></td>
        <td><?php echo $socio->getApellidos(); ?></td>
        <td><?php echo $socio->getEmail(); ?></td>
        <td><?php echo $socio->getTelefono(); ?></td>
        <td>
            <a href="#">Editar</a>
            <a href="#">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="/socio/nuevo">Agregar nuevo socio</a>
</body>
</html>
