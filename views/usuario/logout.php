<?php include('../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cerrar sesión</title>
	<script>
		function confirmLogout() {
			if (confirm("¿Está seguro que desea cerrar la sesión?")) {
				window.location.href = "../../index.php";
			}
		}
	</script>
</head>
<body>
<div class="container main-container">

  <h1>Cerrar sesión</h1>
  <p>Haga clic en el botón para cerrar la sesión:</p>
  <button onclick="confirmLogout()">Cerrar sesión</button>
  <button onclick="history.back()">Volver atrás</button>
	
</div>
</body>

</html>
