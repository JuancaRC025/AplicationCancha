<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_actualizacion'])) {
    $id_usuario_actualizar = $_POST['id_usuario'];
    $nuevos_nombres = $_POST['nuevos_nombres'];
    $nuevos_apellidos = $_POST['nuevos_apellidos'];
    $nuevo_correo = $_POST['nuevo_correo'];
    $nuevo_telefono = $_POST['nuevo_telefono'];
    $nueva_contraseña = isset($_POST['nueva_contraseña']) ? $_POST['nueva_contraseña'] : '';

    // Verificar si se proporcionó una nueva contraseña
    $contraseña_actualizada = !empty($nueva_contraseña) ? ", Contraseña = '$nueva_contraseña'" : '';

    $query = "UPDATE usuario SET 
              Nombres = '$nuevos_nombres', 
              Apellidos = '$nuevos_apellidos', 
              Correo_Electronico = '$nuevo_correo', 
              Telefono = '$nuevo_telefono'
              $contraseña_actualizada
              WHERE Id_Usuario = $id_usuario_actualizar";

    if ($conn->query($query) === TRUE) {
        echo 'Datos actualizados correctamente';
        header('Location: bienvenido.php'); // Página de bienvenida del usuario
        exit;
    } else {
        echo 'Error al actualizar datos: ' . $conn->error;
    }
} else {
    echo 'Error en el envío del formulario';
}
?>