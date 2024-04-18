<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el valor del campo idRes
    if (isset($_POST['idRes'])) {
        $id = $_POST['idRes'];

        // Realizar la consulta SQL para eliminar la reserva
        $sql = "DELETE FROM reserva WHERE Id_Reserva = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Reserva Cancelada, Espere Por Favor";
            header("refresh:3;url=reservar.php"); // Redirecciona a la página de disponibilidad
            exit(); // Finaliza el script para evitar que se muestre "Acceso no permitido"
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "El campo 'idRes' no se encontró en la solicitud POST.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();

?>
