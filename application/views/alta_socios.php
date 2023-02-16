<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulario de Alta de Socios</title>
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
<form action="alta_socios.php" method="post" class="letraFormulario">
Nombre: <input type="text" name="NOMBRE" > *<br>
Primer Apellido: <input type="text" name="PRIMER_APELLIDO"> *<br>
Segundo Apellido: <input type="text" name="SEGUNDO_APELLIDO"><br>
Teléfono: <input type="text" name="TELEFONO"> *<br>
Correo Electrónico: <input type="text" name="EMAIL"> *<br>
DNI: <input type="text" name="DNI"> *<br>
Fecha de Alta: <input type="date" name="FECHA_ALTA" value="<?php echo date('Y-m-d'); ?>" readonly><br>
Fecha de Modificación: <input type="text" name="FECHA_MODIFICACION"><br>
Fecha de Deshabilitación: <input type="text" name="FECHA_DESHABILITADO"><br>
<input type="submit" name="submit" value="Enviar" class="letraFormulario">
<a class="dropdown-item", href="../views/lista_socios.php">Ver el listado actualizado</a>
</form> 
</div>
<?php
$email_regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$dni_regex = '/^[0-9]{8}[A-Z]$/';
// Verificar si se han enviado los datos
if (isset($_POST['submit'])) {
    // Verificar si se han enviado los datos
    if (empty($_POST['NOMBRE']) || empty($_POST['PRIMER_APELLIDO']) || empty($_POST['TELEFONO']) || empty($_POST['EMAIL']) || empty($_POST['DNI'])) {
        echo '<div class="mensaje-error">Error: Error todos los campos marcados con * son obligatorios.</div>';

        exit;
    }
    // Recoger los datos del formulario/
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
// Validar los datos
if (empty($NOMBRE) || empty($PRIMER_APELLIDO) || empty($TELEFONO) || empty($DNI) || empty($EMAIL) || !filter_var($EMAIL, FILTER_VALIDATE_EMAIL) || !preg_match("/^[0-9]{8}[A-Za-z]$/", $DNI)) {
    echo "ATENCIÓN :El formato de correo electrónico y/o DNI debe ser válido.";
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
$sql = "INSERT INTO socios (NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, TELEFONO, EMAIL, DNI, FECHA_ALTA, FECHA_MODIFICACION, FECHA_DESHABILITADO)
        VALUES ('$NOMBRE', '$PRIMER_APELLIDO', '$SEGUNDO_APELLIDO', '$TELEFONO', '$EMAIL', '$DNI', '$FECHA_ALTA', '$FECHA_MODIFICACION', '$FECHA_DESHABILITADO')";

// Ejecutar la consulta
if (mysqli_query($conn, $sql)) {
    echo '<div class="mensaje-exito">Socio agregado con éxito.</div>';
} else {
    echo '<div class="mensaje-error">Error: ' . $sql . '<br>' . mysqli_error($conn) . '</div>';
}
}
?>
