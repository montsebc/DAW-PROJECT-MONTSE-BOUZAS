<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de libros</title>
</head>
<body>
    <h1>Listado de libros</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($libros_disponibles)) : ?>
                <?php foreach ($libros_disponibles as $libro) : ?>
                    <tr>
                        <td><?= $libro['titulo'] ?></td>
                        <td><?= $libro['autor'] ?></td>
                        <td><?= $libro['editorial'] ?></td>
                        <td>Disponible a partir de <?= $libro['fecha_disponible'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No hay libros disponibles en este momento.</td>
                </tr>
            <?php endif; ?>

            <?php if (isset($prestamos)) : ?>
                <?php foreach ($prestamos as $prestamo) : ?>
                    <tr>
                        <td><?= $prestamo['titulo'] ?></td>
                        <td><?= $prestamo['autor'] ?></td>
                        <td><?= $prestamo['editorial'] ?></td>
                        <td>
                            <?php if ($prestamo['fecha_devolucion']) : ?>
                                Prestado hasta <?= $prestamo['fecha_devolucion'] ?>
                            <?php else : ?>
                                Disponible
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No hay préstamos actuales.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
