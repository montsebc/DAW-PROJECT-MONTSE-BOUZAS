<?php
include('../../includes/header.php'); 

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
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body class="devuelto-body">
<div class="devuelto-container">

    <h1 class="devuelto-header">Listado de préstamos devueltos</h1>
    <table class="devuelto-table">
        <thead>
            <tr>
                <th class="devuelto-th">ID</th>
                <th class="devuelto-th">Título</th>
                <th class="devuelto-th">Autor</th>
                <th class="devuelto-th">Nombre del socio</th>
                <th class="devuelto-th">Fecha de préstamo</th>
                <th class="devuelto-th">Fecha de devolución</th>
                <th class="devuelto-th">Entrega anticipada</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($prestamos): ?>

    <?php foreach ($prestamos as $prestamo): ?>
        <tr>
            <td class="devuelto-td"><?php echo $prestamo['id']; ?></td>
            <td class="devuelto-td"><?php echo $prestamo['titulo']; ?></td>
            <td class="devuelto-td"><?php echo $prestamo['autor']; ?></td>
            <td class="devuelto-td"><?php echo $prestamo['nombre'] . ' ' . $prestamo['apellidos']; ?></td>
            <td class="devuelto-td"><?php echo $prestamo['fecha_prestamo']; ?></td>
            <td class="devuelto-td"><?php echo date("Y-m-d", strtotime($prestamo['fecha_prestamo'] . ' + 14 days')); ?></td>
<td class="devuelto-td">
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
<a href="../../bienvenida.php" class="devuelto-link">Volver al menú principal</a><br>
<a href="devolver.php" class="devuelto-link">Devolver un libro</a>
</div>
</body>
</html>
