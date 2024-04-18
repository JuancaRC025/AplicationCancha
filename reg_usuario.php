<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrar Usuario</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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


    <h1> Registrar Usuario</h1>

    <form action="registro_us.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Digite su Nombre">

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required placeholder="Digite sus Apellidos">

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required placeholder="Correo electronico">

        <label for="telefono">Número de Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Número de teléfono" required
            oninput="this.value = this.value.replace(/[^0-9]/g, '')">

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required placeholder="************">
        <span id="toggle-password" class="password-icon"><i class="fas fa-eye-slash"></i></span>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var passwordInput = document.getElementById("contrasena");
                var toggleIcon = document.getElementById("toggle-password");

                toggleIcon.addEventListener("click", function () {
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text"; // Mostrar contraseña
                        toggleIcon.innerHTML = '<i class="fas fa-eye"></i>'; // Cambiar al ícono de ojo abierto
                    } else {
                        passwordInput.type = "password"; // Ocultar contraseña
                        toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Cambiar al ícono de ojo cerrado
                    }
                });
            });
        </script>


        <br>
        <button type="submit">Crear mi cuenta</button>
    </form>
</body>

</html>