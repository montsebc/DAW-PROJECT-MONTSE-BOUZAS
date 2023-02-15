<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    </head>
    <body>
        <?php 
         require_once "./src/queries.php";

         if (isset($_POST['EMAIL']) && isset($_POST['PASSWORD'])) {
            $EMAIL = $_POST['EMAIL'];
            $PASSWORD = $_POST['PASSWORD'];
            $existUser = Login($EMAIL, $PASSWORD);
        
//prueba commit
				// Crear cookies y actualizar la web en el que caso de que el usuario exista
				if ($existUser == "usuario") {
					setcookie("EMAIL", $_POST['EMAIL'], time()+500, "/", "localhost");
					setcookie("PASSWORD", $_POST['PASSWORD'], time()+500, "/", "localhost");

                    header("location: ./views/dashboard.php");
				}
				else{
                    echo "Usuario no registrado.";
				}
			}
        ?>
        <div class="container mt-5">
            <div class="row">
                <div class="card mx-auto" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Acceso sistema:</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="EMAIL" class="form-label">CORREO ELECTRÓNICO:</label>
                                <input type="EMAIL" class="form-control" id="EMAIL" name="EMAIL" aria-describedby="EMAILHelp">
                                <div id="EMAILHelp" class="form-text">Asegúrate de no compartir tus claves de acceso con nadie</div>
                            </div>
                            <div class="mb-3">
                                <label for="PASSWORD" class="form-label">CONTRASEÑA:</label>
                                <input type="password" class="form-control" id="PASSWORD" name="PASSWORD">
                            </div>
                            <button type="submit" class="btn btn-primary">ACEPTAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src=""></script>
    </body>
</html>

