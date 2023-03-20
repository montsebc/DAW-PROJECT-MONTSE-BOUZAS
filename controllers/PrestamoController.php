<?php
require_once __DIR__ . "/../models/Prestamo.php";

class PrestamoController {
    private $prestamo;

    public function __construct() {
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        $this->prestamo = new Prestamo($conexion);
    }

    public function listarPrestamos() {
        return $this->prestamo->listarPrestamos();
    }
    public function listarPrestamosDevueltos() {
        $prestamos = $this->prestamo->listarPrestamosDevueltos();
        return $prestamos;
    }
    
    
    
    public function listarPrestamosFiltrados($socio, $titulo, $fecha_prestamo) {
        // Si los valores de los filtros son null, llamar a la función sin filtros
        if ($socio === null && $titulo === null && $fecha_prestamo === null) {
            return $this->prestamo->listarPrestamos();
        }
        
        // Si se ha seleccionado la opción "Todos los libros", cambiar el valor de $titulo a null
        if ($titulo === '') {
            $titulo = null;
        }
        
        // Si se ha seleccionado la opción "Todos los socios", cambiar el valor de $socio a null
        if ($socio === '') {
            $socio = null;
        }
    
        // Construir la consulta con los filtros correspondientes
        $resultado = $this->prestamo->listarPrestamos($socio, $titulo, $fecha_prestamo);
        
        return $resultado;
    }
    
    
    
    

    public function listarLibrosDisponibles() {
        $conexion = $this->prestamo->getConexion();
    
        $query = "SELECT * FROM libros WHERE cantidad_ejemplares > 0 ORDER BY titulo";
        $resultado = $conexion->query($query);
    
        return $resultado;
    }
    

    public function listarSocios() {
        return $this->prestamo->listarSocios();
    }
    public function devolverPrestamo($id) {
        return $this->prestamo->devolverPrestamo($id);
        
    }
    

    private function contarPrestamosActivosPorSocio($conexion, $id_socio) {
        $sql = "SELECT COUNT(*) as total_prestamos FROM prestamos WHERE id_socio = ? AND devuelto = 0";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_socio);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        return $row['total_prestamos'];
    }
    
    

    public function crearPrestamo($id_libro, $id_socio, $fecha_prestamo, $fecha_devolucion) {
        $conexion = $this->prestamo->getConexion();
    
        // Contar la cantidad de libros en préstamo por el socio
        $total_prestamos = $this->contarPrestamosActivosPorSocio($conexion, $id_socio);
    
        // Obtener información sobre el libro
        $query_libro = "SELECT cantidad_ejemplares FROM libros WHERE id = ?";
        $stmt_libro = $conexion->prepare($query_libro);
        $stmt_libro->bind_param("i", $id_libro);
        $stmt_libro->execute();
        $result_libro = $stmt_libro->get_result();
        $row_libro = $result_libro->fetch_assoc();
        $cantidad_ejemplares = $row_libro['cantidad_ejemplares'];
        $stmt_libro->close();
    
        // Verificar las condiciones y crear el préstamo si se cumplen
        if ($total_prestamos < 3 && $cantidad_ejemplares > 0) {
            $query = "INSERT INTO prestamos (id_libro, id_socio, fecha_prestamo, fecha_devolucion) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("iiss", $id_libro, $id_socio, $fecha_prestamo, $fecha_devolucion);
            $stmt->execute();
            $stmt->close();
    
            // Actualizar la cantidad de ejemplares y el estado del libro
            $query_update = "UPDATE libros SET cantidad_ejemplares = cantidad_ejemplares - 1, estado = IF(cantidad_ejemplares - 1 > 0, 'disponible', 'no disponible') WHERE id = ?";
            $stmt_update = $conexion->prepare($query_update);
            $stmt_update->bind_param("i", $id_libro);
            $stmt_update->execute();
            $stmt_update->close();
            return true;
        } else {
            return false;
        }
    }
    
    
    
    public function obtenerLibroPorId($id) {
        $conexion = $this->prestamo->getConexion();
    
        $consulta = "SELECT titulo, autor FROM libros WHERE id = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->bind_param('i', $id);
        $sentencia->execute();
        $resultado = $sentencia->get_result();
    
        $libro = $resultado->fetch_assoc();
    
        $sentencia->close();
    
        return $libro;
    }
    

    
    
}
?>
