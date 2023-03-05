<?php
require_once '../models/Libro.php';
require_once '../models/Categoria.php';

class LibroController {

    public function index() {
        $libro = new Libro();
        $libros = $libro->listar();

        require_once('../views/libro/index.php');
    }

    public function agregar() {
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require_once '../views/libro/agregar.php';
    }

    public function guardar() {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria_id = $_POST['categoria_id'];
        $cantidad_ejemplares = $_POST['cantidad_ejemplares'];

        $libro = new Libro();
        $libro->setTitulo($titulo);
        $libro->setAutor($autor);
        $libro->setCategoriaId($categoria_id);
        $libro->setCantidadEjemplares($cantidad_ejemplares);

        $libro->guardar();

        header('Location: index.php?action=libros');
    }

    public function buscar($titulo) {
        $libro = new Libro();
        return $libro->buscar($titulo);
    }

    public function mostrarFormularioActualizar() {
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        $id = $_GET['id'];

        $libro = new Libro();
        $libro->setId($id);
        $libro->buscarPorId();

        require_once('../views/libro/actualizar.php');
    }

    public function actualizar() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria_id = $_POST['categoria_id'];
        $cantidad_ejemplares = $_POST['cantidad_ejemplares'];

        $libro = new Libro();
        $libro->setId($id);
        $libro->setTitulo($titulo);
        $libro->setAutor($autor);
        $libro->setCategoriaId($categoria_id);
        $libro->setCantidadEjemplares($cantidad_ejemplares);

        $libro->actualizar();

        header('Location: index.php?action=libros');
    }

    public function eliminar($id) {
        $libro = new Libro();
        $libro->setId($id);

        $libro->eliminar();

        header('Location: index.php?action=libros');
    }
}





