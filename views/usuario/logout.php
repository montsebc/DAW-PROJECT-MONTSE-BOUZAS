<?php include('../../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
 	<title>Cerrar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("../../assets/images/estante-librosBonita.png");
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0.9;
            
        }
        .form-container {
            /* max-width: 500px; */
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }
    </style>
    <script>
        function confirmLogout() {
            if (confirm("¿Está seguro que desea cerrar la sesión?")) {
                window.location.href = "../../index.php";
            }
        }
        function goBack() {
        window.location.href = "../../bienvenida.php";
    }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <p>¿Estás seguro de que quieres cerrar la sesión?</p>
            <button onclick="confirmLogout()" class="btn btn-primary">Cerrar sesión</button>
            <button onclick="goBack()" class="btn btn-secondary">Volver atrás</button>
        </div>
    </div>
</body>
</html>
