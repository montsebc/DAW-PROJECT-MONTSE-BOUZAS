<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Actualizar libro</title>
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
    <h1>Actualizar libro</h1>
    <?php if (isset($mensaje)): ?>
        <p><?= $mensaje ?></p>
    <?php endif ?>
    <form method="POST" action="/libro/actualizar/<?= $libro->getId() ?>">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= $libro->getTitulo() ?>">
        <br><br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" value="<?= $libro->getAutor() ?>">
        <br><br>
        <label for="categoria_id">Categoría:</label>
        <select name="categoria_id">
        <?php if (!empty($categorias) && is_array($categorias)): ?>
    <?php foreach ($categorias as $categoria): ?>
        <?php if (is_object($categoria)): ?>
            <option value="<?= $categoria->getId() ?>" <?php if ($categoria->getId() === $libro->getCategoriaId()): ?>selected<?php endif ?>><?= $categoria->getNombre() ?></option>
        <?php endif ?>
    <?php endforeach ?>
    <?php endif ?>

        </select>
        <br><br>
        <label for="cantidad_ejemplares">Cantidad de ejemplares:</label>
        <input type="number" name="cantidad_ejemplares" value="<?= $libro->getCantidadEjemplares() ?>">
        <br><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
