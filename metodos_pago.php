<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Informacion</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <li class="nav-item"><a href="informacion.php"> < Volver</a></li>
    </ul>
<br>
<br>
<h2>Utiliza estos Servicios dentro del establecimiento</h2>
<br>
<br>
<div class="imagenes-container">
    <!-- Agrega aquí tus 4 imágenes con las etiquetas <img> -->
    <img src="img/bancolom.png" alt="Servicio 1">
    <img src="img/davivienda1.png" alt="Servicio 2">
    <img src="img/nequi.jpg" alt="Servicio 3">
    <img src="img/pse.png" alt="Servicio 4">
</div>


</body>

</html>