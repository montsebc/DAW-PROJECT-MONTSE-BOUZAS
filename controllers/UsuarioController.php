<?php
require_once("../models/Usuario.php");

class UsuarioController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario de login
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validar las credenciales del usuario
            $usuario = new Usuario($email, $password);

            if ($usuario->validar($email, $password)) {
                // Iniciar sesión y redirigir al usuario a la página principal
                session_start();
                $_SESSION['usuario'] = $email;
                header('Location: bienvenida.php');
                return;
            } else {
                // Mostrar un mensaje de error
                $mensaje = 'Email o password incorrecto';
            }
        }

        // Cargar la vista de login
        require_once '../views/usuario/login.php';
    }

    public function logout() {
        // Cerrar la sesión y redirigir al usuario al login
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>