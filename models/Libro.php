<?php
require_once '../core/Model.php';

class Libro extends Model {
    private $id;
    private $titulo;
    private $autor;
    private $editorial;
    private $anio_publicacion;
    private $cantidad_ejemplares;
    private $categoria_id;

    public function __construct($titulo = '', $autor = '', $editorial = '', $anio_publicacion = '', $cantidad_ejemplares = '') {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->anio_publicacion = $anio_publicacion;
        $this->cantidad_ejemplares = $cantidad_ejemplares;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getEditorial() {
        return $this->editorial;
    }

    public function setEditorial($editorial) {
        $this->editorial = $editorial;
    }

    public function getAnioPublicacion() {
        return $this->anio_publicacion;
    }

    public function setAnioPublicacion($anio_publicacion) {
        $this->anio_publicacion = $anio_publicacion;
    }

    public function getCantidadEjemplares() {
        return $this->cantidad_ejemplares;
    }

    public function setCantidadEjemplares($cantidad_ejemplares) {
        $this->cantidad_ejemplares = $cantidad_ejemplares;
    }

    public function agregar() {
        $conexion = $this->connect();
        $query = "INSERT INTO libros (titulo, autor, editorial, anio_publicacion, cantidad_ejemplares) VALUES ('$this->titulo', '$this->autor', '$this->editorial', '$this->anio_publicacion', '$this->cantidad_ejemplares')";
        $resultado = $conexion->query($query);
    }
    public function listar() {
        $conexion = $this->connect();
        $query = "SELECT * FROM libros";
        $resultado = $conexion->query($query);
    
        $libros = array();
        while ($fila = $resultado->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setAnioPublicacion($fila['anio_publicacion']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
    
            $libros[] = $libro;
        }
    
        return $libros;
    }
    
    public function buscarPorId() {
        $conexion = $this->connect();
        $query = "SELECT * FROM libros WHERE id = '$this->id'";
        $resultado = $conexion->query($query);
    
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $this->setTitulo($fila['titulo']);
            $this->setAutor($fila['autor']);
            $this->setEditorial($fila['editorial']);
            $this->setAnioPublicacion($fila['anio_publicacion']);
            $this->setCantidadEjemplares($fila['cantidad_ejemplares']);
        }
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function buscar($titulo) {
        $conexion = $this->connect();
        $query = "SELECT * FROM libros WHERE titulo LIKE '%$titulo%'";
        $resultado = $conexion->query($query);
    
        $libros = array();
        while ($fila = $resultado->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setAnioPublicacion($fila['anio_publicacion']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
    
            $libros[] = $libro;
        }
    
        return $libros;
    }
    
    public function actualizar() {
        $conexion = $this->connect();
        $query = "UPDATE libros SET titulo = '$this->titulo', autor = '$this->autor', editorial = '$this->editorial', anio_publicacion = '$this->anio_publicacion', cantidad_ejemplares = '$this->cantidad_ejemplares' WHERE id = '$this->id'";
        $resultado = $conexion->query($query);
    }
    
    public function eliminar() {
        $conexion = $this->connect();
        $query = "DELETE FROM libros WHERE id = '$this->id'";
        $resultado = $conexion->query($query);
    }
    

    public function getCategoriaId() {
    return $this->categoria_id;
}

    public function setCategoriaId($categoria_id) {
    $this->categoria_id = $categoria_id;
}
}
?>
