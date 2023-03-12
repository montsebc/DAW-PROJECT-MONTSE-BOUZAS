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

        if (isset($_POST['agregar'])) {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $id_categoria = $_POST['id_categoria'];
            $cantidad_ejemplares = $_POST['cantidad_ejemplares'];

            $libro = new Libro();
            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setEditorial($editorial);
            $libro->setIsbn($isbn);
            $libro->setIdCategoria($id_categoria);
            $libro->setCantidadEjemplares($cantidad_ejemplares);

            $resultado = $libro->agregar();
            if ($resultado) {
                echo "<script>alert('El libro ha sido agregado correctamente.');</script>";
            } else {
                echo "<script>alert('Ha ocurrido un error al agregar el libro.');</script>";
            }
        }

        require_once '../views/libro/agregar.php';
    }

    public function eliminar($id) {
        $libro = new Libro();
        $resultado = $libro->eliminar($id);

        if ($resultado) {
            echo "<script>alert('El libro ha sido eliminado correctamente.');</script>";
        } else {
            echo "<script>alert('Ha ocurrido un error al eliminar el libro.');</script>";
        }

        header('Location: index.php');
    }

    public function modificar($id) {
        $libro = new Libro();
        $libro->buscar($id);

        $categoria = new Categoria();
        $categorias = $categoria->listar();

        if (isset($_POST['modificar'])) {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $isbn = $_POST['isbn'];
            $id_categoria = $_POST['id_categoria'];
            $cantidad_ejemplares = $_POST['cantidad_ejemplares'];

            $libro->setTitulo($titulo);
            $libro->setAutor($autor);
            $libro->setEditorial($editorial);
            $libro->setIsbn($isbn);
            $libro->setIdCategoria($id_categoria);
            $libro->setCantidadEjemplares($cantidad_ejemplares);

            $resultado = $libro->modificar();
            if ($resultado) {
                echo "<script>alert('El libro ha sido modificado correctamente.');</script>";
            } else {
                echo "<script>alert('Ha ocurrido un error al modificar el libro.');</script>";
            }
        }

        require_once '../views/libro/modificar.php';
    }

    public function buscar($titulo) {
        $libro = new Libro();
        return $libro->buscar($titulo);
    }

}
?>