<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulario de Alta de Usuarios</title>
</head>
<body>

<form action="alta_usuarios.php" method="post">
Nombre: <input type="text" name="NOMBRE"><br>
Primer Apellido: <input type="text" name="PRIMER_APELLIDO"><br>
Segundo Apellido: <input type="text" name="SEGUNDO_APELLIDO"><br>
Teléfono: <input type="text" name="TELEFONO"><br>
Correo Electrónico: <input type="text" name="EMAIL"><br>
DNI: <input type="text" name="DNI"><br>
$FECHA_ALTA = date('Y-m-d H:i:s');<br>

Fecha de Modificación: <input type="text" name="FECHA_MODIFICACION"><br>
Fecha de Deshabilitación: <input type="text" name="FECHA_DESHABILITADO"><br>
<input type="submit" name="submit" value="Enviar">
<a class="dropdown-item" href="../views/dashboard.php">Volver a panel principal</a></li>
</form> 

<?php

// Verificar si se han enviado los datos
if (isset($_POST['submit'])) {
    // Incluir el archivo de conexión a la base de datos
    require_once '../src/database.php';

    // Recoger los datos del formulario
    $NOMBRE = $_POST['NOMBRE'];
    $PRIMER_APELLIDO = $_POST['PRIMER_APELLIDO'];
    $SEGUNDO_APELLIDO = $_POST['SEGUNDO_APELLIDO'];
    $TELEFONO = $_POST['TELEFONO'];
    $EMAIL = $_POST['EMAIL'];
    $DNI = $_POST['DNI'];
    $FECHA_ALTA = date('Y-m-d H:i:s');
    $FECHA_MODIFICACION = $_POST['FECHA_MODIFICACION'];
    $FECHA_DESHABILITADO = $_POST['FECHA_DESHABILITADO'];

    // Validar los datos
    if (empty($NOMBRE) || empty($PRIMER_APELLIDO) || empty($TELEFONO) || empty($DNI)) {
        echo "Error: todos los campos son obligatorios.";
        exit;
    }

    // Conectar a la base de datos
    $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
    if (!$conn) {
        echo "Error: No se pudo conectar a la base de datos.";
        exit;
    }

    // Crear la consulta SQL para insertar los datos
    $fechaActual = date("Y-m-d H:i:s");
    $sql = "INSERT INTO usuario (NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, TELEFONO, EMAIL, DNI, FECHA_ALTA, FECHA_MODIFICACION, FECHA_DESHABILITADO)
            VALUES ('$NOMBRE', '$PRIMER_APELLIDO', '$SEGUNDO_APELLIDO', '$TELEFONO', '$EMAIL', '$DNI', '$FECHA_ALTA', '$FECHA_MODIFICACION', '$FECHA_DESHABILITADO')";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        echo "Usuario agregado con éxito.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);

    }
}