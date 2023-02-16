<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulario de Alta de libros</title>
<link rel="stylesheet" href="./assets/css/micss.css">
<style>
    .letraFormulario{
        font-size: 20px;
        font-family: Arial, Helvetica, sans-serif;
        color:gold
    }
    input.letraFormulario[type="submit"] {
    background-color: transparent;
    border: 0px solid black;
    padding: 5px 10px;
    font-size: 20px;
    font-family: Arial, Helvetica, sans-serif;
    color: gold;
    }
    

</style>
</head>
<body>
    
<?php
include "../views/dashboard.php";
require_once '../src/database.php';
?>

<div style="display:flex;flex-direction:column;">
    <form action="alta_libros.php" method="post" class="letraFormulario">
        ISBN: <input type="text" name="ISBN" > *<br>
        Título: <input type="text" name="TITULO"> *<br>
        Autor: <input type="text" name="AUTOR">*<br>
        Fecha de alta de libro: <input type="text" name="FECHA_ALTA"> <br>
        Fecha modificación datos del libro: <input type="text" name="FECHA_MODIFICACION"> <br>
        Fecha de baja del libro: <input type="text" name="FECHA_DESHABILITADO"><br>
        Categoría: 
        <select name="CATEGORIA_ID">
            <option value="" disabled selected>Seleccione una categoría</option>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
                $sql = "SELECT ID, NOMBRE FROM categoria";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="'.$row['ID'].'">'.$row['NOMBRE'].'</option>';
                }
                mysqli_close($conn);
            ?>
        </select>*

        
        
        <input type="submit" name="submit" value="Enviar" class="letraFormulario">
        <a class="dropdown-item" href="../views/lista_libros.php">Ver el listado de libros actualizado</a>
    </form> 
</div>

<?php
// Verificar si se han enviado los datos
if (isset($_POST['submit'])) {
    
        // Recoger los datos del formulario
        $ISBN = $_POST['ISBN'];
        $TITULO = $_POST['TITULO'];
        $AUTOR = $_POST['AUTOR'];
        $FECHA_ALTA = date('Y-m-d H:i:s');
        $FECHA_MODIFICACION = $_POST['FECHA_MODIFICACION'];
        $FECHA_DESHABILITADO = $_POST['FECHA_DESHABILITADO'];
        $CATEGORIA_ID = $_POST['CATEGORIA_ID'];
    
        //Verifica si campos requeridos están vacíos
        if (empty($_POST['ISBN']) || empty($_POST['TITULO']) || empty($_POST['AUTOR']) || empty($_POST['CATEGORIA_ID'])) {
            echo '<div class="mensaje-error">Error: Debe rellenar los campos obligatorios.</div>';
        }else{
            //conectarse a base de datos
            $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
            if (!$conn) {
            echo "Error: No se pudo conectar a la base de datos.";
             exit;    
        }

        // Obtener el ID de la categoría
        $CATEGORIA_ID= mysqli_real_escape_string($conn, $CATEGORIA_ID);
        $sql = "SELECT ID FROM categoria WHERE ID = '$CATEGORIA_ID'";

        


        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $CATEGORIA_ID = $row['ID'];
        } else {
            echo "Error: la categoría no existe.";
            exit;
        }
        // Crear la consulta SQL para insertar los datos
        $sql_libro = "INSERT INTO libro (ISBN, TITULO, AUTOR, FECHA_ALTA, FECHA_MODIFICACION, CATEGORIA_ID, FECHA_DESHABILITADO) VALUES ('$ISBN', '$TITULO', '$AUTOR', '$FECHA_ALTA', '$FECHA_MODIFICACION', '$CATEGORIA_ID', '$FECHA_DESHABILITADO')";
        
        // Ejecutar la consulta SQL
        if (mysqli_query($conn, $sql_libro)) {
            echo "Libro insertado correctamente.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
        }
        }
?>