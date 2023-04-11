<?php include('../../includes/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión</title>
</head>
<body>
	
<div class="container main-container">

<h1>Iniciar sesión</h1>

<?php if (isset($mensaje)): ?>
    <p><?php echo $mensaje; ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Ingresar</button>
    </div>
</form>
</div>
</body>
</html>
