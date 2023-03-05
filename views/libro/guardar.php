<!DOCTYPE html>
<html>
<head>
	<title>Guardar Libro</title>
</head>
<body>
    <nav>
	  <ul>
	    <li><a href="index.php?action=prestamos">Préstamos</a></li>
	    <li><a href="index.php?action=socios">Socios</a></li>
	    <li><a href="index.php?action=libros">Libros</a></li>
	    <li><a href="index.php?action=categorias">Categorías</a></li>
	  </ul>
	</nav>
	<h1>Guardar Libro</h1>
	<form action="/libro/guardar" method="POST">
		<label>Título:</label>
		<input type="text" name="titulo"><br><br>

		<label>Autor:</label>
		<input type="text" name="autor"><br><br>

		<label>Categoría:</label>
		<select name="categoria_id">
			<?php
			require_once '../models/Categoria.php';
			$categoria = new Categoria();
			$categorias = $categoria->listar();
			foreach ($categorias as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
			}
			?>
		</select><br><br>

		<label>Cantidad de ejemplares:</label>
		<input type="number" name="cantidad_ejemplares"><br><br>

		<button type="submit">Guardar</button>
	</form>
</body>
</html>
