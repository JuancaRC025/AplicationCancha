<?php
include 'conexion.php';
session_start();


// Verifica si el Id_empresa está definido en la sesión
$empresa_id = isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : null;

if (!$empresa_id) {
    // Manejo del caso en que $_SESSION['id_empresa'] no esté definido o sea nulo
    echo '<script>
        setTimeout(function() {
            window.location.href = "ingresar.php";
        }, 1000); // Redirigir después de 10 segundos
    </script>';
    exit();  // Agregado para evitar que el resto del código se ejecute
}

// Realiza la consulta para obtener la información del usuario usando $empresa_id
$info_empresa_sql = "SELECT Representante_Legal, Razon_Social, Telefono, Correo_Electronico, Direccion FROM empresa WHERE Id_empresa = $empresa_id";

$resultado_info = mysqli_query($conn, $info_empresa_sql);

if ($resultado_info) {
    $fila_info = mysqli_fetch_assoc($resultado_info);
    $representa_empresa = $fila_info['Representante_Legal'];
    $nombre_empresa = $fila_info['Razon_Social'];
    $Telefono_empresa= $fila_info['Telefono'];
    $correo_empresa= $fila_info['Correo_Electronico'];
    $Direccion_empresa= $fila_info['Direccion'];
} else {
    // Manejo del error (puedes personalizar según tus necesidades)
    die("Error en la consulta: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
        background-image: url('./img/fondo.avif');
        /* Reemplaza 'ruta_de_la_imagen.jpg' con la ruta de tu imagen de fondo */
    }
</style>

<body>

    <ul class="navbar">
        <li class="nav-item"><a href="index.php">Inicio</a></li>
        <li class="nav-item"><a href="canchas.php">Canchas</a></li>
        <li class="nav-item">

    

        <li><a href="cerrar_sesion.php" class="cerrar-sesion">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
    <table>
    <tr>
        <td colspan="2"><h1>¡Bienvenido, Administrador!</h1></td>
    </tr>
    <tr>
        <td>Representante:</td>
        <td><?php echo $representa_empresa; ?></td>
    </tr>
    <tr>
        <td>Nombre de la empresa:</td>
        <td><?php echo $nombre_empresa; ?></td>
    </tr>
    <tr>
        <td>Telefono:</td>
        <td><?php echo $Telefono_empresa; ?></td>
    </tr>
    <tr>
        <td>Correo Electrónico:</td>
        <td><?php echo $correo_empresa; ?></td>
    </tr>
    <tr>
        <td>Direccion:</td>
        <td><?php echo $Direccion_empresa; ?></td>
    </tr>
    <tr>
        <td colspan="2"><h2>Opciones de Perfil</h2></td>
    </tr>
    <tr>
        <td colspan="2">
            <ul>
                <li><a href="editar_p_e.php">Editar Perfil</a></li>
                <li><a href="admin_us.php">Administrar Usuarios</a></li>
                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
        </td>
    </tr>
</table>

</body>

</html>
