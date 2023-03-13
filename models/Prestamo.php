<?php
require_once '../core/Model.php';
require_once '../models/Libro.php';
require_once'../models/Prestamo.php';

class Prestamo extends Model
{
    protected $table = 'prestamos';
    public function getDisponibles()
{
    // obtener la conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'booking a book');

    // obtener los libros disponibles en la base de datos
    $libros_disponibles = Libro::listarDisponibles($conexion);

    return $libros_disponibles;
}


public function insert($id_libro, $id_socio, $conexion)
{
    // obtener el libro
    $libro = new Libro();
    $libro->setId($id_libro);
    $libro->setConexion($conexion);
    $cantidad_ejemplares = $libro->getCantidadEjemplares();

    // verificar si hay suficientes libros disponibles para el préstamo
    if ($cantidad_ejemplares > 0) {
        // insertar el préstamo en la base de datos
        $query = "INSERT INTO {$this->table} (id_libro, id_socio, fecha_prestamo) VALUES ('$id_libro', '$id_socio', NOW())";
        $conexion->query($query);

        // actualizar la cantidad de libros disponibles
        $cantidad_ejemplares--;
        $libro->setCantidadEjemplares($cantidad_ejemplares);
        $libro->update($conexion);
    } else {
        throw new Exception('No hay suficientes ejemplares disponibles para realizar el préstamo.');
    }
}

public function update($id_libro, $id_socio, $conexion)
{
    // actualizar la fecha de devolución del préstamo en la base de datos
    $query = "UPDATE {$this->table} SET fecha_devolucion = NOW() WHERE id_libro = '$id_libro' AND id_socio = '$id_socio' AND fecha_devolucion IS NULL";
    $conexion->query($query);

    // actualizar la cantidad de libros disponibles
    $libro = new Libro();
    $libro->setId($id_libro);
    $libro->setConexion($conexion);
    $cantidad_ejemplares = $libro->getCantidadEjemplares() + 1;
    $libro->setCantidadEjemplares($cantidad_ejemplares);
    $libro->update($conexion);
}


    public function getBySocio($id_socio)
{
    // obtener la conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'booking a book');

    // obtener los préstamos de un socio en la base de datos
    $query = "SELECT prestamos.id, libros.titulo, prestamos.fecha_prestamo, prestamos.fecha_devolucion FROM prestamos JOIN libros ON prestamos.id_libro = libros.id WHERE id_socio = '$id_socio'";
    $result = $conexion->query($query);

    // verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // inicializar un array vacío para almacenar los préstamos
        $prestamos = [];

        // iterar a través de los resultados y agregar cada préstamo al array
        while ($fila = $result->fetch_assoc()) {
            $prestamos[] = $fila;
        }
    } else {
        // no se encontraron resultados, asignar un array vacío
        $prestamos = [];
    }

    return $prestamos;
}

public function nuevo() {
    $prestamo = new Prestamo();

    // verificar si el socio ya tiene el máximo de préstamos permitidos
    $prestamos = $prestamo->getBySocio($_SESSION['id_socio']);
    if (count($prestamos) >= 3) {
        throw new Exception('El socio ya tiene el máximo de préstamos permitidos.');
    }

    // obtener los libros disponibles en la base de datos
    $libros_disponibles = Libro::listarDisponibles($prestamo->conexion);

    // incluir la vista
    require_once '../views/nuevo.php';
}
public function listar() {
    $prestamo = new Prestamo();

    // obtener los préstamos de la base de datos
    $prestamos = $prestamo->getBySocio($_SESSION['id_socio']);

    // obtener los libros disponibles en la base de datos
    $libros_disponibles = Libro::listarDisponibles($prestamo->conexion);

    // incluir la vista
    require_once '../views/listar.php';
}





}

