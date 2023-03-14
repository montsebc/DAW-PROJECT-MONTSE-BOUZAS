<!DOCTYPE html>
<html>
<head>
    <title>Listado de Libros</title>
</head>
<body>
    <h2>Listado de Libros</h2>
    <table>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Cantidad de Ejemplares</th>
            <th>Estado</th>
            <th>Fecha de Disponibilidad</th>
        </tr>
        <?php
        // Conectarse a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
        }

        // Consulta SQL para obtener todos los libros
        $query = "SELECT * FROM libros";
        $resultado = $conexion->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Iterar a través de los resultados y mostrar cada libro en una fila de la tabla
            while ($libro = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $libro['titulo'] . "</td>";
                echo "<td>" . $libro['autor'] . "</td>";
                echo "<td>" . $libro['editorial'] . "</td>";
                echo "<td>" . $libro['cantidad_ejemplares'] . "</td>";
                echo "<td>" . $libro['estado'] . "</td>";
                echo "<td>";
                if ($libro['estado'] == 'disponible') {
                    echo "inmediata";
                } else {
                    echo $libro['fecha_disponible'];
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron libros</td></tr>";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </table>
    <button onclick="location.href='../libro/agregar.php'">Agregar Libro</button>
    <button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>
