<!DOCTYPE html>
<html>
<head>
    <title>Devolución de préstamos</title>
</head>
<body>
    <h2>Listado de Préstamos</h2>
    <table>
        <tr>
            <th>Título del libro</th>
            <th>Autor del libro</th>
            <th>ID del socio</th>
            <th>Fecha de préstamo</th>
            <th>Fecha de devolución</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conectarse a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
        }

        // Verificar si se procesó el formulario de devolución
        if (isset($_POST['id_prestamo'])) {
            // Obtener el ID del préstamo
            $id_prestamo = $_POST['id_prestamo'];

            // Actualizar la base de datos
            $query = "UPDATE prestamos SET fecha_devolucion = CURRENT_TIMESTAMP WHERE id = $id_prestamo";
            $resultado = $conexion->query($query);

            // Verificar si se actualizó correctamente
            if ($resultado) {
                echo "El préstamo ha sido devuelto correctamente";
            } else {
                echo "Ocurrió un error al devolver el préstamo: " . $conexion->error;
            }
        }

        // Consulta SQL para obtener todos los préstamos
        $query = "SELECT p.*, l.titulo as titulo_libro, l.autor as autor_libro FROM prestamos p JOIN libros l ON p.id_libro = l.id";
        $resultado = $conexion->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Iterar a través de los resultados y mostrar cada préstamo en una fila de la tabla
            while ($prestamo = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $prestamo['titulo_libro'] . "</td>";
                echo "<td>" . $prestamo['autor_libro'] . "</td>";
                echo "<td>" . $prestamo['id_socio'] . "</td>";
                echo "<td>" . $prestamo['fecha_prestamo'] . "</td>";
                echo "<td>" . $prestamo['fecha_devolucion'] . "</td>";
                echo "<td>
                          <form method='post'>
                            <input type='hidden' name='id_prestamo' value='" . $prestamo['id'] . "'>
                            <input type='submit' value='Devolver'>
                          </form>
                     </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron préstamos</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </table>

    <button onclick="location.href='listar.php'">Volver al listado de préstamos</button>
