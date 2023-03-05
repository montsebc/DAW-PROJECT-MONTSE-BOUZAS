<?php

require_once '../core/Model.php';
require_once '../models/Prestamo.php';
require_once '../models/Socio.php';
require_once '../models/Libro.php';

class PrestamoController {

    public function nuevo($idSocio, $idLibro) {
        $model = new Model();
        $conexion = $model->connect();

        $socio = new Socio();
        $socio->setId($idSocio);
        $socio->setConexion($conexion);

        $libro = new Libro();
        $libro->setId($idLibro);
        $libro->setConexion($conexion);

        return array(
            'socio' => $socio,
            'libro' => $libro,
        );
    }

    public function guardar($idSocio, $idLibro, $fecha) {
        $model = new Model();
        $conexion = $model->connect();

        $prestamo = new Prestamo();
        $prestamo->setIdSocio($idSocio);
        $prestamo->setIdLibro($idLibro);
        $prestamo->setFecha($fecha);
        $prestamo->setConexion($conexion);

        $prestamo->guardar();
    }

    public function listarPrestamos() {
        $model = new Model();
        $conexion = $model->connect();

        $prestamo = new Prestamo();
        $prestamo->setConexion($conexion);

        return $prestamo->listar();
    }

    public function devolver($id) {
        $model = new Model();
        $conexion = $model->connect();

        $prestamo = new Prestamo();
        $prestamo->setId($id);
        $prestamo->setConexion($conexion);

        $prestamo->devolver();
    }

}

?>

