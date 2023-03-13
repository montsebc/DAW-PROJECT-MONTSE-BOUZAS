<?php
require_once '../models/Prestamo.php';

class PrestamoController {
    public function devolver($id_libro, $id_socio) {
        $prestamo = new Prestamo();
        $prestamo->update($id_libro, $id_socio);

        // redirigir a la página de listar préstamos
        echo "<script>window.location.href = 'listar.php';</script>";
        exit();
            
    }

    public function listar() {
        $prestamo = new Prestamo();
    
        // obtener los préstamos de la base de datos
        $prestamos = $prestamo->getBySocio($_SESSION['id_socio']);
    
        // obtener los libros disponibles en la base de datos
        $libros_disponibles = $prestamo->getDisponibles();
    
        // incluir la vista
        require_once '../views/listar.php';
    }
    
    
    

    public function nuevo() {
        $prestamo = new Prestamo();
    
        // verificar si el socio ya tiene el máximo de préstamos permitidos
        $prestamos = $prestamo->getBySocio($_SESSION['id_socio']);
        if (count($prestamos) >= 3) {
            throw new Exception('El socio ya tiene el máximo de préstamos permitidos.');
        }
    
        // obtener los libros disponibles en la base de datos
        $libro = new Libro();
        $libros_disponibles = $prestamo->getDisponibles();
    
        // incluir la vista
        require_once '../views/nuevo.php';
    }
    

    public function prestar($id_libro) {
        $id_socio = $_SESSION['id_socio'];
        $prestamo = new Prestamo();

        // verificar si el socio ya tiene el máximo de préstamos permitidos
        $prestamos = $prestamo->getBySocio($id_socio);
        if (count($prestamos) >= 3) {
            throw new Exception('El socio ya tiene el máximo de préstamos permitidos.');
        }

        // insertar el préstamo en la base de datos
        $prestamo->insert($id_libro, $id_socio);

        // redirigir a la página de listar préstamos
        echo "<script>window.location.href = 'listar.php';</script>";
        exit();

    }
    public function getDisponibles() {
        // obtener la conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
    
        // obtener los libros disponibles en la base de datos
        $query = "SELECT id, titulo, autor, editorial, fecha_disponible FROM libros WHERE cantidad_ejemplares > 0";
        $result = $conexion->query($query);
    
        // verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // inicializar un array vacío para almacenar los libros disponibles
            $libros_disponibles = [];
    
            // iterar a través de los resultados y agregar cada libro disponible al array
            while ($fila = $result->fetch_assoc()) {
                $libros_disponibles[] = $fila;
            }
        } else {
            // no se encontraron resultados, asignar null
            $libros_disponibles = null;
        }
    
        return $libros_disponibles;
    }
    
}
?>
