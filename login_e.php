<?php
session_start();

include 'conexion.php';

$correo_L = isset($_POST['correo_u']) ? $_POST['correo_u'] : '';
$Contraseña_L = isset($_POST['Contraseña_i']) ? $_POST['Contraseña_i'] : '';
//$Contraseña_L = $_POST[$Contraseña_L];

// Verificar si los datos fueron proporcionados
if (empty($correo_L) || empty($Contraseña_L)) {
    echo '
    <script>
    alert("Por favor, ingrese todos los campos.");
    window.location = "./ingresar.php";
    </script>';
    exit;
}

$validar_login_e = mysqli_query($conn, "SELECT * FROM empresa WHERE Correo_Electronico='$correo_L' AND Contraseña='$Contraseña_L'");

if ($validar_login_e) {
    if (mysqli_num_rows($validar_login_e) > 0) {
        $_SESSION['empresa'] = $correo_L; // Utiliza la variable de sesión correcta para la empresa
        header("location: bienvenido_e.php"); // Redirige a la página de bienvenida de empresa
    } else {
        echo '
        <script>
        alert("Credenciales incorrectas.");
        window.location = "./ingresar.php";
        </script>';
        exit;
    }
} else {
    echo '
    <script>
    alert("Error en la consulta a la base de datos: '.mysqli_error($conn).'");
    window.location = "./ingresar.php";
    </script>';
    exit;
}
?>


