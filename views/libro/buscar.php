<?php include('../../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Buscar Libro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script>
		function abrirVentanaEmergente(url) {
			window.open(url, '_blank', 'width=800,height=600');
		}
	</script>
	<style>
		body {
			background-image: url("../../assets/images/estante-librosBonita.png");
			background-size: cover;
			background-position: center;
		}
		
		.bg-opacity {
			background-color: rgba(255, 255, 255, 0.3);
		}
	</style>
</head>
<body>
	<div class="container-fluid bg-opacity">
		<div class="row justify-content-start">
			<div class="col-12 col-md-6 col-lg-4 p-5">
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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>