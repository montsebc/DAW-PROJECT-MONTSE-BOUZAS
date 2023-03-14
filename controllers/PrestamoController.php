<?php

require_once "../models/Prestamo.php";

class PrestamoController {

    public function listarPrestamos() {
        $prestamo = new Prestamo();
        $prestamos = $prestamo->listar_prestamos();
        include "../views/listar.php";
    }

    public function nuevoPrestamo() {
        $prestamo = new Prestamo();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_socio = $_POST['id_socio'];
            $id_libro = $_POST['id_libro'];
            $fecha_prestamo = $_POST['fecha_prestamo'];
            $mensaje = $prestamo->nuevo_prestamo($id_socio, $id_libro, $fecha_prestamo);
        }
        include "../views/nuevo.php";
    }

    public function devolverPrestamo() {
        $prestamo = new Prestamo();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prestamo = $_POST['id_prestamo'];
            $mensaje = $prestamo->devolverPrestamo($id_prestamo);
        }
        include "../views/devolver.php";
    }

}
?>
