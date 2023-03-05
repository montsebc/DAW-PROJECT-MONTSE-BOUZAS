<?php
require_once '../core/Model.php';

class Prestamo extends Model {
    private $id;
    private $idSocio;
    private $idLibro;
    private $fecha;

    public function __construct($idSocio = 0, $idLibro = 0, $fecha = '') {
        $this->idSocio = $idSocio;
        $this->idLibro = $idLibro;
        $this->fecha = $fecha;
    }

    public function getId() {
        return $this->id;
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

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function guardar() {
        $conexion = $this->connect();
        $query = "INSERT INTO prestamos (id_socio, id_libro, fecha) VALUES ($this->idSocio, $this->idLibro, '$this->fecha')";
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
            $prestamo = new Prestamo($fila['id_socio'], $fila['id_libro'], $fila['fecha']);
            $prestamo->setId($fila['id']);
            $prestamos[] = $prestamo;
        }
    
        $conexion->close();
    
        return $prestamos;
    }
    

    public function buscar($id) {
        $conexion = $this->connect();
        $query = "SELECT * FROM prestamos WHERE id = $id";
        $resultado = $conexion->query($query);

        $prestamo = $resultado->fetch_assoc();

        $conexion->close();

        return $prestamo;
    }

    public function eliminar($id) {
        $conexion = $this->connect();
        $query = "DELETE FROM prestamos WHERE id = $id";
        $resultado = $conexion->query($query);

        // Actualizar la cantidad de ejemplares disponibles del libro
        $query = "UPDATE libros SET cantidad_ejemplares = cantidad_ejemplares + 1 WHERE id = $this->idLibro";
        $resultado = $conexion->query($query);

        $conexion->close();
    }
}
