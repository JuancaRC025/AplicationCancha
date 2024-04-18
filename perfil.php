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
        <li class="nav-item"><a href="index.php">
                < Volver</a>
        </li>
    </ul>

</body>

</html>




<?php
// Inicia la sesión (asegúrate de hacerlo al principio del archivo)
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_empresa'])) {
    // No hay sesión iniciada
    echo "No hay una sesión iniciada.";
} else {
    // Verifica si es un usuario individual
    if (isset($_SESSION['id_usuario'])) {
        // Redirige a la página de bienvenida para usuarios
        header("Location: bienvenido.php");
        exit();
    } elseif (isset($_SESSION['id_empresa'])) {
        // Redirige a la página de bienvenida para empresas
        header("Location: bienvenido_e.php");
        exit();
    }
}
?>