<?php
include 'conexion.php';
session_start();

if (isset($_SESSION["id_usuario"])) {
    header("Location: bienvenido.php");  // Redirige a bienvenido.php si el usuario ya está autenticado
}

if (!empty($_POST)) {
    $correo = $_POST['correo_u'];
    $password = $_POST['Contraseña_i'];

    // Prepara la consulta
    $sql = "SELECT * FROM Usuario WHERE Correo_Electronico = '$correo' AND Contraseña = '$password'";

    // Ejecuta la consulta
    $result = $conn->query($sql);

    if (!$result) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    $rows = $result->num_rows;
    if ($rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id_usuario'] = $row['Id_Usuario'];
            $nombreUsuario = $row['Nombres'];  // Obtén el nombre del usuario
        }

        echo '<script>
            alert("Ingreso Exitoso, Bienvenido ' . $nombreUsuario . '");
            setTimeout(function() {
                window.location.href = "bienvenido.php";
            }, 100); // Redirigir después de 5 segundos
        </script>';
    } else {
        echo '<script>
            alert("Datos incorrectos, Por favor Verifique sus Datos");
            window.location.href = "ingresar.php";
        </script>';
    }

    // Cierra la conexión
    $conn->close();
}
?>

