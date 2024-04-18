<?php
include 'conexion.php';


$nit = $_POST['nit'];
$razon = $_POST['razon_social'];
$direccion = $_POST['direccion'];
$representante = $_POST['representante_legal'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo_empresa'];
$contrasena = $_POST['contrasena'];
//$contrasena = md5($_POST['contrasena']); Cifrado para las contraseñas


$sql = "INSERT INTO empresa (Nit,Razon_Social,Direccion,Representante_Legal,Telefono,Correo_Electronico,Contraseña) VALUES ('$nit', '$razon','$direccion','$representante','$telefono','$correo','$contrasena')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "Nuevo registro creado correctamente, Espere Por Favor, Redireccionando";
    header("refresh:3;url=http://localhost/AplicationCancha/reg_detcancha.php?lastId=".$last_id);

}else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
