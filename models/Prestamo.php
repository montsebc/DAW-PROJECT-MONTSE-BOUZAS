<?php

class Prestamo {

    private $conexion;

    function __construct() {
        $this->conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }

    function listar_prestamos() {
        $query = "SELECT p.*, l.titulo as titulo_libro, l.autor as autor_libro FROM prestamos p JOIN libros l ON p.id_libro = l.id";
        $resultado = $this->conexion->query($query);
        if ($resultado->num_rows > 0) {
            $prestamos = array();
            while ($prestamo = $resultado->fetch_assoc()) {
                $prestamos[] = $prestamo;
            }
            return $prestamos;
        } else {
            return array();
        }
    }

    function nuevo_prestamo($id_socio, $id_libro, $fecha_prestamo) {
        $fecha_devolucion = date('Y-m-d', strtotime($fecha_prestamo . '+ 7 days'));

        // Consulta SQL para obtener el número de préstamos activos del socio
        $query = "SELECT COUNT(*) AS num_prestamos FROM prestamos WHERE id_socio = $id_socio AND fecha_devolucion IS NULL";
        $resultado = $this->conexion->query($query);
        $num_prestamos = $resultado->fetch_assoc()['num_prestamos'];

        // Verificar si el socio puede tomar más préstamos
        $query = "SELECT max_libros_prestados FROM socios WHERE id = $id_socio";
        $resultado = $this->conexion->query($query);
        $max_libros_prestados = $resultado->fetch_assoc()['max_libros_prestados'];
        if ($num_prestamos >= $max_libros_prestados) {
            return "El socio ya tiene $num_prestamos préstamos activos y no puede tomar más.";
        }

        // Consulta SQL para obtener la cantidad de ejemplares del libro
        $query = "SELECT cantidad_ejemplares FROM libros WHERE id = $id_libro";
        $resultado = $this->conexion->query($query);

        $cantidad_ejemplares = $resultado->fetch_assoc()['cantidad_ejemplares'];

        // Verificar si hay suficientes ejemplares del libro
        if ($cantidad_ejemplares <= 0) {
            return "No hay ejemplares disponibles del libro seleccionado.";
        }

        // Preparar la consulta SQL para insertar el nuevo préstamo
        $query = "INSERT INTO prestamos (id_libro, id_socio, fecha_prestamo, fecha_devolucion) VALUES ($id_libro, $id_socio, '$fecha_prestamo', '$fecha_devolucion')";
        
        // Actualizar la cantidad de ejemplares del libro
        $cantidad_ejemplares--;
        $query_update_libro = "UPDATE libros SET cantidad_ejemplares = $cantidad_ejemplares";
        if ($cantidad_ejemplares == 0) {
            $query_update_libro .= ", estado = 'no disponible'";
        }
        $query_update_libro .= " WHERE id = $id_libro";
        $this->conexion->query($query_update_libro);

        // Ejecutar la consulta SQL y devolver el mensaje de éxito o error
        if ($this->conexion->query($query)=== TRUE) {
            return "Préstamo agregado correctamente";
} else {
return "Error al agregar el préstamo: " . $this->conexion->error;
}

    // Cerrar la conexión a la base de datos
    $this->conexion->close();
}

// Función para devolver un préstamo
public function devolverPrestamo($id_prestamo) {
    // Actualizar la base de datos
    $query = "UPDATE prestamos SET fecha_devolucion = CURRENT_TIMESTAMP WHERE id = $id_prestamo";
    $resultado = $this->conexion->query($query);

    // Verificar si se actualizó correctamente
    if ($resultado) {
        return "El préstamo ha sido devuelto correctamente";
    } else {
        return "Ocurrió un error al devolver el préstamo: " . $this->conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $this->conexion->close();
}
}

?>
