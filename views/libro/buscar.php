<?php include('../../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Buscar Libro</title>
	<link rel="stylesheet" href="../assets/css/styles.css">
	<script>
		function abrirVentanaEmergente(url) {
			window.open(url, '_blank', 'width=800,height=600');
		}
	</script>
<style>
		body {
			background-image: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url("../../assets/images/estante-librosBonita.png");
			background-size: cover;
			background-position: center;
		}
		
		.bg-opacity {
			background-color: rgba(255, 255, 255, 0.8);
			border-radius: 10px;
			padding: 20px;
			max-width: 480px;
			margin: auto;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6 col-lg-4 p-5 bg-opacity">
				<h2 class="text-center mb-4">Buscar Libro</h2>
				<form method="GET" onsubmit="abrirVentanaEmergente('resultado_busqueda.php?opcion=' + document.getElementsByName('opcion')[0].value + '&valor_busqueda=' + document.getElementsByName('valor_busqueda')[0].value); return false;" class="border p-4 rounded bg-white">
					<div class="form-group">
						<label for="opcion">Buscar por:</label>
						<select name="opcion" id="opcion" class="form-control">
							<option value="titulo">Título</option>
							<option value="autor">Autor</option>
							<option value="editorial">Editorial</option>
							<option value="isbn">ISBN</option>
						</select>
					</div>
					<div class="form-group">
						<label for="valor_busqueda">Búsqueda:</label>
						<input type="text" name="valor_busqueda" id="valor_busqueda" class="form-control" placeholder="Ingrese búsqueda...">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary">Buscar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
