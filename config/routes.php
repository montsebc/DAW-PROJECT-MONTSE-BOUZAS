<?php

require_once __DIR__ . '/../controllers/UsuarioController.php';
require_once __DIR__ . '/../controllers/PrestamoController.php';
require_once __DIR__ . '/../controllers/SocioController.php';
require_once __DIR__ . '/../controllers/LibroController.php';
require_once __DIR__ . '/../controllers/CategoriaController.php';
require_once __DIR__ . '/database.php';

// Instanciar la conexión a la base de datos
$conexion = $conn;

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $usuarioController = new UsuarioController();
            $usuarioController->login();
            break;
        case 'logout':
            $usuarioController = new UsuarioController();
            $usuarioController->logout();
            break;
        case 'prestamos':
            // Pasar la conexión al controlador de préstamos
            $prestamoController = new PrestamoController($conexion);
            $prestamoController->index();
            break;
        case 'socios':
            $socioController = new SocioController();
            $socioController->index();
            break;
        case 'libros':
            $libroController = new LibroController();
            $libroController->index();
            break;
        case 'categorias':
            $categoriaController = new CategoriaController();
            $categoriaController->index();
            break;
        case 'editar_categoria':
            $categoriaController = new CategoriaController();
            $categoriaController->editar($_GET['id']);
            break;
        default:
            header('Location: index.php?action=login');
            break;
    }
} else {
    header('Location: index.php?action=login');
}
