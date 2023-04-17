<?php
require_once(__DIR__ . '/../models/Categoria.php');

class CategoriaController {
    public function listar() {
        $categoria = new Categoria();
        $categorias = $categoria->listar();

        require_once(__DIR__ . '/../views/categoria/listar.php');
    }

    public function nuevo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);

            $guardado = $categoria->guardar();

            if ($guardado) {
                header('Location: index.php?action=listarCategorias');
            } else {
                echo "Error al guardar la categoría";
            }
        } else {
            require_once(__DIR__ . '/../views/categoria/nuevo.php');
        }
    }

    public function editar() {
        // Obtener el ID de la categoría desde la URL
        $id = $_GET['id'];
    
        // Obtener los datos de la categoría desde el modelo
        $categoria = Categoria::buscarPorId($id);
    
        // Cargar la vista de edición de categoría
        require_once(__DIR__ . '/../views/categoria/editar.php');
    }
    // En tu controlador CategoriaController.php

public function eliminar() {
    $id = $_GET['id'];

    $categoria = new Categoria();
    $categoria->setId($id);

    if (!$categoria->tieneHistorialAsociado()) {
        $eliminado = $categoria->eliminar();

        if ($eliminado) {
            header('Location: index.php?action=listarCategorias');
        } else {
            echo "Error al eliminar la categoría";
        }
    } else {
        echo "No se puede eliminar la categoría porque tiene historial asociado";
    }
}

}
?>
