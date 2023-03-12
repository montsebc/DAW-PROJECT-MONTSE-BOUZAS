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
  <h1>Cerrar sesión</h1>
  <p>Haga clic en el botón para cerrar la sesión:</p>
  <button onclick="confirmLogout()">Cerrar sesión</button>
  <button onclick="history.back()">Volver atrás</button>
</body>

</html>
