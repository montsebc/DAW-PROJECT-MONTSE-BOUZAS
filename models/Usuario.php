<?php
require_once __DIR__ . "/../core/Model.php";

class Usuario extends Model {
    private $id;
    private $email;
    private $password;

    public function __construct($email = '', $password = '') {
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function validar($email, $password) {
        $this->connect();
        $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
        $resultado = mysqli_query($this->conexion, $query);

        return mysqli_fetch_assoc($resultado);
    }
    
    
}
?>