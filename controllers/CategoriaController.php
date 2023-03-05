<?php

require_once '../core/Model.php';
require_once '../models/Categoria.php';


class CategoriaController {
    public function index() {
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require_once('../views/categoria/index.php');
    }

    public function agregar() {
        require_once('../views/categoria/agregar.php');
    }

    public function guardar($nombre, $descripcion) {
        $categoria = new Categoria();
        $categoria->setNombre($nombre);
        $categoria->guardar();
    }

    public function buscar($id) {
        $categoria = new Categoria();
        $categoria->setId($id);
        $categoria->buscar();

        return $categoria;
    }

    public function actualizar($id, $nombre, $descripcion) {
        $categoria = new Categoria();
        $categoria->setId($id);
        $categoria->setNombre($nombre);

        $categoria->actualizar();
    }

    public function eliminar($id) {
        $categoria = new Categoria();
        $categoria->setId($id);

        $categoria->eliminar();
    }
}


    


