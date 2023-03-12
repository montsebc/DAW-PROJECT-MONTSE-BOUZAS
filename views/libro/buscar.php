<!DOCTYPE html>
<html>
<head>
	<title>Buscar Libro</title>
	<script>
		function abrirVentanaEmergente(url) {
			window.open(url, '_blank', 'width=800,height=600');
		}
	</script>
</head>
<body>
	<h2>Buscar Libro</h2>
	<form method="GET" onsubmit="abrirVentanaEmergente('resultado_busqueda.php?opcion=' + document.getElementsByName('opcion')[0].value + '&valor_busqueda=' + document.getElementsByName('valor_busqueda')[0].value); return false;">
		<label>Buscar por:</label>
		<select name="opcion">
			<option value="titulo">Título</option>
			<option value="autor">Autor</option>
			<option value="editorial">Editorial</option>
			<option value="isbn">ISBN</option>
		</select>
		<input type="text" name="valor_busqueda">
		<button type="submit">Buscar</button>
	</form>
	<button onclick="location.href='../../bienvenida.php'">Volver a la página de bienvenida</button>
</body>
</html>
