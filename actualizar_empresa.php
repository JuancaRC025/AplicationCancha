<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $empresa_id = $_POST['id_empresa'];
    $nuevo_representante = $_POST['nuevo_representante'];
    $nueva_razon_social = $_POST['nueva_razon_social'];
    $nuevo_telefono = $_POST['nuevo_telefono'];
    $nuevo_correo = $_POST['nuevo_correo'];
    $nueva_direccion = $_POST['nueva_direccion'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    // Prepara la consulta para actualizar los datos de la empresa
    $actualizar_empresa_sql = "UPDATE empresa SET Representante_Legal=?, Razon_Social=?, Telefono=?, Correo_Electronico=?, Direccion=?";
    
    // Actualiza la contraseña solo si se proporciona una nueva
    if (!empty($nueva_contraseña)) {
        $actualizar_empresa_sql .= ", Contraseña=?";
    }
    
    $actualizar_empresa_sql .= " WHERE Id_Empresa = ?";
    
    $stmt = mysqli_prepare($conn, $actualizar_empresa_sql);

    // Vincula los parámetros
    $types = str_repeat('s', substr_count($actualizar_empresa_sql, '?') - 1) . 'i';
    $params = [&$stmt, $types, $nuevo_representante, $nueva_razon_social, $nuevo_telefono, $nuevo_correo, $nueva_direccion];

    if (!empty($nueva_contraseña)) {
        $params[] = $nueva_contraseña;
    }

    $params[] = $empresa_id;

    call_user_func_array('mysqli_stmt_bind_param', $params);

    // Ejecuta la actualización
    if (mysqli_stmt_execute($stmt)) {
        // Redirige a la página de perfil después de actualizar
        header("Location: bienvenido_e.php");
        exit();
    } else {
        // Manejo del error (puedes personalizar según tus necesidades)
        die("Error en la actualización: " . mysqli_error($conn));
    }

    // Cierra la declaración
    mysqli_stmt_close($stmt);
}
?>