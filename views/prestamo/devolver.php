<?php
include('../../includes/header.php');

require_once __DIR__ . "/../../controllers/PrestamoController.php";
$prestamoController = new PrestamoController();

$prestamos = $prestamoController->listarPrestamos();

$socios = $prestamoController->listarSocios();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $prestamoController->devolverPrestamo($id);
    unset($prestamoController);

    echo "<script>location.href='listar.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Devolver Préstamo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("../../assets/images/estante-librosBonita.png");
            background-size: cover;
            background-position: center;
        }

        .bg-opacity {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
        }
        .table-container {
            overflow-y: scroll;
        }
        thead th {
            position: sticky;
            top: 0;
            background-color: #fff;
            z-index: 1;
        }
    </style>
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
<body class="devolver-body">
    <div class="container mt-5">
        <div class="bg-opacity">
            <div class="listado-main-container">
                <h1 class="text-center mb-4">Devolver Préstamo</h1>
                <div id="table-container" class="table-container">
                    <table id="prestamos-table" class="table table-striped table-hover">
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
                                            <button type="button" onclick="confirmarDevolucion(<?php echo $prestamo['id']; ?>);" class="btn btn-danger">Devolver</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        const tableContainer = document.getElementById("table-container");
        const table = document.getElementById("prestamos-table");
        const tableHeight = table.offsetHeight;

        tableContainer.style.height = tableHeight <= 600 ? tableHeight + "px" : "600px";
    </script>
</body>
</html>

