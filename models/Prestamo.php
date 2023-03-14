<?php
class Prestamo {
    public static function listar() {
        // Conectarse a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'booking a book');
        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
        }

        // Consulta SQL para obtener todos los préstamos
        $query = "SELECT p.*, l.titulo as titulo_libro, l.autor as autor_libro FROM prestamos p JOIN libros l ON p.id_libro = l.id";
        $resultado = $conexion->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Crear un array para almacenar los préstamos
            $prestamos = array();

            // Iterar a través de los resultados y crear un objeto Prestamo por cada préstamo
            while ($fila = $resultado->fetch_assoc()) {
                $prestamo = new Prestamo($fila['id'], $fila['id_libro'], $fila['id_socio'], $fila['fecha_prestamo'], $fila['fecha_devolucion']);
                $prestamo->titulo_libro = $fila['titulo_libro'];
                $prestamo->autor_libro = $fila['autor_libro'];
                $prestamos[] = $prestamo;
            }

            // Cerrar la conexión a la base de datos y devolver el array de préstamos
            $conexion->close();
            return $prestamos;
