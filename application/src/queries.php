<?php

include_once 'database.php';
function Login($EMAIL, $PASSWORD) {
	$conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "SELECT * FROM usuarios WHERE EMAIL = '$EMAIL' AND PASSWORD = '$PASSWORD'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		mysqli_close($conn);
		return "usuarios";
	} else {
		mysqli_close($conn);
		return "usuario no reconocido";
	}
}
// Función para realizar un préstamo de libro
function realizarPrestamo($libro_id, $usuario_id, $fecha_inicio, $fecha_fin) {
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Verificar si el libro ya está prestado
    $query = "SELECT * FROM prestamo WHERE LIBRO_ID = $libro_id AND DEVUELTO = 0";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return "El libro ya está prestado";
    }
	mysqli_close($conn);

    // Verificar si el usuario tiene menos de 3 libros prestados
    $query = "SELECT * FROM prestamo WHERE USUARIO_ID = $usuario_id AND DEVUELTO = 0";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) >= 3) {
        return "El usuario ya tiene 3 libros prestados";
    }
	// Insertar el nuevo préstamo
    $query = "INSERT INTO prestamo (LIBRO_ID, USUARIO_ID, FECHA_INICIO, FECHA_FIN) VALUES ($libro_id, $usuario_id, '$fecha_inicio', '$fecha_fin')";
    if (mysqli_query($conn, $query)) {
        return "Préstamo realizado correctamente";
    } else {
        return "Error al realizar el préstamo: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// Función para obtener todas las categorías
function getCategorias() {
    // Conectar a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Crear la consulta SQL para obtener todas las categorías
    $consulta = "SELECT * FROM categoria";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array para almacenar las categorías
    $categorias = array();

    // Recorrer los resultados y guardarlos en el array de categorías
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $categorias[] = $fila;
    }

    // Cerrar la conexión
    mysqli_close($conn);

    // Devolver el array de categorías
    return $categorias;
}

// Función para obtener los libros de una categoría determinada
function getLibrosPorCategoria($categoria_id) {
    // Conectar a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Crear la consulta SQL para obtener los libros de la categoría
    $consulta = "SELECT * FROM libro WHERE categoria_id = $categoria_id";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array para almacenar los libros
    $libros = array();

    // Recorrer los resultados y guardarlos en el array de libros
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $libros[] = $fila;
    }

    // Cerrar la conexión
    mysqli_close($conn);

    // Devolver el array de libros
    return $libros;
}
// Función para obtener todos los libros
function getAllLibros() {
    // Conectar a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Crear la consulta SQL para obtener todos los libros
    $consulta = "SELECT * FROM libro";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array para almacenar los libros
    $libros = array();

    // Recorrer los resultados y guardarlos en el array de libros
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $libros[] = $fila;
    }

    // Cerrar la conexión
    mysqli_close($conn);

    // Devolver el array de libros
    return $libros;
}
function getAllPrestamos() {
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Crear la consulta SQL para obtener todos los préstamos y la información de los libros y socios
    $consulta = "SELECT p.ID_PRESTAMO, l.ID AS LIBRO_ID, l.TITULO, CONCAT(u.NOMBRE, ' ', u.PRIMER_APELLIDO, ' ', u.SEGUNDO_APELLIDO) AS nombre_completo, p.FECHA_INICIO, p.FECHA_FIN, p.DEVUELTO
	FROM prestamo p
	JOIN libro l ON p.LIBRO_ID = l.ID
	JOIN socios u ON p.USUARIO_ID = u.ID
	";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array para almacenar los préstamos
    $prestamos = array();

    // Recorrer los resultados y guardarlos en el array de préstamos
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $prestamos[] = $fila;
    }

    // Cerrar la conexión
    mysqli_close($conn);

    // Devolver el array de préstamos
    return $prestamos;
}

function devolverPrestamo($ID_PRESTAMO) {
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    $query = "UPDATE prestamo SET DEVUELTO = 1 WHERE ID_PRESTAMO = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $ID_PRESTAMO);
    mysqli_stmt_execute($stmt);

    if(mysqli_affected_rows($conn) > 0) {
        return "El préstamo ha sido devuelto correctamente";
    } else {
        return "Error al devolver el préstamo: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function getAllSocios() {
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");

    // Crear la consulta SQL para obtener todos los socios
    $consulta = "SELECT * FROM socios";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array para almacenar los socios
    $socios = array();

    // Recorrer los resultados y guardarlos en el array de socios
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $socios[] = $fila;
    }

    // Cerrar la conexión
    mysqli_close($conn);

    // Devolver el array de socios
    return $socios;
}

?>

    
