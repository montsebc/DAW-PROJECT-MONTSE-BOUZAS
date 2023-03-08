<?php

require_once __DIR__ . '/../core/Model.php';
require_once __DIR__. '/../models/Prestamo.php';
require_once __DIR__. '/../models/Socio.php';
require_once __DIR__. '/../models/Libro.php';

class PrestamoController {
    public function listar() {
        $conexion = new mysqli("localhost", "root", "", "booking a book");
        $query = "SELECT * FROM prestamos";
        $result = $conexion->query($query);
    
        $prestamos = [];
    
        while ($fila = $result->fetch_object('Prestamo')) {
            $prestamos[] = $fila;
        }
    
        $result->free();
        $conexion->close();
    
        return $prestamos;
    }
    
    
    public function index()
{
    $prestamo = new Prestamo();
    $prestamos = $prestamo->listar();

    require_once 'views/prestamo/listar.php';
}


    public function crear() {
        $libro = new Libro();
        $libros = $libro->listarDisponibles();

        $socio = new Socio();
        $socios = $socio->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idSocio = $_POST['socio'];
            $idLibro = $_POST['libro'];

            // Obtener la fecha actual
            $fechaActual = date('Y-m-d');

            // Calcular la fecha de devolución (15 días a partir de la fecha actual)
            $fechaDevolucion = date('Y-m-d', strtotime($fechaActual . '+ 15 days'));

            // Crear el objeto de préstamo
            $prestamo = new Prestamo($idSocio, $idLibro, $fechaActual, $fechaDevolucion);
            $prestamo->guardar();

            // Redirigir al listado de préstamos
            header('Location: /prestamo/listar');
            exit;
        }

        require_once __DIR__ . '/../views/prestamo/nuevo.php';
    }

    public function devolver() {
        $id = $_GET['id'];

        $prestamo = new Prestamo();
        $prestamo = $prestamo->buscar($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prestamo->devolver();

            // Redirigir al listado de préstamos
            header('Location: /prestamo/listar');
            exit;
        }

        require_once __DIR__ . '/../views/prestamo/devolver.php';
    }
}
?>
