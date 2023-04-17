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
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("./assets/images/estante-librosBonita.png");
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            opacity: 0.9;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button[type="submit"]:hover {
            background-color: #0069d9;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Iniciar sesión</h1>

            <?php if (isset($mensaje)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required class="form-control">
		    </div>
		    <button type="submit" class="btn btn-primary">Ingresar</button>
		</form>
	</div>
</body>
</html>
