<?php
require_once __DIR__ . "/../core/Model.php";

class Socio extends Model {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;
    private $max_libros_prestados = 3;
    protected $conexion;


    public function __construct($nombre = '', $apellidos = '', $email = '', $telefono = '') {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
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

    public function agregar() {
        $conexion = $this->connect();
        $query = "INSERT INTO socios (nombre, apellidos, email, telefono) VALUES ('$this->nombre', '$this->apellidos', '$this->email', '$this->telefono')";
        $resultado = $conexion->query($query);
    }

    public function listar() {
        $conexion = $this->connect();
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

            $socios[] = $socio;
        }

        return $socios;
    }

    public function buscarPorId() {
        $conexion = $this->connect();
        $query = "SELECT * FROM socios WHERE id = '$this->id'";
        $resultado = $conexion->query($query);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $this->setNombre($fila['nombre']);
            $this->setApellidos($fila['apellidos']);
            $this->setEmail($fila['email']);
            $this->setTelefono($fila['telefono']);
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setConexion($conexion) {
        $this->conexion = $conexion;
    }
    public function buscar($id) {
        $query = "SELECT * FROM socios WHERE id = $id";
        $conexion = $this->connect();
        $resultado = $conexion->query($query);
        $socio = null;
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $socio = new Socio();
            $socio->setId($fila['id']);
            $socio->setNombre($fila['nombre']);
            $socio->setApellidos($fila['apellidos']);
            $socio->setEmail($fila['email']);
            $socio->setTelefono($fila['telefono']);
        }
    
        $conexion->close();
        return $socio;
    }
    
    public function devolver($prestamo_id, $libro_id) {
        $conexion = $this->connect();
    
        // Eliminar el préstamo de la base de datos
        $query = "DELETE FROM prestamos WHERE id = $prestamo_id";
        $resultado = $conexion->query($query);
    
        // Incrementar la cantidad de ejemplares disponibles del libro
        $query = "UPDATE libros SET cantidad_ejemplares = cantidad_ejemplares + 1 WHERE id = $libro_id";
        $resultado = $conexion->query($query);
    
        $conexion->close();
    }
}
?>  
