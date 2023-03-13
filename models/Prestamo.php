<?php
class Prestamo {
    protected $id;
    protected $id_libro;
    protected $id_socio;
    protected $fecha_prestamo;
    protected $fecha_devolucion;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdLibro() {
        return $this->id_libro;
    }

    public function setIdLibro($id_libro) {
        $this->id_libro = $id_libro;
    }

    public function getIdSocio() {
        return $this->id_socio;
    }

    public function setIdSocio($id_socio) {
        $this->id_socio = $id_socio;
    }

    public function getFechaPrestamo() {
        return $this->fecha_prestamo;
    }

    public function setFechaPrestamo($fecha_prestamo) {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    public function getFechaDevolucion() {
        return $this->fecha_devolucion;
    }

    public function setFechaDevolucion($fecha_devolucion) {
        $this->fecha_devolucion = $fecha_devolucion;
    }
}
?>
