<?php
require "models/Usuario.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario de login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar las credenciales del usuario

    $usuario = new Usuario();
    $loginUsuario = $usuario->validar($email, $password);

    if ($loginUsuario) {
        // Iniciar sesión y redirigir al usuario a la página principal
        $_SESSION['usuario'] = $email;
        header('Location: bienvenida.php');
        return;
    } else {
        // Mostrar un mensaje de error
        $mensaje = 'Email o password incorrecto';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
</head>
<body>
	<h1>Iniciar sesión</h1>
	<?php if (isset($mensaje)): ?>
		<p><?php echo $mensaje; ?></p>
	<?php endif; ?>
	<form method="post">
		<label>Email:</label>
		<input type="text" name="email" /><br>
		<label>Password:</label>
		<input type="password" name="password" /><br>
		<input type="submit" value="Iniciar sesión" />
	</form>
</body>
</html>
