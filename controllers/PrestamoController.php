<?php
require_once __DIR__ . "/../models/Prestamo.php";
require_once __DIR__ . "/../models/Libro.php";
require_once __DIR__ . "/../models/Socio.php";

class PrestamoController {
    protected $table = 'prestamos';

    protected $id;
    protected $id_libro;
    protected $id_socio;
    protected $fecha_prestamo;
    protected $fecha_devolucion;

    public function __construct($id_libro = '', $id_socio = '') {
        $this->id_libro = $id_libro;
        $this->id_socio = $id_socio;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdLibro() {
        return $this->id_libro;
    }

    public function setIdLibro($id_libro) {
        $this->id_libro = $id_libro;
    }

    public function getIdSocio() {
        return $this->id_socio;
    }

    public function setIdSocio($id_socio) {
        $this->id_socio = $id_socio;
    }

    public function getFechaPrestamo() {
        return $this->fecha_prestamo;
    }

    public function setFechaPrestamo($fecha_prestamo) {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    public function getFechaDevolucion() {
        return $this->fecha_devolucion;
    }

    public function setFechaDevolucion($fecha_devolucion) {
        $this->fecha_devolucion = $fecha_devolucion;
    }
    public function guardar() {
        $fecha_prestamo = date("Y-m-d H:i:s");
        $fecha_devolucion = date("Y-m-d H:i:s", strtotime('+30 days'));
    
        $query = "INSERT INTO prestamos (id_libro, id_socio, fecha_prestamo, fecha_devolucion) VALUES ('{$this->id_libro}', '{$this->id_socio}', '{$fecha_prestamo}', '{$fecha_devolucion}')";
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
    }
    
    public static function listar($conexion) {
        $table = 'prestamos';
        $query = "SELECT * FROM {$table}";
        $result = $conexion->query($query);
    
        $prestamos = array();
        while ($fila = $result->fetch_assoc()) {
            $prestamo = new Prestamo();
            $prestamo->setId($fila['id']);
            $prestamo->setIdLibro($fila['id_libro']);
            $prestamo->setIdSocio($fila['id_socio']);
            $prestamo->setFechaPrestamo($fila['fecha_prestamo']);
            $prestamo->setFechaDevolucion($fila['fecha_devolucion']);
            $prestamos[] = $prestamo;
        }
        $conexion->close();
        return $prestamos;
    }
    
    
    
    public function buscarPorId() {
        $query = "SELECT * FROM {$this->table} WHERE id = {$this->id}";
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        $result = $conexion->query($query);
    
        if ($result->num_rows == 1) {
            $fila = $result->fetch_assoc();
            $prestamo = new Prestamo();
            $prestamo->setId($fila['id']);
            $prestamo->setIdLibro($fila['id_libro']);
            $prestamo->setIdSocio($fila['id_socio']);
            $prestamo->setFechaPrestamo($fila['fecha_prestamo']);
            $prestamo->setFechaDevolucion($fila['fecha_devolucion']);
        } else {
            throw new Exception('El préstamo no existe.');
        }
    }
    
    
    
    
    public function actualizar() {
        $query = "UPDATE {$this->table} SET id_libro = '{$this->id_libro}', id_socio = '{$this->id_socio}', fecha_prestamo = '{$this->fecha_prestamo}', fecha_devolucion = '{$this->fecha_devolucion}' WHERE id = '{$this->id}'";
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
    }
    
    public function eliminar() {
        $query = "DELETE FROM {$this->table} WHERE id = {$this->id}";
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
    }
    
    
    
}

?>
