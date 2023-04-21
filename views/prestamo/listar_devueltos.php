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
          height: 400px; /* ajusta esta altura según sea necesario */
        }
        thead th {
          position: sticky;
          top: 0;
          background-color: #fff;
          z-index: 1;
        }
    </style>
</head>
<body class="devuelto-body">
<div class="container mt-5">
    <div class="bg-opacity">
        <h1 class="text-center mb-4">Listado de préstamos devueltos</h1>
        <div class="table-container">
            <table class="table table-striped table-hover">
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
        </div>
    </div>
</div>
</body>
</html>

