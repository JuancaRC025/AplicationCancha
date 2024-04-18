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
        <li><a href="cerrar_sesion.php" class="cerrar-sesion">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>



    <div class="cancha-info">
        <h1>Cancha Sintética La Pasión del Fútbol</h1>

        <div class="header">
            <div class="cancha-photo">
                <img src="img/info.png" alt="Foto de la cancha">
            </div>
            <div class="cancha-description">

                <p id="i3">Vive la pasion del futbol en las mejores canchas sinteticas</p>
                <p id="i3">Con grama nueva de primera calidad, salon de eventos, parqueadero y mas!!</p>
                <p id="i3">Te esperamos!</p>



            </div>
        </div>
        <form id="reservationForm" action="reservar.php" method="get">

            <button type="submit">Reservar</button>
        </form>
        <a href="metodos_pago.php" id="verFormasPago">Ver Formas de Pago</a>

        <br>
        <br>

        <div class="cancha-contact">
            <h2>Contacto</h2>
            <p id="i3">Dirección: Cra. 5 #13-54, Pasto, Nariño</p>
            <p id="i3">Teléfono: 311 6030335</p>
            <p id="i3">Correo Electrónico: LaPasionFut@gmail.com</p>
        </div>

        <div class="cancha-social">
            <h2>Redes Sociales</h2>
            <a id="a1" href="https://www.facebook.com/profile.php?id=100063939919599" class="social-icon"><img
                    src="img/facebook.jpg" alt="Facebook"></a>
            <a id="a1" href="https://api.whatsapp.com/send?phone=3116030335" class="social-icon"><img
                    src="img/whatsapp.jpg" alt="Whatsapp"></a>
            <a id="a1" href="https://instagram.com/canchas.lapasiondelfutbol?igshid=OGQ5ZDc2ODk2ZA=="
                class="social-icon"><img src="img/instagram.jpg" alt="Instagram"></a>
        </div>


    </div>

</body>

</html>