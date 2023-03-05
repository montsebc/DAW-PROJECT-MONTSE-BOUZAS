<?php

require_once 'controllers/UsuarioController.php';
require_once 'controllers/PrestamoController.php';
require_once 'controllers/SocioController.php';
require_once 'controllers/LibroController.php';
require_once 'controllers/CategoriaController.php';

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
            $prestamoController = new PrestamoController();
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
        default:
            header('Location: index.php?action=login');
            break;
    }
} else {
    header('Location: index.php?action=login');
}


