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
            if (isset($_POST['email']) && isset($_POST['dni'])) {
                $existUser = Login($_POST['email'], $_POST['dni']);

				// Crear cookies y actualizar la web en el que caso de que el usuario exista
				if ($existUser == "usuario") {
					setcookie("email", $_POST['email'], time()+500, "/", "localhost");
					setcookie("dni", $_POST['dni'], time()+500, "/", "localhost");

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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">Password</label>
                                <input type="text" class="form-control" id="dni" name="dni">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src=""></script>
    </body>
</html>

