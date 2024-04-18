<?php
session_start();
include 'conexion.php';

// Verifica si el Id_empresa está definido en la sesión
$empresa_id = isset($_SESSION['id_empresa']) ? $_SESSION['id_empresa'] : null;

if (!$empresa_id) {
    // Redirigir si no hay una sesión activa de empresa
    header("Location: ingresar.php");
    exit();
}

// Realiza la consulta para obtener la información de la empresa usando $empresa_id
$info_empresa_sql = "SELECT Representante_Legal, Razon_Social, Telefono, Correo_Electronico, Direccion FROM empresa WHERE Id_Empresa = ?";
$stmt = mysqli_prepare($conn, $info_empresa_sql);
mysqli_stmt_bind_param($stmt, "i", $empresa_id);
mysqli_stmt_execute($stmt);
$resultado_info = mysqli_stmt_get_result($stmt);

if (!$resultado_info) {
    // Manejo del error (puedes personalizar según tus necesidades)
    die("Error en la consulta: " . mysqli_error($conn));
}

$fila_info = mysqli_fetch_assoc($resultado_info);
$representante_empresa = $fila_info['Representante_Legal'];
$nombre_empresa = $fila_info['Razon_Social'];
$telefono_empresa = $fila_info['Telefono'];
$correo_empresa = $fila_info['Correo_Electronico'];
$direccion_empresa = $fila_info['Direccion'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar Perfil - Empresa</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
        background-image: url('./img/fondo.avif');
    }
</style>

<body>

<ul class="navbar">
    <li class="nav-item"><a href="bienvenido_e.php"> < Volver </a></li>
 
</ul>

    <h1>Editar Perfil - Empresa</h1>

    <form method="post" action="actualizar_empresa.php">
        <input type="hidden" name="id_empresa" value="<?php echo $empresa_id; ?>">

        <label>Representante Legal:</label>
        <input type="text" name="nuevo_representante" value="<?php echo htmlspecialchars($representante_empresa); ?>" required><br>

        <label>Razón Social:</label>
        <input type="text" name="nueva_razon_social" value="<?php echo htmlspecialchars($nombre_empresa); ?>" required><br>

        <label>Telefono:</label>
        <input type="text" name="nuevo_telefono" value="<?php echo htmlspecialchars($telefono_empresa); ?>" required><br>

        <label>Correo Electrónico:</label>
        <input type="text" name="nuevo_correo" value="<?php echo htmlspecialchars($correo_empresa); ?>" required><br>

        <label>Direccion:</label>
        <input type="text" name="nueva_direccion" value="<?php echo htmlspecialchars($direccion_empresa); ?>" required><br>

        <label>Nueva Contraseña:</label>
        <input type="password" name="nueva_contraseña" placeholder="Deja en blanco para no cambiar"><br>

        <input type="submit" name="guardar_actualizacion" value="Guardar Cambios">
    </form>

</body>

</html>