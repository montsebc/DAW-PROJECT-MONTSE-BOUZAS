<?php

require_once __DIR__ . "/../core/Model.php";

class Categoria extends Model {
    private $id;
    private $nombre;

    public function __construct($nombre = '') {
        $this->nombre = $nombre;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function agregar() {
        $conexion = $this->connect();
        $query = "INSERT INTO categorias (nombre) VALUES ('$this->nombre')";
        $resultado = $conexion->query($query);

        return $resultado;
    }

    public function actualizar() {
        $conexion = $this->connect();
        $query = "UPDATE categorias SET nombre='$this->nombre' WHERE id=$this->id";
        $resultado = $conexion->query($query);

        return $resultado;
    }

    public function eliminar() {
        $conexion = $this->connect();
        $query = "DELETE FROM categorias WHERE id=$this->id";
        $resultado = $conexion->query($query);

        return $resultado;
    }

    public function listar() {
        $conexion = $this->connect();
        $query = "SELECT * FROM categorias";
        $resultado = $conexion->query($query);

        $categorias = array();
        while ($categoria = $resultado->fetch_assoc()) {
            $categorias[] = $categoria;
        }

        return $categorias;
    }

    public function buscar($nombre) {
        $conexion = $this->connect();
        $query = "SELECT * FROM categorias WHERE nombre LIKE '%$nombre%'";
        $resultado = $conexion->query($query);

        $categorias = array();
        while ($categoria = $resultado->fetch_assoc()) {
            $categorias[] = $categoria;
        }

        return $categorias;
    }

    public function buscarPorId($id) {
        $conexion = $this->connect();
        $query = "SELECT * FROM categorias WHERE id=$id";
        $resultado = $conexion->query($query);

        $categoria = $resultado->fetch_assoc();

        return $categoria;
    }
    public function setId($id) {
        $this->id = $id;
    }
   
    public function guardar() {
        $query = "INSERT INTO categorias (nombre) VALUES ('$this->nombre')";
        $this->conexion->query($query);
    }
    
}
?>
