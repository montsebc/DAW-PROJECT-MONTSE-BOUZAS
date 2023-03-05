<?php
require_once '../models/Socio.php';
require_once '../core/Model.php';

class SocioController {

    public function agregar() {
        // Validar datos del formulario
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        // Crear un nuevo socio con los datos
        $socio = new Socio($nombre, $apellidos, $email, $telefono);

        // Agregar el socio a la base de datos
        $socio->agregar();

        // Redirigir a la página de socios
        header('Location: index.php?action=socios');
    }

    public function listarSocios() {
        $socio = new Socio();
        $socios = $socio->listar();
        return $socios;
    }
    

    public function mostrarFormulario() {
        // Mostrar el formulario de alta de socios
        require_once('../views/socio/formulario.php');
    }
}


