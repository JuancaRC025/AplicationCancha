<?php
session_start();
include 'conexion.php';

// Verificar si el Id_Usuario está definido en la sesión
$usuario_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

if (!$usuario_id) {
    // Manejo del caso en que $_SESSION['id_usuario'] no esté definido o sea nulo
    header("Location: ingresar.php");
    exit();
}

// Realiza la consulta para obtener la información del usuario usando $usuario_id de forma segura
$info_usuario_sql = "SELECT Nombres, Apellidos, Correo_Electronico, Telefono FROM usuario WHERE Id_Usuario = ?";
$stmt = mysqli_prepare($conn, $info_usuario_sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
    mysqli_stmt_execute($stmt);
    $resultado_info = mysqli_stmt_get_result($stmt);

    if (!$resultado_info) {
        // Manejo del error (puedes personalizar según tus necesidades)
        die("Error en la consulta: " . mysqli_error($conn));
    }

    $fila_info = mysqli_fetch_assoc($resultado_info);
    $nombres = $fila_info['Nombres'];
    $apellidos = $fila_info['Apellidos'];
    $correo_electronico = $fila_info['Correo_Electronico'];
    $telefono = $fila_info['Telefono'];
} else {
    // Manejo del caso en que mysqli_prepare no haya tenido éxito
    die("Error al preparar la consulta: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <title>Editar Perfil</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        body {
            background-image: url('./img/fondo.avif');
            /* Reemplaza 'ruta_de_la_imagen.jpg' con la ruta de tu imagen de fondo */
        }
    </style>
</head>
<body>

<ul class="navbar">
    <li class="nav-item"><a href="index.php">Inicio</a></li>
    <li class="nav-item"><a href="canchas.php">Canchas</a></li>
    <li class="nav-item">
        <a href="https://api.whatsapp.com/send?phone=3027500507&text=Tengo%20problemas%20de%20acceso%20o%20requiero%20información.%20¿Me%20pueden%20ayudar%3F" target="_blank">Soporte</a>
    </li>
    <li><a href="cerrar_sesion.php" class="cerrar-sesion">
        <i class="fas fa-sign-out-alt"></i>
    </a></li>
</ul>

<h1>Editar Perfil</h1>

<form method="post" action="accion_edit_u.php">
    <input type="hidden" name="id_usuario" value="<?php echo $usuario_id; ?>">

    <label>Nombres:</label>
    <input type="text" name="nuevos_nombres" value="<?php echo htmlspecialchars($nombres); ?>" required><br>

    <label>Apellidos:</label>
    <input type="text" name="nuevos_apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required><br>

    <label>Correo Electrónico:</label>
    <input type="text" name="nuevo_correo" value="<?php echo htmlspecialchars($correo_electronico); ?>" required><br>

    <label>Teléfono:</label>
    <input type="text" name="nuevo_telefono" value="<?php echo htmlspecialchars($telefono); ?>" required><br>

    <label>Nueva Contraseña:</label>
    <input type="password" name="nueva_contraseña" placeholder="Deja en blanco para no cambiar"><br>

    <input type="submit" name="guardar_actualizacion" value="Guardar Cambios">
</form>

</body>
</html>