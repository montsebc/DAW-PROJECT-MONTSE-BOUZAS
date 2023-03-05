<!DOCTYPE html>
<html>
<head>
	<title>Listado de Libros</title>
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

	<h1>Listado de libros</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Título</th>
      <th>Autor</th>
      <th>Categoría</th>
      <th>Cantidad disponible</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($libros as $libro): ?>
    <tr>
      <td><?= $libro->getId() ?></td>
      <td><?= $libro->getTitulo() ?></td>
      <td><?= $libro->getAutor() ?></td>
      <td><?= $libro->getCategoria()->getNombre() ?></td>
      <td><?= $libro->getCantidadDisponible() ?></td>
      <td>
        <a href="editar.php?id=<?= $libro->getId() ?>">Editar</a>
        <a href="borrar.php?id=<?= $libro->getId() ?>">Borrar</a>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
</body>
</html>
