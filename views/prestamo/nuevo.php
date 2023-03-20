<?php

include('../includes/header.php'); 

require_once __DIR__ . "/../../controllers/PrestamoController.php";
$prestamoController = new PrestamoController();
$libros = $prestamoController->listarLibrosDisponibles();
$socios = $prestamoController->listarSocios();


function calcularFechaDevolucion($fecha_prestamo) {
    $diasPrestamo = 14; 
    $fecha_prestamo_obj = new DateTime($fecha_prestamo);
    $fecha_prestamo_obj->modify("+$diasPrestamo days");
    return $fecha_prestamo_obj->format('Y-m-d');
}
$prestamoExitoso = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_libro = $_POST['id_libro'];
    $id_socio = $_POST['id_socio'];
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = calcularFechaDevolucion($fecha_prestamo);
   
    $prestamoExitoso = $prestamoController->crearPrestamo($id_libro, $id_socio, $fecha_prestamo, $fecha_devolucion);

if (!$prestamoExitoso) {
    $mensajeError = "No se pudo realizar el préstamo. El socio ya tiene 3 libros prestados.";
} else {
    echo "<script>location.href='listar.php';</script>";
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Préstamo</title>
    <script>
        function calcularFechaDevolucion() {
            const fechaPrestamo = document.getElementById('fecha_prestamo');
            const fechaDevolucion = document.getElementById('fecha_devolucion');
            const diasPrestamo = 14;

            fechaPrestamo.addEventListener('change', function() {
                const fechaPrestamoMoment = new Date(fechaPrestamo.value);
                fechaPrestamoMoment.setDate(fechaPrestamoMoment.getDate() + diasPrestamo);
                fechaDevolucion.valueAsDate = fechaPrestamoMoment;
            });

            const fechaPrestamoMoment = new Date();
            fechaPrestamoMoment.setDate(fechaPrestamoMoment.getDate() + diasPrestamo);
            fechaDevolucion.valueAsDate = fechaPrestamoMoment;
        }

        document.addEventListener("DOMContentLoaded", function() {
            calcularFechaDevolucion();
        });
    </script>
</head>
<body>
<div class="container main-container">

    <h1>Nuevo Préstamo</h1>
    <form action="nuevo.php" method="POST">
        <label for="id">Libro:</label>
        <select name="id_libro" id="id_libro">
            <?php while ($libro = $libros->fetch_assoc()): ?>
                <option value="<?php echo $libro['id']; ?>"><?php echo $libro['titulo']; ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <label for="id_socio">Socio:</label>
        <select name="id_socio" id="id_socio">
        <?php while ($socio = $socios->fetch_assoc()): ?>
            <option value="<?php echo $socio['id']; ?>"><?php echo $socio['nombre'] . ' ' . $socio['apellidos']; ?></option>
<?php endwhile; ?>
</select>

<br>

<label for="fecha_prestamo">Fecha de préstamo:</label>
<input type="date" id="fecha_prestamo" name="fecha_prestamo" value="<?php echo date('Y-m-d'); ?>">

<br>

<label for="fecha_devolucion">Fecha de devolución:</label>
<input type="date" id="fecha_devolucion" name="fecha_devolucion">
<br>
<?php if (isset($mensajeError)): ?>
<p style="color: red;"><?php echo $mensajeError; ?></p>
<?php endif; ?>

<button type="submit">Crear préstamo</button>
</form>
<a href="listar.php">Volver a la lista de préstamos</a>
</div>
</body>
</html>

