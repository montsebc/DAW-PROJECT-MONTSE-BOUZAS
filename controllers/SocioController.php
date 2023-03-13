<?php
require_once '../models/Socio.php';

class SocioController {

    public function agregar() {
        // Validar datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $apellidos = $_POST['apellidos'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefono = $_POST['telefono'] ?? '';

        // Crear un nuevo socio con los datos
        $socio = new Socio($nombre, $apellidos, $email, $telefono);

        // Agregar el socio a la base de datos
        $socio->guardar();

        // Redirigir a la página de socios
        header('Location: index.php');
        exit();
    }

    public function listarSocios() {
        $socios = Socio::listar();
        return $socios;
    }

    public function mostrarFormulario() {
        // Mostrar el formulario de alta de socios
        require_once('../views/socio/formulario.php');
    }

    public function index() {
        $socios = Socio::listar();
        require_once('../views/socio/index.php');
    }

    public function buscar($id) {
        $socio = new Socio();
        $socio->setId($id);
        $socio->buscarPorId();
        return $socio;
    }

    public function eliminar() {
        $socio = $this->buscar($_GET['id']);
    
        if ($socio) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $socio->eliminar();
    
                header('Location: index.php');
                exit();
            }
    
            require_once '../views/eliminar.php';
        } else {
            echo "Socio no encontrado.";
        }
    }
    

}
