<?php
require_once __DIR__ . "/../core/Model.php";

class Libro extends Model {
    private $id;
    private $titulo;
    private $autor;
    private $editorial;
    private $isbn;
    private $cantidad_ejemplares;
    private $id_categoria;
    private $estado;
    protected $conexion;

    public function setConexion($conexion) {
        $this->conexion = $conexion;
    }

    public function __construct($titulo = '', $autor = '', $editorial = '', $isbn = '', $cantidad_ejemplares = '') {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->isbn = $isbn;
        $this->cantidad_ejemplares = $cantidad_ejemplares;
    }
    public function setId($id) {
        $this->id = $id;
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
        $conexion = $this->connect();
        $query = "INSERT INTO libros (titulo, autor, editorial, isbn, cantidad_ejemplares, id_categoria) VALUES ('$this->titulo', '$this->autor', '$this->editorial', '$this->isbn', '$this->cantidad_ejemplares', '$this->id_categoria')";
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
            $libro->setIsbn($fila['isbn']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $libro->setIdCategoria($fila['id_categoria']);
            $libro->setEstado($fila['estado']);

            $libros[] = $libro;
        }

        return $libros;
    }
    
    public function buscarPorId($id) {
        $conexion = $this->connect();
        $query = "SELECT * FROM libros WHERE id = $id";
        $resultado = $conexion->query($query);
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $this->setId($fila['id']);
            $this->setTitulo($fila['titulo']);
            $this->setAutor($fila['autor']);
            $this->setEditorial($fila['editorial']);
            $this->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $this->setIsbn($fila['isbn']);
            $this->setIdCategoria($fila['id_categoria']);
            $this->setEstado($fila['estado']);
        }
    }
    
    public function listarPorCategoria($id_categoria) {
        $conexion = $this->connect();
        $query = "SELECT * FROM libros WHERE id_categoria = $id_categoria";
        $resultado = $conexion->query($query);

        $libros = array();
        while ($fila = $resultado->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($fila['id']);
            $libro->setTitulo($fila['titulo']);
            $libro->setAutor($fila['autor']);
            $libro->setEditorial($fila['editorial']);
            $libro->setCantidadEjemplares($fila['cantidad_ejemplares']);
            $libro->setIsbn($fila['isbn']);
            $libro->setIdCategoria($fila['id_categoria']);
            $libro->setEstado($fila['estado']);
            $libros[] = $libro;
        }

        return $libros;
    }
    
    public static function listarDisponibles($conexion)
    {
        $libros = array();

        $sql = "SELECT * FROM libros WHERE estado = 'disponible'";
        $result = $conexion->query($sql);

        while ($row = $result->fetch_assoc()) {
            $libro = new Libro();
            $libro->setId($row['id']);
            $libro->setTitulo($row['titulo']);
            $libro->setAutor($row['autor']);
            $libro->setEstado($row['estado']);
            $libro->setConexion($conexion);

            $libros[] = $libro;
        }

        return $libros;
    }
}
?>
