<?php include('../../includes/header.php'); ?>

<?php require_once __DIR__ . "/../../controllers/PrestamoController.php"; ?>

<?php 

$prestamoController = new PrestamoController();
$libros = $prestamoController->listarLibrosDisponibles();
$socios = $prestamoController->listarSocios();

function calcularFechaDevolucion($fecha_prestamo)
{
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
      .formulario-estrecho {
        max-width: 500px;
        margin: 0 auto;
      }
      .fondo-limitado {
        max-width: 550px;
        margin: 0 auto;
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
    function calcularFechaDevolucion() {
        const fechaPrestamo = document.getElementById('fecha_prestamo');
        const fechaDevolucion = document.getElementById('fecha_devolucion');
        const diasPrestamo = 14;

        fechaPrestamo.addEventListener('change', function() {
            const fechaPrestamoMoment = new Date();
            fechaPrestamoMoment.setDate(fechaPrestamoMoment.getDate() + diasPrestamo);
            fechaDevolucion.valueAsDate = fechaPrestamoMoment;
        });
    }

        document.addEventListener("DOMContentLoaded", function() {
            calcularFechaDevolucion();
        });
    </script>

</head>
<body class="nuevo-body">
    <div class="container main-container mt-5">
        <div class="bg-opacity fondo-limitado">
          <h1 class="text-center mb-4">Nuevo Préstamo</h1>
          <form action="nuevo.php" method="POST" class="formulario-estrecho">
              <div class="mb-3">
                <label for="id_libro" class="form-label">Libro:</label>
                <select name="id_libro" id="id_libro" class="form-control">
                    <?php while ($libro = $libros->fetch_assoc()): ?>
                        <option value="<?php echo $libro['id']; ?>"><?php echo $libro['titulo']; ?></option>
                    <?php endwhile; ?>
                </select>
              </div>
              <div class="mb-3">
                  <label for="id_socio" class="form-label">Socio:</label>
                  <select name="id_socio" id="id_socio" class="form-control">
                      <?php while ($socio = $socios->fetch_assoc()): ?>
                          <option value="<?php echo $socio['id']; ?>"><?php echo $socio['nombre'] . ' ' . $socio['apellidos']; ?></option>
                      <?php endwhile; ?>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="fecha_prestamo" class="form-label">Fecha de préstamo:</label>
                  <input type="date" id="fecha_prestamo" name="fecha_prestamo" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="mb-3">
                  <label for="fecha_devolucion" class="form-label">Fecha de devolución:</label>
                  <input type="date" id="fecha_devolucion" name="fecha_devolucion" class="form-control">
              </div>
              <?php if (isset($mensajeError)): ?>
                  <p class="text-danger"><?php echo $mensajeError; ?></p>
              <?php endif; ?>
              <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary" style="background-color: #8c9390; border-color: #8c9390;">Crear préstamo</button>
              </div>
          </form>
          <div class="text-center mt-3">
          </div>
        </div>
    </div>
</body>
</html>
