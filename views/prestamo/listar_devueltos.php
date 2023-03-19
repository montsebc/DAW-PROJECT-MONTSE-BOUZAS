<?php
require_once __DIR__ . "/../../controllers/PrestamoController.php";

$prestamoController = new PrestamoController();

// Obtener la lista de préstamos devueltos
$prestamosResult = $prestamoController->listarPrestamosDevueltos();
$prestamos = $prestamosResult->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de préstamos devueltos</title>
</head>
<body>
    <h1>Listado de préstamos devueltos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Nombre del socio</th>
                <th>Fecha de préstamo</th>
                <th>Fecha de devolución</th>
                <th>Entrega anticipada</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($prestamos): ?>

    <?php foreach ($prestamos as $prestamo): ?>
        <tr>
            <td><?php echo $prestamo['id']; ?></td>
            <td><?php echo $prestamo['titulo']; ?></td>
            <td><?php echo $prestamo['autor']; ?></td>
            <td><?php echo $prestamo['nombre'] . ' ' . $prestamo['apellidos']; ?></td>
            <td><?php echo $prestamo['fecha_prestamo']; ?></td>
            <td><?php echo date("Y-m-d", strtotime($prestamo['fecha_prestamo'] . ' + 14 days')); ?></td>
            <td>
                <?php 
                    if ($prestamo['entrega_anticipada'] !== 'No') {
                        echo $prestamo['entrega_anticipada'];
                    } else {
                        echo $prestamo['fecha_devolucion'];
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>


        </tbody>
    </table>
    <a href="../../bienvenida.php">Volver al menú principal</a><br>
    <a href="devolver.php">Devolver un libro</a>
</body>
</html>
