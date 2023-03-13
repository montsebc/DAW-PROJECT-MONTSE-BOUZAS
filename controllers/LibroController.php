<?php
require_once __DIR__ . "/../core/Model.php";

class Libro extends Model {
    protected $table = 'libros';
    protected $id;
    protected $titulo;
    protected $autor;
    protected $editorial;
    protected $isbn;
    protected $cantidad_ejemplares;
    protected $id_categoria;
    protected $estado;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function getCantidadEjemplares() {
        return $this->cantidad_ejemplares;
    }

    public function setCantidadEjemplares($cantidad_ejemplares) {
        $this->cantidad_ejemplares = $cantidad_ejemplares;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function agregar() {
        $query = "INSERT INTO {$this->table} (titulo, autor, editorial, isbn, cantidad_ejemplares, id_categoria) VALUES ('$this->titulo', '$this->autor', '$this->editorial', '$this->isbn', '$this->cantidad_ejemplares', '$this->id_categoria')";
        $this->conexion->query($query);
    }

    public function listar() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->conexion->query($query);

        $libros = array();
        while ($fila = $result->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setIsbn($fila['isbn']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $libro->setIdCategoria($fila['id_categoria']);
            $libro->setEstado($fila['estado']);

            $libros[] = $libro;
        }

        return $libros;
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = $id";
        $result = $this->conexion->query($query);
    
        if ($result->num_rows == 1) {
            $fila = $result->fetch_assoc();
            $this->setId($fila['id']);
            $this->setTitulo($fila['titulo']);
            $this->setAutor($fila['autor']);
            $this->setEditorial($fila['editorial']);
            $this->setIsbn($fila['isbn']);
            $this->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $this->setIdCategoria($fila['id_categoria']);
            $this->setEstado($fila['estado']);
        } else {
            throw new Exception('El libro no existe.');
        }
    }
    
    public function actualizar() {
        $query = "UPDATE {$this->table} SET titulo = '{$this->titulo}', autor = '{$this->autor}', editorial = '{$this->editorial}', isbn = '{$this->isbn}', cantidad_ejemplares = '{$this->cantidad_ejemplares}', id_categoria = '{$this->id_categoria}', estado = '{$this->estado}' WHERE id = '{$this->id}'";
        $this->conexion->query($query);
    }
    
    public function listarDisponibles() {
        $query = "SELECT * FROM {$this->table} WHERE cantidad_ejemplares > 0 AND estado = 'disponible'";
        $result = $this->conexion->query($query);
    
        $libros = array();
        while ($fila = $result->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setIsbn($fila['isbn']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $libro->setIdCategoria($fila['id_categoria']);
            $libro->setEstado($fila['estado']);
    
            $libros[] = $libro;
        }
    
        return $libros;
    }
    
    public function buscarPorTitulo($titulo) {
        $query = "SELECT * FROM {$this->table} WHERE titulo LIKE '%$titulo%'";
        $result = $this->conexion->query($query);
    
        $libros = array();
        while ($fila = $result->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setIsbn($fila['isbn']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $libro->setIdCategoria($fila['id_categoria']);
            $libro->setEstado($fila['estado']);
    
            $libros[] = $libro;
        }
    
        return $libros;
    }
}
?>