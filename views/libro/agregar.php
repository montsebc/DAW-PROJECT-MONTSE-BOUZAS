<!DOCTYPE html>
<html>
<head>
	<title>Agregar libro</title>
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
<h1>Agregar libro</h1>
<form action="index.php?action=agregarLibro" method="post">
  <label for="titulo">Título:</label>
  <input type="text" name="titulo" required>
  <br>

  <label for="autor">Autor:</label>
  <input type="text" name="autor" required>
  <br>

  <label for="categoria_id">Categoría:</label>
  <select name="categoria_id" required>
    <option value="">Selecciona una categoría</option>
    <?php foreach ($categorias as $categoria): ?>
      <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
    <?php endforeach ?>
  </select>
  <br>

  <label for="cantidad_ejemplares">Cantidad de ejemplares:</label>
  <input type="number" name="cantidad_ejemplares" required>
  <br>

  <button type="submit">Agregar</button>
</form>
</body>
</html>

