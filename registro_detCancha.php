<?php
include 'conexion.php';


$last_id = $_POST['last_id'];
// $logo = $_POST['logo'];
$tamaño = $_POST['tamaño'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];


$sql = "INSERT INTO detalle_cancha (Id_Empresa,Tamaño,Nombre,Precio) VALUES ('$last_id','$tamaño','$nombre','$precio')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado correctamente, Espere Por Favor";
    
}else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("refresh:3;url=http://localhost/AplicationCancha/index.php?");
?>
