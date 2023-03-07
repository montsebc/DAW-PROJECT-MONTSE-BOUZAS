<?php

require_once __DIR__ . '/../core/Model.php';
require_once __DIR__. '/../models/Prestamo.php';
require_once __DIR__. '/../models/Socio.php';
require_once __DIR__. '/../models/Libro.php';

class PrestamoController {

    private $conexion;

    public function __construct() {
        $model = new Model();
        $this->conexion = $model->connect();
    }

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

    public function listarPrestamos()
    {
        $prestamos = array();

        $sql = "SELECT * FROM prestamos";
        $result = $this->conexion->query($sql);

        while ($row = $result->fetch_assoc()) {
            $prestamo = new Prestamo();
            $prestamo->setId($row['id']);
            $prestamo->setSocio($this->buscarSocio($row['socio_id']));
            $prestamo->setLibro($this->buscarLibro($row['libro_id']));
            $prestamo->setFechaPrestamo($row['fecha_prestamo']);
            $prestamo->setFechaDevolucion($row['fecha_devolucion']);
            $prestamos[] = $prestamo;
        }

        return $prestamos;
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
