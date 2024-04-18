<?php
include 'conexion.php';
session_start();

// Realiza una consulta para recuperar las canchas desde la base de datos
$sql = "SELECT * FROM empresa"; // Asegúrate de que el nombre de la tabla coincida con tu base de datos

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Canchas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <script src='main.js'></script>
</head>
<style>
    body {
        background-image: url('./img/fondo.avif');
        /* Reemplaza 'ruta_de_la_imagen.jpg' con la ruta de tu imagen de fondo */
    }
</style>

<body>
    <div class="header">
        <div class="logo">
            <img src="img/logo_solo.png" alt="Logo de tu sitio web">
        </div>
        <div class="titles">
            <h1 id="i1">PLAYGROUND PRO</h1>
            <h2 id="i2">"Encuentra, reserva y disfruta de canchas sintéticas al alcance de tu mano"</h2>
        </div>
    </div>

    <ul class="navbar">
        <li class="nav-item"><a href="index.php">Inicio</a></li>
        <li class="nav-item"><a href="canchas.php">Canchas</a></li>
        <li class="nav-item">
  <a href="https://api.whatsapp.com/send?phone=3027500507&text=Tengo%20problemas%20de%20acceso%20o%20requiero%20información.%20¿Me%20pueden%20ayudar%3F" target="_blank">Soporte</a>
</li>

        <li class="nav-item dropdown">
            <a href="#">Registrar</a>
            <div class="dropdown-content">
                <a href="reg_usuario.php">Usuario</a>
                <a href="reg_empresa.php">Empresa</a>
            </div>
        </li>
        <li class="nav-item"><a href="ingresar.php">Ingresar</a></li>
   
    </ul>

    <h1>Canchas Disponibles</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="cancha-box">';
            echo '<h2>Cancha: ' . $row["Razon_Social"] . '</h2>';
            echo '<p>Ubicación: ' . $row["Direccion"] . '</p>';
            echo '<a href="informacion.php?id=' . $row["Id_Empresa"] . '">Ver detalles</a>';
            echo '</div>';
        }
    } else {
        echo "No se encontraron canchas en la base de datos.";
    }
    ?>

    <!-- Otro contenido de tu página -->

</body>

</html>