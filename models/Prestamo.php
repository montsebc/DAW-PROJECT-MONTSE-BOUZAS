<?php
require_once __DIR__ . "/../core/Model.php";

class Prestamo extends Model {
    public function getConexion() {
        return $this->conexion;
    }
    
    public function __construct($conexion) {
        parent::__construct($conexion);
    }
    
    public function listarSocios() {
        $this->connect();
        $query = "SELECT * FROM socios";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

    public function listarPrestamos($socio = null, $titulo = null, $fecha_prestamo = null) {
        $query = "SELECT 
        p.id, 
        p.id_libro, 
        p.id_socio, 
        p.fecha_prestamo, 
        p.fecha_devolucion, 
        p.entrega_anticipada, 
        l.titulo, 
        l.autor, 
        s.nombre, 
        s.apellidos, 
l.cantidad_ejemplares - SUM(IF(p.devuelto = 0, 1, 0)) AS ejemplares_disponibles
    FROM prestamos p
    JOIN libros l ON p.id_libro = l.id
    JOIN socios s ON p.id_socio = s.id
    WHERE p.devuelto = 0";
    
        if ($socio !== null) {
            $query .= " AND CONCAT(s.nombre, ' ', s.apellidos) = '$socio'";
        }
    
        if ($titulo !== null) {
            $query .= " AND l.titulo = '$titulo'";
        }
    
        if ($fecha_prestamo !== null) {
            $query .= " AND p.fecha_prestamo = '$fecha_prestamo'";
        }
    
        $query .= " GROUP BY p.id_libro, p.id_socio, p.fecha_prestamo";
    
        $result = $this->conexion->query($query);
    
        return $result;
    }
    
    
    

    function listarPrestamosDevueltos($socio = null, $titulo = null, $fecha_prestamo = null) {
    $this->connect();
    $query = "SELECT p.id, l.titulo, l.autor, s.nombre, s.apellidos, p.fecha_prestamo, p.fecha_devolucion, IF(p.entrega_anticipada IS NULL OR p.entrega_anticipada = '', 'No', p.entrega_anticipada) as entrega_anticipada 
              FROM prestamos p 
              JOIN libros l ON p.id_libro = l.id 
              JOIN socios s ON p.id_socio = s.id 
              WHERE p.devuelto = 1 AND (p.fecha_devolucion IS NOT NULL OR p.fecha_devolucion = '')";

    // Agregar condición para filtrar por título
    if ($titulo !== null) {
        if ($titulo === 'Todos') {
            $query .= '';
        } else {
            $query .= " AND l.titulo = '$titulo'";
        }
    }

        
    // Añadir ordenación por ID
    $query .= " ORDER BY p.id";
    $resultado = $this->conexion->query($query);
    
    return $resultado;
}

    
    
    public function listarLibrosDisponibles() {
        $this->connect();
        $query = "SELECT * FROM libros WHERE cantidad_ejemplares > 0 AND estado = 'disponible'";
        $resultado = $this->conexion->query($query);
        return $resultado;
    }

    public function crearPrestamo($id, $id_socio, $fecha_prestamo = null, $fecha_devolucion = null) {
        
        // Definir las fechas predeterminadas
        if ($fecha_prestamo == null) {
            $fecha_prestamo = date('Y-m-d');
        }
        if ($fecha_devolucion == null) {
            $fecha_devolucion = date('Y-m-d', strtotime($fecha_prestamo . ' +14 days'));
        }
        var_dump($fecha_prestamo); 
        $entrega_anticipada = NULL;
    
        // Contar la cantidad de libros en préstamo por el socio
        $this->connect();
        $total_prestamos = $this->contarPrestamosActivosPorSocio($id_socio);
    
        // Obtener información sobre el libro
        $query_libro = "SELECT cantidad_ejemplares FROM libros WHERE id = ?";
        $stmt_libro = $this->conexion->prepare($query_libro);
        $stmt_libro->bind_param("i", $id);
        $stmt_libro->execute();
        $result_libro = $stmt_libro->get_result();
        $row_libro = $result_libro->fetch_assoc();
        $cantidad_ejemplares = $row_libro['cantidad_ejemplares'];
        $stmt_libro->close();

        
    
        // Verificar las condiciones y crear el préstamo si se cumplen
        if ($total_prestamos < 3 && $cantidad_ejemplares > 0) {
            $query = "INSERT INTO prestamos (id, id_socio, fecha_prestamo, fecha_devolucion, entrega_anticipada) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bind_param("iisss", $id, $id_socio, $fecha_prestamo, $fecha_devolucion, $entrega_anticipada);
            $stmt->execute();
            $stmt->close();
    
            // Actualizar la cantidad de ejemplares y el estado del libro
            $query_update = "UPDATE libros SET cantidad_ejemplares = cantidad_ejemplares - 1, estado = IF(cantidad_ejemplares - 1 > 0, 'disponible', 'no disponible') WHERE id = ?";
            $stmt_update = $this->conexion->prepare($query_update);
            $stmt_update->bind_param("i", $id);
            $stmt_update->execute();
            $stmt_update->close();
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    function devolverPrestamo($id) {
        $this->connect();
        $query = "SELECT id, id_libro FROM prestamos WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id_libro = $row['id_libro'];
        $stmt->close();
    
        if (isset($id)) {
            $query2 = "UPDATE libros SET estado = IF(cantidad_ejemplares > 0, 'disponible', 'no disponible'), cantidad_ejemplares = cantidad_ejemplares + 1 WHERE id = ?";
            $stmt2 = $this->conexion->prepare($query2);
            $stmt2->bind_param("i", $id_libro);
            $stmt2->execute();
            $stmt2->close();
    
            $query3 = "UPDATE prestamos SET devuelto = 1, fecha_devolucion = CURRENT_DATE, entrega_anticipada = IF(CURRENT_DATE < fecha_devolucion, CURRENT_DATE, 'No') WHERE id = ?";
            $stmt3 = $this->conexion->prepare($query3);
            $stmt3->bind_param("i", $id);
            $stmt3->execute();
            $stmt3->close();
            
            // Actualizar la lista de préstamos
            $this->listarPrestamos();
        }
    }
    
    

    


    public function contarPrestamosActivosPorSocio($id_socio) {
        $this->connect();
        $sql = "SELECT COUNT(*) as total_prestamos FROM prestamos WHERE id_socio = ? AND devuelto = 0";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_socio);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        return $row['total_prestamos'];
    }

    function calcularFechaDevolucion($fecha_prestamo) {
        $diasPrestamo = 14; // Establece la cantidad de días que dura el préstamo
        $fecha_prestamo_obj = new DateTime($fecha_prestamo);
        $fecha_prestamo_obj->modify("+$diasPrestamo days");
        return $fecha_prestamo_obj->format('Y-m-d');
    }
    
    
    function confirmarDevolucion($id_prestamo) {
        echo "<script>";
        echo "if (confirm('¿Está seguro de que desea devolver este préstamo?')) {";
        echo "document.getElementById('devolver-form-$id_prestamo').submit();";
        echo "}";
        echo "</script>";
    }
    
    }
    

    
    


?>