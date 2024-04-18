<?php
session_start();

// Destruye la sesión
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sesión Cerrada</title>
</head>
<body>
<script>
// Muestra una ventana emergente informando al usuario que la sesión ha sido cerrada
alert("Sesión cerrada.");

// Redirige al usuario a la página de inicio
window.location.href = "index.php";
</script>
</body>
</html>
