<?php
include 'conexion.php';
$last_id = $_GET['lastId'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Detalles de Cancha</title>
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

    <h1>Agregar detalles de la Cancha</h1>
    <form action="registro_detCancha.php" method="post" enctype="multipart/form-data">

        <label for="idCa">Id Cancha:</label>
        <input type="text" name="last_id" value="<?php echo $last_id ?>" readonly>

        <!-- <label for="logo">Logo de la Cancha:</label>
        <input type="file" id="logo" name="logo" accept="image/*">
        El atributo "accept" limita los tipos de archivos a imágenes -->

        <label for="tamaño">Tamaño de la Cancha:</label>
        <input type="text" id="tamaño" name="tamaño" required>

        <label for="nombre">Nombre de la Cancha:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="precio">Precio de la Cancha:</label>
        <input type="text" id="precio" name="precio" required>
        <br>
        <button type="submit" name="adicionar">Adicionar Registro</button>
    </form>


</body>

</html>