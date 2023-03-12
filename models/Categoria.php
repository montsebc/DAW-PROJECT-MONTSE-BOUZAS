<?php
require_once(__DIR__ . '/../core/Model.php');

class Categoria extends Model {
    private $id;
    private $nombre;

    // getters y setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // métodos de base de datos

    public function guardar() {
        $sql = "INSERT INTO categorias (nombre) VALUES ('{$this->getNombre()}')";
        $guardado = $this->conexion->query($sql);

        $resultado = false;
        if ($guardado) {
            $resultado = true;
        }
        return $resultado;
    }

    public function editar() {
        $sql = "UPDATE categorias SET nombre='{$this->getNombre()}' WHERE id={$this->getId()}";
        $editado = $this->conexion->query($sql);

        $resultado = false;
        if ($editado) {
            $resultado = true;
        }
        return $resultado;
    }


    public function listar() {
        $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
        $categorias = $this->conexion->query($sql);
        return $categorias;
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id={$id}";
        $categoria = $this->conexion->query($sql)->fetch_assoc();

        $this->setId($categoria['id']);
        $this->setNombre($categoria['nombre']);
    }
}
?>
