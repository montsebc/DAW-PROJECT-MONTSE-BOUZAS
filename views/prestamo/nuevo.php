<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Préstamo</title>
</head>
<body>
    <h2>Nuevo Préstamo</h2>
    <form action="" method="POST">
        <label for="socio">Socio:</label>
        <select name="socio" id="socio">
            <?php
            // Conectarse a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'booking a book');
            if ($conexion->connect_error) {
              die('Error de conexión: ' . $conexion->connect_error);
            }

            // Consulta SQL para obtener todos los socios
            $query = "SELECT * FROM socios";
            $resultado = $conexion->query($query);

            // Verificar si se obtuvieron resultados
            if ($resultado->num_rows > 0) {
                // Iterar a través de los resultados y agregar cada socio a la lista desplegable
                while ($socio = $resultado->fetch_assoc()) {
                    echo "<option value='" . $socio['id'] . "'>" . $socio['nombre'] . " " . $socio['apellidos'] . "</option>";
                }
            } else {
                echo "<option value=''>No se encontraron socios</option>";
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>
        </select>
        <br>
        <label for="libro">Libro:</label>
        <select name="libro" id="libro">
       
            <?php
            // Conectarse a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'booking a book');
            if ($conexion->connect_error) {
              die('Error de conexión: ' . $conexion->connect_error);
            }

            // Consulta SQL para obtener todos los libros disponibles
            $query = "SELECT * FROM libros WHERE cantidad_ejemplares > 0 AND estado = 'disponible'";
            $resultado = $conexion->query($query);

            // Verificar si se obtuvieron resultados
            if ($resultado->num_rows > 0) {
                // Iterar a través de los resultados y agregar cada libro a la lista desplegable
                while ($libro = $resultado->fetch_assoc()) {
                    echo "<option value='" . $libro['id'] . "'>" . $libro['titulo'] . " - " . $libro['autor'] . "</option>";
                }
            } else {
                echo "<option value=''>No se encontraron libros disponibles</option>";
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>
        </select>
        <br>
        <label for="fecha_prestamo">Fecha de préstamo:</label>
        <input type="date" name="fecha_prestamo" required>
        <br>
        <input type="submit" name="guardar" value="Guardar">
    </form>
    <button onclick="location.href='listar.php'">Cancelar</button>

    <?php
    // Verificar si se recibieron datos del formulario
    if (isset($_POST['guardar'])) {
        // Obtener los datos del formulario
        $id_socio = $_POST['socio'];
        $id_libro = $_POST['libro'];
        $fecha_prestamo = $_POST['fecha_prestamo'];
        $fecha_devolucion = date('Y-m-d', strtotime($fecha_prestamo . '+ 7 days'));

        // Conectarse a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($conexion->connect_error) {
          die('Error de conexión: ' . $conexion->connect_error);
        }

        // Consulta SQL para obtener el número de préstamos activos del socio
        $query = "SELECT COUNT(*) AS num_prestamos FROM prestamos WHERE id_socio = $id_socio AND fecha_devolucion IS NULL";
        $resultado = $conexion->query($query);
        $num_prestamos = $resultado->fetch_assoc()['num_prestamos'];

        // Verificar si el socio puede tomar más préstamos
        $query = "SELECT max_libros_prestados FROM socios WHERE id = $id_socio";
        $resultado = $conexion->query($query);
        $max_libros_prestados = $resultado->fetch_assoc()['max_libros_prestados'];
        if ($num_prestamos >= $max_libros_prestados) {
            echo "<script>alert('El socio ya tiene $num_prestamos préstamos activos y no puede tomar más.');</script>";
        } else {
            // Consulta SQL para obtener la cantidad de ejemplares del libro
            $query = "SELECT cantidad_ejemplares FROM libros WHERE id = $id_libro";
            $resultado = $conexion->query($query);

            $cantidad_ejemplares = $resultado->fetch_assoc()['cantidad_ejemplares'];
            
            // Verificar si hay suficientes ejemplares del libro
            if ($cantidad_ejemplares <= 0) {
            echo "<script>alert('No hay ejemplares disponibles del libro seleccionado.');</script>";
            } else {
            // Preparar la consulta SQL para insertar el nuevo préstamo
            $query = "INSERT INTO prestamos (id_libro, id_socio, fecha_prestamo, fecha_devolucion) VALUES ($id_libro, $id_socio, '$fecha_prestamo', '$fecha_devolucion')";
            // Actualizar la cantidad de ejemplares del libro
$cantidad_ejemplares--;
$query_update_libro = "UPDATE libros SET cantidad_ejemplares = $cantidad_ejemplares";
if ($cantidad_ejemplares == 0) {
    $query_update_libro .= ", estado = 'no disponible'";
}
$query_update_libro .= " WHERE id = $id_libro";
$conexion->query($query_update_libro);

// Ejecutar la consulta SQL y mostrar la alerta
if ($conexion->query($query) === TRUE) {
    echo "<script>alert('Préstamo agregado correctamente');</script>";
} else {
    echo "<script>alert('Error al agregar el préstamo: ".$conexion->error."');</script>";
}
}

// Cerrar la conexión a la base de datos
$conexion->close();
}
}
?>

<button onclick="location.href='listar.php'">Volver al listado de préstamos</button>
<button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>

</body>
</html>

    