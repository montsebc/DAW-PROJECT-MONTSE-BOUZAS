<?php
require_once '../src/queries.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libro_id = $_POST['LIBRO_ID'];
    $usuario_id = $_POST['USUARIO_ID'];
    $fecha_inicio = $_POST['FECHA_INICIO'];
    $fecha_fin = $_POST['FECHA_FIN'];
    $mensaje = realizarPrestamo($libro_id, $usuario_id, $fecha_inicio, $fecha_fin);
    echo "<script>alert('$mensaje')</script>";
}

if (isset($_GET['devolver']) && is_numeric($_GET['devolver'])) {
  $prestamo_id = $_GET['devolver'];
  $mensaje = devolverPrestamo($prestamo_id);
  echo "<script>alert('$mensaje')</script>";
}

$prestamos = getAllPrestamos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de préstamos</title>
</head>
<body>
    <h1>Lista de préstamos</h1>
    <table>
        <tr>
            <th>ID de préstamo</th>
            <th>Libro</th>
            <th>Usuario</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Devuelto</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($prestamos as $prestamo): ?>
            <tr>
                <td><?php echo $prestamo['ID_PRESTAMO']; ?></td>
                <td><?php echo $prestamo['TITULO']; ?></td>
                <td><?php echo $prestamo['nombre_completo']; ?></td>
                <td><?php echo date("d/m/Y", strtotime($prestamo['FECHA_INICIO'])); ?></td>
                <td><?php echo date("d/m/Y", strtotime($prestamo['FECHA_FIN'])); ?></td>
                <td><?php echo $prestamo['DEVUELTO']; ?></td>
                <td>
                    <?php if (!$prestamo['DEVUELTO']) { ?>
                        <form method="post" action="devolucion-form.php">
                            <input type="hidden" name="prestamo_id" value="<?php echo $prestamo['ID_PRESTAMO']; ?>">
                            <button type="submit" onclick="return confirm('¿Está seguro de que desea devolver este libro?')">Devolver</button>
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="../views/prestamo-form.php">Realizar préstamo</a>
    <a href="../views/dashboard.php">Volver al dashboard</a>

</body>
</html>










