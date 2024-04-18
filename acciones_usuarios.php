<?php
// acciones_usuarios.php

session_start();
include 'conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar_usuario'])) {
        $id_usuario_eliminar = $_POST['eliminar_usuario'];
        $query = "DELETE FROM usuario WHERE Id_Usuario = $id_usuario_eliminar";
        
        if ($conn->query($query) === TRUE) {
            echo 'Usuario eliminado correctamente';
        } else {
            echo 'Error al eliminar usuario: ' . $conn->error;
        }
    } elseif (isset($_POST['actualizar_usuario'])) {
        $id_usuario_actualizar = $_POST['actualizar_usuario'];
        // Puedes redirigir a una página de actualización o mostrar un formulario de actualización
        echo 'Redirigir o mostrar formulario de actualización para el usuario con ID: ' . $id_usuario_actualizar;
    }
}
?>