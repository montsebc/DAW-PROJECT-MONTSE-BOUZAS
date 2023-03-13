<?php

require_once '../core/Model.php';

class Socio extends Model {
    
    protected $table = 'socios';

    protected $id;
    protected $nombre;
    protected $apellidos;
    protected $email;
    protected $telefono;
    protected $max_libros_prestados;

    public function __construct($nombre = '', $apellidos = '', $email = '', $telefono = '', $max_libros_prestados = '') {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->max_libros_prestados = $max_libros_prestados;
    }

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

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function getMaxLibrosPrestados() {
        return $this->max_libros_prestados;
    }

    public function setMaxLibrosPrestados($max_libros_prestados) {
        $this->max_libros_prestados = $max_libros_prestados;
    }

    public function guardar() {
        $query = "INSERT INTO socios (nombre, apellidos, email, telefono, max_libros_prestados) VALUES ('{$this->nombre}', '{$this->apellidos}', '{$this->email}', '{$this->telefono}', '{$this->max_libros_prestados}')";
        $this->conexion->query($query);
    }

    public function buscarPorId() {
        $query = "SELECT * FROM socios WHERE id = {$this->id}";
        $resultado = $this->conexion->query($query);
        if ($resultado && $resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            $this->nombre = $fila['nombre'];
            $this->apellidos = $fila['apellidos'];
            $this->email = $fila['email'];
            $this->telefono = $fila['telefono'];
            $this->max_libros_prestados = $fila['max_libros_prestados'];
        }
    }

    public function eliminar() {
        $query = "DELETE FROM socios WHERE id = {$this->id}";
        $this->conexion->query($query);
    }

    public static function listar() {
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        $query = "SELECT * FROM socios";
        $resultado = $conexion->query($query);
        $socios = array();
        while ($fila = $resultado->fetch_assoc()) {
            $socio = new Socio();
            $socio->setId($fila['id']);
            $socio->setNombre($fila['nombre']);
            $socio->setApellidos($fila['apellidos']);
            $socio->setEmail($fila['email']);
            $socio->setTelefono($fila['telefono']);
            $socio->setMaxLibrosPrestados($fila['max_libros_prestados']);
            $socios[] = $socio;
        }
        $conexion->close();
        return $socios;
    }
}
?>
    
