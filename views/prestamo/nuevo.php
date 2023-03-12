<!DOCTYPE html>
<html>
<head>
    <title>Nuevo préstamo</title>
</head>
<body>
    <h1>Nuevo préstamo</h1>
    <form action="/prestamo/crear" method="POST">
        <label for="libro">Libro:</label>
        <select name="libro" id="libro">
            <?php foreach ($libros as $libro): ?>
                <option value="<?php echo $libro->getId(); ?>"><?php echo $libro->getTitulo(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="socio">Socio:</label>
        <select name="socio" id="socio">
            <?php foreach ($socios as $socio): ?>
                <option value="<?php echo $socio->getId(); ?>"><?php echo $socio->getNombre(); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Crear préstamo</button>
    </form>
</body>
</html>
