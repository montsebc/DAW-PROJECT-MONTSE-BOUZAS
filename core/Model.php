<?php
require __DIR__ ."/../config/database.php";

class Model {
    protected $conexion;

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

    protected function closeConnection() {
        $this->conexion->close();
    }
}
?>

