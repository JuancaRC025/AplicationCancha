<?php
include 'conexion.php';
session_start();

if (isset($_SESSION["id_empresa"])) {
    header("Location: bienvenido_e.php");
}

if (!empty($_POST)) {
    $correo = $_POST['correo_u'];
    $password = $_POST['Contraseña_i'];

    // Prepara la consulta
    $sql = "SELECT * FROM empresa WHERE Correo_Electronico = '$correo' AND Contraseña = '$password'";

    // Ejecuta la consulta
    $result = $conn->query($sql);

    if (!$result) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    $rows = $result->num_rows;
    if ($rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id_empresa'] = $row['Id_Empresa']; 
            $nombre_empresa= $row['Razon_Social'];  // Obtén el nombre de la empresa
            $representa_empresa= $row['Representante_Legal'];
        }

        echo '<script>
        alert("Ingreso Exitoso como Empresa: ' . $nombre_empresa . '   Bienvenido: '.$representa_empresa.'");
    setTimeout(function() {
        window.location.href = "bienvenido_e.php";
    }, 100); // Redirigir después de 1 segundo
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
