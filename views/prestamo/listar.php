<?php
require_once __DIR__ . "/../../core/Model.php";
 require_once __DIR__ . "/../../controllers/PrestamoController.php";
 require_once __DIR__ . "/../../models/Prestamo.php";
 

// Crear el objeto PrestamoController
$prestamoController = new PrestamoController();

// Llamar al método listar() del objeto PrestamoController
$prestamos = $prestamoController->listar();
require_once __DIR__ . '/listar.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado de préstamos</title>
</head>
<body>
	
    <h1>Listado de préstamos</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Socio</th>
        <th>Libro</th>
        <th>Fecha de préstamo</th>
        <th>Fecha de devolución</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($prestamos as $prestamo): ?>
        <tr>
            <td><?php echo $prestamo->getId(); ?></td>
            <td><?php echo $prestamo->getSocio()->getNombreCompleto(); ?></td>
            <td><?php echo $prestamo->getLibro()->getTitulo(); ?></td>
            <td><?php echo $prestamo->getFechaPrestamo(); ?></td>
            <td><?php echo $prestamo->getFechaDevolucion(); ?></td>
            <td>
                <a href="?controller=prestamo&action=devolver&id=<?php echo $prestamo->getId(); ?>">Devolver</a>
                <a href="?controller=prestamo&action=eliminar&id=<?php echo $prestamo->getId(); ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="/prestamo/nuevo">Agregar nuevo préstamo</a>
</body>
</html>
