<?php
require_once __DIR__ . '/../core/Model.php';

class Prestamo extends Model {
    private $id;
    private $idSocio;
    private $idLibro;
    private $fechaPrestamo;
    private $fechaDevolucion;
    private $libro;
    private $devuelto;

    public function setConexion($conexion) {
        $this->conexion = $conexion;
    }

    public function __construct($idSocio = 0, $idLibro = 0, $fechaPrestamo = '', $fechaDevolucion = '') {
        $this->idSocio = $idSocio;
        $this->idLibro = $idLibro;
        $this->fechaPrestamo = $fechaPrestamo;
        $this->fechaDevolucion = $fechaDevolucion;
    }

    public function setLibro($libro) {
        $this->libro = $libro;
    }

    public function getLibro() {
        return $this->libro;
    }

    public function setFechaPrestamo($fechaPrestamo) {
        $this->fechaPrestamo = $fechaPrestamo;
    }

    public function getFechaPrestamo() {
        return $this->fechaPrestamo;
    }

    public function setFechaDevolucion($fechaDevolucion) {
        $this->fechaDevolucion = $fechaDevolucion;
    }

    public function getFechaDevolucion() {
        return $this->fechaDevolucion;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdSocio($idSocio) {
        $this->idSocio = $idSocio;
    }

    public function getIdSocio() {
        return $this->idSocio;
    }

    public function setIdLibro($idLibro) {
        $this->idLibro = $idLibro;
    }

    public function getIdLibro() {
        return $this->idLibro;
    }

    public function setDevuelto($devuelto) {
        $this->devuelto = $devuelto;
    }

    public function getDevuelto() {
        return $this->devuelto;
    }

    public function guardar() {
        $conexion = $this->connect();
        $query = "INSERT INTO prestamos (id_socio, id_libro, fecha_prestamo, fecha_devolucion) VALUES ($this->idSocio, $this->idLibro, '$this->fechaPrestamo', '$this->fechaDevolucion')";
        $resultado = $conexion->query($query);

        // Actualizar la cantidad de ejemplares disponibles del libro
        $query = "UPDATE libros SET cantidad_ejemplares = cantidad_ejemplares - 1 WHERE id = $this->idLibro";
        $resultado = $conexion->query($query);

        $conexion->close();
    }

    public function listar() {
        $conexion = $this->connect();
        $query = "SELECT * FROM prestamos";
        $resultado = $conexion->query($query);
    
        $prestamos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $prestamo = new Prestamo($fila['id_socio'], $fila['id_libro'], $fila['fechaPrestamo'], $fila['fechaDevolucion']);
            $prestamo->setId($fila['id']);
            $prestamos[] = $prestamo;
        }
    
        $conexion->close();
    
        return $prestamos;
    }

    public function actualizar() {
        $conexion = $this->connect();
        $query = "UPDATE prestamos SET id_socio = $this->idSocio, id_libro = $this->idLibro, fechaPrestamo = $this->fechaPrestamo, fechaDevolucion = $this->fechaDevolucion WHERE id = $this->id";
        $resultado = $conexion->query($query);

        $conexion->close();
    }

    public function devolver() {
        $conexion = $this->connect();
        $query = "UPDATE prestamos SET fechaDevolucion = '$this->fechaDevolucion' WHERE id = $this->id";
        $resultado = $conexion->query($query);

        $conexion->close();
    }
    public function buscar($id) {
        $conexion = $this->connect();
        $query = "SELECT * FROM prestamos WHERE id = $id";
        $resultado = $conexion->query($query);
    
        $fila = $resultado->fetch_assoc();
    
        $prestamo = new Prestamo();
        $prestamo->setId($fila['id']);
        $prestamo->setIdSocio($fila['id_socio']);
        $prestamo->setIdLibro($fila['id_libro']);
        $prestamo->setFechaPrestamo($fila['fechaPrestamo']);
        $prestamo->setFechaDevolucion($fila['fechaDevolucion']);
    
        $conexion->close();
    
        return $prestamo;
    }
    
}
?>
