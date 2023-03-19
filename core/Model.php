<?php
require __DIR__ ."/../config/database.php";

class Model {
    protected $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    

    public function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booking a book";

        $this->conexion = new mysqli($servername, $username, $password, $dbname);

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }

        return $this->conexion;
    }
    public function __destruct() {
        $this->closeConnection();
    }
    

    protected function closeConnection() {
        $this->conexion->close();
    }
}

?>

