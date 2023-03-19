<?php
require_once __DIR__ . "/../../controllers/PrestamoController.php";
$prestamoController = new PrestamoController();

$prestamos = $prestamoController->listarPrestamos();

$socios = $prestamoController->listarSocios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $prestamoController->devolverPrestamo($id);
    unset($prestamoController);
    header('Location: listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Devolver Préstamo</title>
    <script>
    function confirmarDevolucion(id_prestamo) {
    if (confirm('¿Está seguro de que desea devolver este préstamo?')) {
        var form = document.getElementById('devolver-form-' + id_prestamo);
        form.submit();
        form.addEventListener('submit', function() {
            location.reload();
        });
    }
}

    </script>
</head>
<body>
    <h1>Devolver Préstamo</h1>
    <table>
        <thead>
            <tr>
                <th>ID Préstamo</th>
                <th>Título del libro</th>
                <th>Autor del libro</th>
                <th>Socio</th>
                <th>Fecha de préstamo</th>
                <th>Fecha de devolución</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($prestamo = $prestamos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $prestamo['id']; ?></td>
                    <td><?php echo $prestamo['titulo']; ?></td>
                    <td><?php echo $prestamo['autor']; ?></td>
                    <td><?php echo $prestamo['nombre'] . ' ' . $prestamo['apellidos']; ?></td>
                    <td><?php echo $prestamo['fecha_prestamo']; ?></td>
                    <td><?php echo $prestamo['fecha_devolucion']; ?></td>
                    <td>
                        <form action="devolver.php" method="POST" id="devolver-form-<?php echo $prestamo['id']; ?>">
                            <input type="hidden" name="id" value="<?php echo $prestamo['id']; ?>">
                            <button type="button" onclick="confirmarDevolucion(<?php echo $prestamo['id']; ?>);">Devolver</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="listar.php">Volver a la lista de préstamos</a>
</body>
</html>
