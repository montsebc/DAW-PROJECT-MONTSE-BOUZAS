<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/micss.css">
</head>
<body>
    <header>
        <nav>
            <a href="../views/dashboard.php"><h2>Volver a la pantalla principal</h2></a>
        </nav>
    </header>
    <h1>CATEGORÍAS</h1>
    <ul>
        <?php
            include "../src/queries.php";
            require_once '../src/database.php';

            // Obtener todas las categorías
            $categorias = getCategorias();

            // Si se ha seleccionado una categoría, obtener los libros de esa categoría
            if (isset($_GET['categoria'])) {
                $libros = getLibrosPorCategoria($_GET['categoria']);
            } else {
                // Si no se ha seleccionado ninguna categoría, obtener todos los libros
                $libros = getAllLibros();
            }

            // Mostrar todas las categorías
            foreach ($categorias as $categoria) {
                echo "<li><a href='categorias.php?categoria={$categoria['ID']}'>{$categoria['NOMBRE']}</a></li>";
            }
        ?>
    </ul>
    <h1>LIBROS</h1>
    <?php if (!empty($libros)): ?>
        <ul>
            <?php foreach ($libros as $libro): ?>
                <li>
                    <div class="libro">
                        <?php if (isset($libro['TITULO']) && isset($libro['AUTOR'])): ?>
                            <h3><?= $libro['TITULO'] ?></h3>
                            <p>de <?= $libro['AUTOR'] ?></p>
                        <?php else: ?>
                            <p>No se pudo obtener la información del libro.</p>
                        <?php endif ?>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    <?php else: ?>
        <p>No hay libros en esta categoría</p>
    <?php endif ?>
</body>
</html>




