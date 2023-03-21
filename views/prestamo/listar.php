<?php
include('../includes/header.php'); 

require_once __DIR__ . "/../../controllers/PrestamoController.php";

$prestamoController = new PrestamoController();

$socio = isset($_GET['socio']) ? $_GET['socio'] : null;
$titulo = isset($_GET['titulo']) ? $_GET['titulo'] : null;
$fecha_prestamo = isset($_GET['fecha_prestamo']) ? $_GET['fecha_prestamo'] : null;

if ($socio !== null || $titulo !== null || $fecha_prestamo !== null) {
    $prestamos = $prestamoController->listarPrestamosFiltrados($socio, $titulo, $fecha_prestamo);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Préstamos</title>
</head>
<body>
    <div class="container main-container">

        <h1>Listado de Préstamos Activos</h1>
        <form method="GET">
            <label for="socio">Filtrar por Socio:</label>
            <select name="socio" id="socio">
                <option value="">Todos los socios</option>
                <?php foreach ($prestamoController->listarSocios() as $s): ?>
                    <option value="<?php echo $s['nombre'] . ' ' . $s['apellidos']; ?>"
                        <?php if ($socio === $s['nombre'] . ' ' . $s['apellidos']): ?>
                            selected
                        <?php endif; ?>>
                        <?php echo $s['nombre'] . ' ' . $s['apellidos']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="titulo">Filtrar por Título:</label>
            <select name="titulo" id="titulo">
                <option value="">Todos los títulos</option>
                <?php foreach ($prestamoController->listarLibrosDisponibles() as $l): ?>
                    <option value="<?php echo $l['titulo']; ?>"
                        <?php if ($titulo === $l['titulo']): ?>
                            selected
                        <?php endif; ?>>
                        <?php echo $l['titulo']; ?>
                        <?php if (isset($l['ejemplares_disponibles'])): ?>(<?php echo $l['ejemplares_disponibles']; ?> ejemplares disponibles)<?php endif; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="fecha_prestamo">Filtrar por Fecha de Préstamo:</label>
            <input type="date" name="fecha_prestamo" id="fecha_prestamo" value="<?php echo $fecha_prestamo; ?>">

            <button type="submit">Filtrar</button>
        </form>

        <?php if (isset($prestamos) && $prestamos->num_rows > 0): ?>
            <table>
            <thead>
            <tr>
                <th>ID Préstamo</th>
                <th>Título del libro</th>
                <th>Autor del libro</th>
                <th>Socio</th>
                <th>Fecha de préstamo</th>
                <th>Fecha de entrega esperada</th>
                <th style="width: 150px;">Fecha de entrega real</th> 
                <th style="width: 150px;">Ejemplares disponibles</th> 
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
    <td style="width: 150px;">       
     <?php 
            echo ($prestamo['entrega_anticipada'] === '' || $prestamo['entrega_anticipada'] === NULL || $prestamo['entrega_anticipada'] === '0000-00-00' || $prestamo['entrega_anticipada'] === 'En préstamo') ? 'En préstamo' : date('Y-m-d', strtotime($prestamo['entrega_anticipada'])); 
        ?>
    </td>
    <td style="width: 150px;"> 
    <?php echo isset($prestamo['ejemplares_disponibles']) ? $prestamo['ejemplares_disponibles'] : 'No disponible'; ?></td>

    </td>
</tr>
<?php endwhile; ?>
</tbody>
    </table>

<?php else: ?>
    <?php if (isset($_GET['socio']) || isset($_GET['titulo']) || isset($_GET['fecha_prestamo'])): ?>
        <p>No se encontraron préstamos</p>
    <?php endif; ?>
<?php endif; ?>

<a href="../../bienvenida.php">Volver al menú principal</a><br>
<a href="devolver.php">Devolver un libro</a>
</div>
</body>
</html>
